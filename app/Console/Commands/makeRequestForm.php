<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makeRequestForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:makeRequest {--modules=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $modules = explode(',', $this->option('modules'));
        foreach($modules as $module)
        {
            $this->call('make:request', [
                'name' => 'Backend/'.strtolower($module).'/'.ucfirst(strtolower($module)).'CreateFormRequest',
            ]);
            $this->call('make:request', [
                'name' => 'Backend/'.strtolower($module).'/'.ucfirst(strtolower($module)).'UpdateFormRequest',
            ]);
        }
    }
}
