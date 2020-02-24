<?php

namespace App\Http\Controllers\Backend\Professional;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Role;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionalController extends  BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professionals = User::allProfessionals('active');
        return view('backend.professionals.active-index', compact('professionals'));
    }
    public function unactives()
    {
        $professionals = User::allProfessionals('unactive');
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
            $user = User::create($request->all());
            $user->roles()->sync(Role::where('name', 'Profesional')->first()->id);
            $user->save();
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $professional)
    {

        return view('backend.professionals.edit', compact('professional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $professional)
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
}
