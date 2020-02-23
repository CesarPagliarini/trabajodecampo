<?php


namespace App\Core\SystemBuilder\SystemCreators;

use App\Core\SystemBuilder\Client\ClientModule;


use App\Core\SystemBuilder\Orders\OrderModule;
use App\Core\SystemBuilder\Professional\ProfessionalModule;
use App\Core\SystemBuilder\Shifts\ShiftModule;
use App\Core\SystemBuilder\Store\StoreModule;
use App\Core\SystemBuilder\StandAlone\HomeForm;
use App\Core\SystemBuilder\SystemCreator;
use Illuminate\Support\Collection;

class FullAppCreator extends SystemCreator
{


    public function __construct(Collection $builders)
    {
        parent::__construct($builders);
    }

    public function run()
    {

        $this->add(new HomeForm())
            ->add(new ClientModule())
            ->add(new StoreModule())
            ->add(new OrderModule())
            ->add(new ProfessionalModule())
            ->add(new ShiftModule())
            ->build();
    }
}
