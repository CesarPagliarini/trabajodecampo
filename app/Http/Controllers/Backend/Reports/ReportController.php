<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Core\Controllers\BaseController;
use Facades\App\Core\Entities\Reporter;
use Illuminate\Http\Request;


class ReportController extends BaseController
{
    public function report(Request $request){

        return Reporter::report($request->resource, $request->endpoint);
    }

    public function reportSingle(Request $request){

        return Reporter::reportSingle($request->resource, $request->singularId);
    }

}
