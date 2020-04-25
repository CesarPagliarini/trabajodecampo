<?php
namespace App\Core\SystemBuilder\SystemCreators;

use App\Core\interfaces\SystemCreatorContract;
use App\Core\SystemBuilder\AttentionPlaces\AttentionPlacesModule;
use App\Core\SystemBuilder\Client\ClientModule;
use App\Core\SystemBuilder\Professional\ProfessionalModule;
use App\Core\SystemBuilder\Shifts\ShiftModule;
use App\Core\SystemBuilder\StandAlone\HomeForm;
use App\Core\SystemBuilder\SystemCreator;


class ScheduleCreator extends SystemCreator implements SystemCreatorContract
{

    public  function run()
    {

        $this->add(new HomeForm())
            ->add(new ProfessionalModule())
            ->add(new ClientModule())
            ->add(new ShiftModule())
            ->add(new AttentionPlacesModule())
            ->build();
    }

    public function skin(): string
    {
        return 'shifts-store';
    }

    public function name(): string
    {
        return 'sissors_fire';
    }
}
