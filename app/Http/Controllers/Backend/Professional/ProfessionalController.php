<?php

namespace App\Http\Controllers\Backend\Professional;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use App\Core\interfaces\ShiftsModuleContract;
use App\Entities\Professional;
use App\Entities\Role;
use App\Entities\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionalController extends  BaseController implements ControllerContract, ShiftsModuleContract
{

    protected $shiftRepository;

    public function __construct(ProfessionalSettingRepositoryInterface $shiftRepo)
    {
        $this->shiftRepository = $shiftRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professionals = Professional::allProfessionals('active');
        return view('backend.professionals.active-index', compact('professionals'));
    }
    public function unactives()
    {
        $professionals = Professional::allProfessionals('unactive');
        return view('backend.professionals.unactive-index', compact('professionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.professionals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $professional = Professional::create($request->all());
            $professional->roles()->sync(Role::where('name', 'Profesional')->first()->id);
            $professional->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El Profesional se ha creado exitosamente!');
            return redirect()->route('professionals.index');
        }catch (\Exception $e){

            DB::rollBack();
            $request->session()->flash('flash_error', 'El Profesional no se pudo crear!');
            return redirect()->route('professionals.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Professional $professional
     * @return \Illuminate\Http\Response
     */
    public function edit(Professional $professional)
    {
        $professional = Professional::where('id', $professional->id)->with('settings')->first();

        $specialties = Specialty::whereHas('services')->get();
        return view('backend.professionals.edit', compact('professional', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professional $professional)
    {

        DB::beginTransaction();
        try{
            $stmt = $request->password == '' ? $request->except('password') : $request->all();
            $professional->update($stmt);
            $professional->roles()->sync(Role::where('name', 'Profesional')->first()->id);
            $professional->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El profesional se ha actualizado exitosamente!');
            return redirect()->route('professionals.index');

        }catch (\Exception $e){
            DB::rollBack();

            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('professionals.index');
        }

    }

    public function updateSpecialties(Request $request)
    {
        DB::beginTransaction();
        try{
            $professional_id = $request->professional_id;
            $specialty_id = $request->specialty_id;
            $delete = DB::table('specialty_user')
                ->where('user_id',$professional_id)
                ->where('specialty_id', $specialty_id);
            $query = DB::table('specialty_user');
            ($request->action === 'attach')
                ? $query->insert(['user_id' =>  $professional_id, 'specialty_id' => $specialty_id])
                : $delete->delete();

            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'success',
            ]);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }

    }


}
