<?php

namespace Recca0120\Terminal\Console\Commands;

use Phar;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;

class Composer extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'composer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'composer';

    /**
     * $files.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * __construct.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Handle the command.
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        $this->install();

        $command = trim($this->option('command'));
        if (empty($command) === true) {
            $command = 'help';
        }

        $input = new StringInput($command);
        $output = $this->getOutput();
        $application = new \Composer\Console\Application();
        $application->setAutoExit(false);
        $application->run($input, $output);
    }

    /**
     * install.
     */
    protected function install()
    {
        $storagePath = $this->getLaravel()->storagePath();
        $composerPath = $storagePath.'/app/composer/';
        if ($this->files->exists($composerPath.'vendor/autoload.php') === false) {
            if ($this->files->isDirectory($composerPath) === false) {
                $this->files->makeDirectory($composerPath, 0777);
            }
            $this->files->put($composerPath.'composer.phar', file_get_contents('https://getcomposer.org/composer.phar'));
            $composerPhar = new Phar($composerPath.'composer.phar');
            $composerPhar->extractTo($composerPath);
            unset($composerPhar);
            $this->files->delete($composerPath.'composer.phar');
        }
        if (empty(getenv('COMPOSER_HOME')) === true) {
            putenv('COMPOSER_HOME='.$composerPath);
        }
        $this->files->getRequire($composerPath.'vendor/autoload.php');
        $this->init();
    }

    /**
     * init.
     */
    protected function init()
    {
        error_reporting(-1);

        // $xdebug = new \Composer\XdebugHandler($this->getOutput());
        // $xdebug->check();
        // unset($xdebug);
        if (function_exists('ini_set')) {
            @ini_set('display_errors', 1);
            $memoryInBytes = function ($value) {
                $unit = strtolower(substr($value, -1, 1));
                $value = (int) $value;
                switch ($unit) {
                    case 'g':
                        $value *= 1024;
                        // no break (cumulative multiplier)
                    case 'm':
                        $value *= 1024;
                        // no break (cumulative multiplier)
                    case 'k':
                        $value *= 1024;
                }

                return $value;
            };
            $memoryLimit = trim(ini_get('memory_limit'));
            // Increase memory_limit if it is lower than 1GB
            if ($memoryLimit != -1 && $memoryInBytes($memoryLimit) < 1024 * 1024 * 1024) {
                @ini_set('memory_limit', '1G');
            }
            unset($memoryInBytes, $memoryLimit);
        }

        if (defined('STDIN') === false) {
            define('STDIN', fopen('php://stdin', 'r'));
        }

        $basePath = $this->getLaravel()->basePath();
        chdir($basePath);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['command', null, InputOption::VALUE_OPTIONAL],
        ];
    }
}
