<?php


namespace App\Core\SystemBuilder;



use App\Core\SystemBuilder\Config\FullConfigModule;
use App\Core\SystemBuilder\Config\LimitedConfigModule;
use App\Core\SystemBuilder\Config\StandarConfigModule;
use Illuminate\Support\Collection;


abstract class SystemCreator
{
    protected  $builders;


    public function __construct(Collection $builders)
    {
        $this->builders = $builders;
    }

    public function add(AbstractBuilder $builder)
    {
        $this->builders->push($builder);
        return $this;
    }

    public function build()
    {
        $this->builders->each(function($builder,$key) {
            $builder->build($key);
        });
    }

    public function setConfig($configFile)
    {
        switch ($configFile){
            case 'full' : $this->add(new FullConfigModule());break;
            case 'standar' : $this->add(new StandarConfigModule());break;
            case 'limited': $this->add(new LimitedConfigModule());break;
        }
        return $this;
    }

}
