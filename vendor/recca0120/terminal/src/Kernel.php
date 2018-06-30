<?php

namespace Recca0120\Terminal;

use Illuminate\Support\Arr;
use Recca0120\Terminal\Application as Artisan;
use Illuminate\Contracts\Console\Kernel as KernelContract;

class Kernel implements KernelContract
{
    /**
     * The Artisan application instance.
     *
     * @var \Illuminate\Console\Application
     */
    protected $artisan;

    /**
     * $config.
     *
     * @var array
     */
    protected $config;

    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Create a new console kernel instance.
     *
     * @param \Recca0120\Terminal\Application $artisan
     */
    public function __construct(Artisan $artisan, $config = [])
    {
        $this->artisan = $artisan;
        $this->config = Arr::except(array_merge([
            'username' => 'LARAVEL',
            'hostname' => php_uname('n'),
            'os' => PHP_OS,
        ], $config), [
            'enabled',
            'whitelists',
            'route',
            'commands',
        ]);
    }

    /**
     * getConfig.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Handle an incoming console command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    public function handle($input, $output = null)
    {
        return $this->artisan->run($input, $output);
    }

    /**
     * Run an Artisan console command by name.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @param  \Symfony\Component\Console\Output\OutputInterface  $outputBuffer
     * @return int
     */
    public function call($command, array $parameters = [], $outputBuffer = null)
    {
        return $this->artisan->call($command, $parameters, $outputBuffer);
    }

    /**
     * Queue an Artisan console command by name.
     *
     * @param string $command
     * @param array $parameters
     * @return void
     */
    public function queue($command, array $parameters = [])
    {
        $app = $this->artisan->getLaravel();
        $app['Illuminate\Contracts\Queue\Queue']->push(
            'Illuminate\Foundation\Console\QueuedJob', func_get_args()
        );
    }

    /**
     * Get all of the commands registered with the console.
     *
     * @return array
     */
    public function all()
    {
        return $this->artisan->all();
    }

    /**
     * Get the output for the last run command.
     *
     * @return string
     */
    public function output()
    {
        return $this->artisan->output();
    }
}
