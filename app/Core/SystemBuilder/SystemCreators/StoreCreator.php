<?php


namespace App\Core\SystemBuilder\SystemCreators;



use App\Core\SystemBuilder\Client\ClientModule;


use App\Core\SystemBuilder\Client\FullConfigModule;
use App\Core\SystemBuilder\Client\StandarConfigModule;
use App\Core\SystemBuilder\Orders\OrderModule;
use App\Core\SystemBuilder\StandAlone\HomeForm;
use App\Core\SystemBuilder\Store\StoreModule;
use App\Core\SystemBuilder\SystemCreator;
use Illuminate\Support\Collection;

class StoreCreator extends SystemCreator
{

    public function run()
    {
        $this->add(new HomeForm())
            ->add(new ClientModule())
            ->add(new StoreModule())
            ->add(new OrderModule())
            ->build();
    }
}
