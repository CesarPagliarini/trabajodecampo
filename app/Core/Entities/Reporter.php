<?php

namespace App\Core\Entities;

use App\Core\interfaces\ReportContract;
use App\Core\ReportStrategies\ClientReportStrategy;
use App\Core\ReportStrategies\OrderReportStrategy;
use App\Core\ReportStrategies\StrategyContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Reporter extends Model
{

    protected $strategy;

    protected $strategies = [
        'sale-order' => OrderReportStrategy::class,
        'client' => ClientReportStrategy::class,
    ];


    public function report($resource, $method){

        try{
            $strategy = new $this->strategies[$resource];
            $context = new StrategyContext($strategy);
            if( ! method_exists($context,$method))  throw new \Exception('Incorrect method', 500);
            return $context->$method();
        }catch (\Exception $e){
            return response()->json([
                'message'=> 'Wrong method requested',
                'aviable methods' => array_keys($this->strategies),
                'error' => true,
                'errors_message' => $e->getMessage()
            ]);
        }
    }
    public function reportSingle($resource, $singularId){
        try{
            $strategy = new $this->strategies[$resource];
            $context = new StrategyContext($strategy);

            return $context->singleElementReport($singularId);

        }catch (\Exception $e){
            return response()->json([
                'message'=> 'Wrong method requested',
                'aviable methods' => array_keys($this->strategies),
                'error' => true,
                'errors_message' => $e->getMessage()
            ]);
        }
    }







}
