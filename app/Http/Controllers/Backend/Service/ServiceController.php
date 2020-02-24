<?php

namespace App\Http\Controllers\Backend\Service;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\AttentionPlace;
use App\Entities\Service;
use App\Entities\Specialty;
use App\Http\Requests\Backend\services\ServicesCreateFormRequest;
use App\Http\Requests\Backend\services\ServicesUpdateFormRequest;
use App\Http\Requests\Backend\specialties\SpecialtiesUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServiceController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Specialty::actives();
        return view('backend.services.create', compact('specialties'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesCreateFormRequest $request)
    {
        DB::beginTransaction();
        try{
            $service = Service::create($request->all());
            $service->specialties()->sync($request->specialties);
            DB::commit();
            $request->session()->flash('flash_message', 'El servicio se ha creado exitosamente!');
            return redirect()->route('services.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El servicio no se pudo crear!');
            return redirect()->route('services.index')->withErrors();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $specialties = Specialty::actives();
        return view('backend.services.edit', compact('service', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServicesUpdateFormRequest $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServicesUpdateFormRequest $request, Service $service)
    {
        DB::beginTransaction();
        try{

            $service->update($request->all());
            $service->specialties()->sync($request->specialties);

            DB::commit();
            $request->session()->flash('flash_message', 'El servicio se ha actualizado exitosamente!');
            return redirect()->route('services.index');

        }catch (\Exception $e){

            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('services.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
