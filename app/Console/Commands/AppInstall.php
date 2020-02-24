<?php

namespace App\Console\Commands;

use App\Core\SystemBuilder\SystemCreators\FullAppCreator;
use App\Core\SystemBuilder\SystemCreators\ScheduleCreator;
use App\Core\SystemBuilder\SystemCreators\StoreCreator;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install {--refresh-db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install clean application V 1.0';

    protected $creator;

    protected $selectedApp;

    protected $scaffolds = [];

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

        $this->checkUserIntention();

        $this->createSchemmaIfNotExist();

        $this->info('Installing application');

        $this->selectedApp = $this->choice('Select type of application', ['Full app', 'Schedule app', 'Store app']);

        $this->buildCreator();

        $this->handleMigration();

        $this->configureCreator();

        $this->create();



    }
    protected function buildCreator()
    {
        $this->info('Loading Application type ...');

        $this->creator = new $this->systemCreators[$this->selectedApp](new Collection());

        $this->info('Application type loaded');


        return;
    }

    public function configureCreator()
    {

        $config = $this->choice('Select type of settings to apply', ['full', 'standar', 'limited']);

        $this->info('Loading settings files ...');

        $this->creator->configureCreator($config);

        $this->info('Settings files loaded.');



        return;
    }

    public function create()
    {
        $this->info('Creating application, please wait ...');

        $this->creator->run();

        $this->info('Congratulations, your application is ready!');



    }

    public function handleMigration()
    {

        $command = '';
        $args = [];

        $this->createSchemmaIfNotExist();

        if(!$this->shouldMigrate()){
            return;
        }
        $command .= 'migrate';

        if($this->shouldRefresh())
        {
            $command .=':fresh';
        }

        if($this->shouldSeed())
        {
            array_push($args, ['--seed' => true]);
        }

        $this->runMigrations($command , $args);




    }
    protected function shouldSeed()
    {
        return ($this->choice('Should seed to ?', ['Yes', 'No']) === 'Yes')
            ? true
            :false;
    }

    protected function shouldRefresh()
    {
        return ($this->choice('Should refresh migrations ? ', ['Yes', 'No']) === 'Yes')
            ? true
            :false;
    }

    protected function shouldMigrate()
    {
        return ($this->choice('Should migrate', ['Yes', 'No']) === 'Yes')
            ? true
            :false;
    }

    protected function shouldScalate()
    {
        $scaffold = [];
        $basePath = 'database/migrations/';
        switch ($this->selectedApp)
        {
            case 'Schedule app':
            case'Full app':
                $scaffold = [
                    $basePath.'shifts_module'
                ];
            break;
            case 'Store app':; break;
        }
        foreach($scaffold as $scaff){
            array_push($this->scaffolds, $scaff);
        }
        return count($this->scaffolds) ? true : false;
    }

    protected function runMigrations($command , $args)
    {

        $this->info('Creating database ...');


        $this->call($command , $args);

        if($this->shouldScalate())
        {
            foreach($this->scaffolds as $scaffold)
            {

                $this->call('migrate' , ['--path' => $scaffold, '--seed' => true]);
            }
        }
        $this->info('Database created successfully');

        return;
    }

    public function createSchemmaIfNotExist()
    {
        try
        {
            $this->info(DB::table('migrations')->select('*'));

        }catch (\Exception $e){
            $this->info("Crating database ...");

            $servername = env('DB_HOST');
            $username = env("DB_USERNAME");
            $password= env('DB_PASSWORD');
            $dbName = env('DB_DATABASE');


            // Connect to MySQL
            $conn = new \mysqli($servername, $username, $password);
            if ($conn->connect_error) {

                $this->error("Connection failed: " . $conn->connect_error);
            }

            // If database is not exist create one
            if (!mysqli_select_db($conn,$dbName)){
                $sql = "CREATE DATABASE ".$dbName;
                $this->info($dbName);

                if ($conn->query($sql) === TRUE) {
                    $this->info("Database created successfully");

                }else {
                    $this->error("Error creating database: " . $conn->error);

                }
            }

        }
    }
    protected function checkUserIntention()
    {
        if($this->option('refresh-db') === 'true') {
            $this->info('Refreshing Database');

            $this->selectedApp = 'Full app';
            $this->handleMigration();
            $this->info('Database is now refresh');
            exit();
        }
        return true;
    }



}
