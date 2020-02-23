<?php

namespace App\Console\Commands;

use App\Core\SystemBuilder\SystemCreators\FullAppCreator;
use App\Core\SystemBuilder\SystemCreators\ScheduleCreator;
use App\Core\SystemBuilder\SystemCreators\StoreCreator;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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


    protected $systemCreators = [
        'Full app' => FullAppCreator::class,
        'Schedule app' => ScheduleCreator::class,
        'Store app' => StoreCreator::class,

    ];
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
            $this->info('Database created successfully');

        }
        $appType = $this->choice('Select type of application', ['Full app', 'Schedule app', 'Store app']);

        $configType = $this->choice('Select type of configuration to applys', ['full', 'standar', 'limited']);

        (new $this->systemCreators[$appType](new Collection()))->setConfig($configType)->run();



    }
}
