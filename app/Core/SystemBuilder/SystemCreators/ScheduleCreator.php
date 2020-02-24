<?php
namespace App\Core\SystemBuilder\SystemCreators;

use App\Core\SystemBuilder\AttentionPlaces\AttentionPlacesModule;
use App\Core\SystemBuilder\Professional\ProfessionalModule;
use App\Core\SystemBuilder\Shifts\ShiftModule;
use App\Core\SystemBuilder\StandAlone\HomeForm;
use App\Core\SystemBuilder\SystemCreator;


class ScheduleCreator extends SystemCreator
{

    public  function run()
    {

        $this->add(new HomeForm())
            ->add(new ProfessionalModule())
            ->add(new ShiftModule())
            ->add(new AttentionPlacesModule())
            ->build();
    }
}
