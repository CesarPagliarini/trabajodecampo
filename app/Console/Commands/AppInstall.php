<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install {--new=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install clean application V 1.0';

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
        $this->info('Installing application');

        if($this->option('new') === 'true')
        {
            $this->info('Creating database ...');
            $this->call("migrate:fresh", ['--seed' => true]);
//            $this->call("migrate:fresh", ['--seed' => true]);
            $this->info('Database created successfully');

        }

        $this->info('Implementing modules ... ');
        $this->call("implement:modules");
    }
}
