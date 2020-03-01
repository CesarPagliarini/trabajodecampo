<?php


namespace App\Core\Repositories;


use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Entities\Schedule;
use App\Entities\ScheduleHeader;
use App\Jobs\ProcessScheduleCreation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ProfessionalScheduleRepository implements ProfessionalScheduleRepositoryInterface
{
    protected $schedule;
    protected $scheduleHeader;
    public function __construct(Schedule $schedule, ScheduleHeader $scheduleHeader)
    {
        $this->schedule = $schedule;
        $this->scheduleHeader = $scheduleHeader;
    }

    public function all($data)
    {
        return response()->json($data);
    }

    public function create(array $data)
    {

        try
        {
            DB::beginTransaction();
            $this->scheduleHeader->checkAndInsert($data);
            DB::commit();
            ProcessScheduleCreation::dispatch($this->scheduleHeader, $data)->onQueue('high');
            return response()->json([
                'error' => false,
                'message' => 'Se ha guardado con exito la configuracion',
                'inserted_data' => $this->scheduleHeader,
            ]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }





    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
}
