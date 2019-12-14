<?php

namespace App\Console\Commands;

use App\Core\Traits\ScaffoldingTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class SimpleScaffold extends Command
{
    use ScaffoldingTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:scaffold {--controllerfolder=} {--controller=}
                            {--model=} {--route=} {--viewfolder=} {--view=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create simple starter scaffold with view folder, controller, model and route package';

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
        try{
            $this->generateViewScaffold($this->option('view') , $this->option('viewfolder'));
            $this->generateController($this->option('controllerfolder'), $this->option('controller'));
            $this->generateModel($this->option('model'));
            $this->info('Scaffold generated successfully');
            $this->call("optimize");


        }catch (\Exception $e){
            $this->info('Check your logs, errors have ocurred');
            Log::info($e->getMessage());
        }
    }

}

