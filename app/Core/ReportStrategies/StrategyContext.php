<?php


namespace App\Core\ReportStrategies;


use App\Core\interfaces\ReportContract;

class StrategyContext
{
    private $strategy;


    public function __construct(ReportContract $strategy)
    {
        $this->strategy = $strategy;
    }

    public function forCanvas(){
        return $this->strategy->forCanvas();
    }

    public function singleElementReport($id){
        return $this->strategy->singleElementReport($id);
    }

}
