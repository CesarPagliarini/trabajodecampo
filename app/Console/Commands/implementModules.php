<?php

namespace App\Console\Commands;

use App\Core\Traits\implementModulesTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class implementModules extends Command
{
    use implementModulesTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'implement:modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "implements kick-off modules";

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
            $this->implementClientModule();
            $this->implementHomeForm();
            $this->implementsProductModule();
            $this->info('Modules successfully implementeds');
        }catch (\Exception $e){
            $this->info('Failed modules implementation');
        }




    }
}
