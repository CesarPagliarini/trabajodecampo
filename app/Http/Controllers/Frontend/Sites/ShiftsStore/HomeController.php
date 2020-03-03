<?php

namespace App\Http\Controllers\Frontend\Sites\ShiftsStore;

use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Entities\AttentionCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $scheduleRepository;
    public function __construct( ProfessionalScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function aboutUs()
    {

        return view('frontend.sites.shifts-store.pages.about-us');
    }

    public function galery()
    {
        return view('frontend.sites.shifts-store.pages.galery');
    }

    public function shifts()
    {
        Session::forget('last_filtered_shifts');
        return view('frontend.sites.shifts-store.pages.shifts');
    }
    public function profile()
    {
        $owned_shifts = $this->scheduleRepository->getShiftsFor(Auth::user()->id);

        if($owned_shifts){
            foreach($owned_shifts as $shift)
            {

                $to = Carbon::createFromFormat('H:i:s', $shift->to);
                $from =Carbon::createFromFormat('H:i:s', $shift->from);
                $today = Carbon::now();
                $diference= $today->diffInDays($shift->schedule_date);
                $shift->{'days_remain'} = $diference;
                $shift->to = $to->format('H:i');
                $shift->from =$from->format('H:i');
                $shift->schedule_date = Carbon::createFromFormat('Y-m-d', $shift->schedule_date)->format('d/m/Y');

            }
        }

        return view('frontend.sites.shifts-store.pages.profile', compact('owned_shifts'));
    }
}
