<?php

namespace Zizaco\Entrust;

/*
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;
use Illuminate\View\Factory as View;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;

class MigrationCommand extends Command
{

    /**
     * Configuaration.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * View
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Composer
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Filesystem
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Entrust configuration & options.
     *
     * @var array
     */
    protected $options;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'entrust:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates migrations following the Entrust specifications.';

    public function __construct(Config $config, View $view, Composer $composer, Filesystem $filesystem)
    {
        $this->config = $config;
        $this->view = $view;
        $this->composer = $composer;
        $this->filesystem = $filesystem;
        $this->options = $config->get('entrust');
        parent::__construct();
    }

    /**
     * Get authentication provider.
     *
     * @return array
     */
    public function getAuthProvider()
    {
        $guards = $this->config->get('auth.guards');
        if (!$guards) {
            throw new Exception('Guard(s) not found');
        }
        $guard = $this->choice('Which guard would you like to use?', array_keys($guards), 0);
        $guard = $this->config->get("auth.guards.{$guard}");
        if (!isset($guard['provider'])) {
            throw new Exception('Provider not found');
        }
        $provider = $guard['provider'];

        return $this->config->get("auth.providers.{$provider}");
    }

    public function confirmMigration($options)
    {
        print_r($options);
        return $this->confirm('Proceed with the migration creation?', 'yes');
    }

    /**
     * The path of migration file
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path('/database/migrations/').date('Y_m_d_His').'_'.$name.'.php';
    }

    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    public function createMigration($name, $view, $data = array())
    {
        $this->line('');
        $this->info('Creating migration...');
        $camelName = ucwords(camel_case($name));
        $data = array_merge([
            'name' => $camelName
        ], $data);
        $output = $this->view->make("entrust::generators.{$view}")->with($data)->render();
        $path = $this->getPath($name);
        if (!file_exists($path) && $fs = fopen($path, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            $this->info('Migration successfully created!');
            return true;
        }
        $this->error("Couldn't create migration.");
        return false;
    }

    public function makeMigrationBase($options = array())
    {
        return $this->confirmMigration($options) && $this->createMigration('entrust_base', 'migration_base', $options);
    }

    public function makeMigrationPivot($options = array())
    {
        $provider = $options['provider'];
        $driver = $provider['driver'];
        if ($driver === 'eloquent' && isset($provider['model'])) {
            $model = with(new $provider['model']());
            $usersTable = [
                'name' => $model->getTable(),
                'pkey' => $model->getKeyName(),
            ];
        } elseif ($driver === 'database' && isset($provider['table'])) {
            $usersTable = [
                'name' => $provider['table'],
                'pkey' => $this->anticipate('What is your primary key?', ['id']),
            ];
        } else {
            return false;
        }

        $usersTable['singular'] = str_singular($usersTable['name']);
        $usersTable['fkey'] = $usersTable['singular'].'_id';

        $roleUserFKeys = array(
            $usersTable,
            [
                'name' => $options['roles_table'],
                'pkey' => 'id',
                'fkey' => 'role_id',
                'singular' => 'role',
            ],
        );

        $pivotNames = array_pluck($roleUserFKeys, 'singular');
        sort($pivotNames);

        $options['roleUserPivotTable'] = array(
            'name' => implode('_', $pivotNames),
            'fkeys' => $roleUserFKeys,
        );
        return $this->confirmMigration($options) && $this->createMigration("entrust_pivot_{$options['roleUserPivotTable']['name']}", 'migration_pivot', $options);
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        try {
            $this->makeMigrationBase($this->options);
            $provider = $this->getAuthProvider();
            $this->makeMigrationPivot([
                'provider' => $provider,
                'roles_table' => $this->options['roles_table']
            ]);
            $this->composer->dumpAutoloads();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
