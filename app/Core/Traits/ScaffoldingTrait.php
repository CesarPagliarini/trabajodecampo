<?php


namespace App\Core\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait ScaffoldingTrait
{


    public function generateViewScaffold($view, $folder)
    {
        try{


            $source =resource_path('views\\'.'dummy');
            $path = resource_path('views/backend');
            $dest = "$path\\$folder\\$view";
            // Make destination directory
            if (!is_dir($dest)) {
                File::makeDirectory($dest, 0777,true);
            }
            // open the source directory
            $dir = opendir($source);
            // Loop through the files in source directory
            while( $file = readdir($dir) ) {

                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($source . '/' . $file) )
                    {
                        custom_copy($source . '/' . $file, $dest . '/' . $file);
                    }
                    else {
                        copy($source . '/' . $file, $dest . '/' . $file);
                    }
                }
            }
            closedir($dir);
            return true;
        }catch(\Exception $e){
            Log::info($e->getMessage());
            return false;
        }
    }

    public function generateController($folder, $controller)
    {
        $base = base_path('app\\http\\controllers\\Backend');
        $newFolder = $base.'/'.ucfirst(strtolower($folder));
        $controllerFolder = 'Backend/'.ucfirst(strtolower($folder));


        if (!is_dir($newFolder)) {
            File::makeDirectory($newFolder, 0777,true);
        }
        $controller = $controllerFolder.'/'.ucfirst(strtolower($controller)).'Controller';

        $this->call('make:controller', [
             '--resource' => 'resource',
            'name' => $controller,
        ]);

    }
    public function generateModel($model)
    {
        if($model){
            $model = ucfirst(strtolower($model));
            $this->call('make:model', [
                'name' => $model,
            ]);
        }

    }



}
