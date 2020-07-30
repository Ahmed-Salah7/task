<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProjectInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install';
//{--cache_dump}

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install project (migration , seeder , composer dump-autoload , clear history config-cash...etc)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        if ($this->option('cache_dump')) {

        // clear config
        Artisan::call('config:clear');

        // clear view
        Artisan::call('view:clear');

        // clear cache
        Artisan::call('cache:clear');

        $this->info(Artisan::output());
        //composer dump
        shell_exec('composer dump-autoload');
//        }
        // drop tables and migrate
        Artisan::call('migrate:refresh', ['--force' => true]);
        $this->info(Artisan::output());
        // seed data
        Artisan::call('db:seed', ['--force' => true, '--no-interaction' => true]);
        $this->info(Artisan::output());
    }
}
