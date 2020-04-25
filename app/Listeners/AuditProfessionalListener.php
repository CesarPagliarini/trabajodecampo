<?php

namespace App\Listeners;

use App\Events\AuditProfessionalSetting;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuditProfessionalListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */


    public function handle(AuditProfessionalSetting $event)
    {

        try{
            Log::channel('audition_log')->critical($event->professional_setting);
            DB::beginTransaction();
            DB::table('table_professional_settings_auditable')->insert([
                'id' => $event->professional_setting['id'],
                'professional_id' => $event->user->id ,
                'specialty_id' => $event->professional_setting['specialty_id'],
                'service_id' => $event->professional_setting['specialty_id'],
                'attention_place_id' => $event->professional_setting['service_id'],
                'time_unit' => $event->professional_setting['attention_place_id'],
                'work_holiday' => $event->professional_setting['time_unit'],
                'show_amount' => $event->professional_setting['work_holiday'],
                'is_highlighted' => $event->professional_setting['show_amount'],
                'currency_id' => $event->professional_setting['is_highlighted'],
                'amount' => $event->professional_setting['currency_id'],
                'is_temporal' => $event->professional_setting['amount'],
                'state' => $event->professional_setting['is_temporal'],
                'user_auditable' => $event->user->id,
                'movement_type' => $event->event_type,
                'created_at' => now(),
            ]);
            DB::commit();
        }catch(\Exception $e){
            $message = '['.Carbon::now().']';
            $message .= $e->getMessage();
            Log::channel('audition_log')->critical($message);
        }






    }
}
