<?php


namespace App\Core\ReportStrategies;


use App\Core\interfaces\ReportContract;

class ClientReportStrategy implements ReportContract
{

    public function forCanvas()
    {
        return 'client report';
    }

    public function singleElementReport($id)
    {
        // TODO: Implement singleElementReport() method.
    }
}
