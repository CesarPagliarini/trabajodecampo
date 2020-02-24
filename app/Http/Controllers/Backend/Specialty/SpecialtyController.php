<?php

namespace App\Http\Controllers\Backend\Specialty;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Specialty;
use App\Http\Requests\Backend\specialties\SpecialtiesCreateFormRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SpecialtyController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $specialties = Specialty::all();
        return view('backend.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.specialties.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialtiesCreateFormRequest $request)
    {
        DB::beginTransaction();
        try {
            Specialty::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'La especialidad se ha creado exitosamente!');
            return redirect()->route('specialties.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'La especialidad no se pudo crear!');
            return redirect()->route('specialties.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Specialty $Specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {

        $specialty = $specialty::with('services')->first();
        return view('backend.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Specialty $Specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        DB::beginTransaction();
        try {
            $specialty->update($request->all());
            $specialty->services()->sync($request->services);
            DB::commit();
            $request->session()->flash('flash_message', 'La especialidad se ha actualizado exitosamente!');
            return redirect()->route('specialties.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'La especialidad no se pudo actualizar!');
            return redirect()->route('specialties.index');
        }
    }
}
