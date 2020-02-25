<?php


namespace App\Core\interfaces;

interface ShiftsModuleContract
{
    /**
     * ShiftsModuleContract constructor.
     * @param ProfessionalSettingRepositoryInterface $shiftRepo
     */
    public function __construct(ProfessionalSettingRepositoryInterface $shiftRepo);
}
