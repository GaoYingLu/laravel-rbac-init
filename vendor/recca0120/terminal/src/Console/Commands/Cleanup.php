<?php

namespace Recca0120\Terminal\Console\Commands;

use Webmozart\Glob\Glob;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class Cleanup extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cleanup vendor folder';

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
        set_time_limit(0);
        $root = function_exists('base_path') === true ? base_path() : getcwd();
        $root = rtrim($root, '/').'/';

        $docs = ['README*', 'CHANGELOG*', 'FAQ*', 'CONTRIBUTING*', 'HISTORY*', 'UPGRADING*', 'UPGRADE*', 'package*', 'demo', 'example', 'examples', 'doc', 'docs', 'readme*'];
        $tests = ['.travis.yml', '.scrutinizer.yml', 'phpunit.xml*', 'phpunit.php', 'test', 'Test', 'tests', 'Tests', 'travis'];
        $vcs = ['.svn', '_svn', 'CVS', '_darcs', '.arch-params', '.monotone', '.bzr', '.git', '.hg'];
        $others = [
            'vendor',
            '.babelrc',
            '.editorconfig',
            '.eslintrc.*',
            '.gitattributes',
            '.gitignore',
            '.nitpick.json',
            '.php_cs',
            '.scrutinizer.yml',
            '.styleci.yml',
            '.travis.yml',
            'appveyor.yml',
            'package.json',
            'phpcs.xml',
            'ruleset.xml',
        ];
        $common = [
            'node_modules',
        ];

        (new Collection(
            Glob::glob($root.'{'.(new Collection(Glob::glob($root.'vendor/*/*')))
            ->map(function ($item) {
                return substr($item, strpos($item, 'vendor'));
            })
            ->implode(',').'}/**/{'.(implode(',', array_merge($vcs, $common, $others, $tests, $docs))).'}')
        ))
        ->merge(Glob::glob($root.'{'.(implode(',', array_merge($vcs, $common))).'}'))
        ->merge([
            $root.'vendor/phpunit',
        ])
        ->filter()
        ->each(function ($item) {
            if ($this->files->isDirectory($item) === true) {
                $this->files->deleteDirectory($item);
                $this->info('delete directory: '.$item);
            } elseif ($this->files->isFile($item)) {
                $this->files->delete($item);
                $this->info('delete file: '.$item);
            }
        });
        $this->line('');
    }
}
