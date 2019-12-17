<?php


namespace App\Core\interfaces;


interface ReportContract
{
    public function forCanvas();

    public function singleElementReport($id);

}
