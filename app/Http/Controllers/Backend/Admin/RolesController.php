<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\Controllers\BaseController;
use App\Core\interfaces\ControllerContract;
use App\Entities\Form;
use App\Entities\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends BaseController implements ControllerContract
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();
        return view('backend.admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $rol = Role::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El rol se ha creado exitosamente!');
            return redirect()->route('roles.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El rol no se pudo crear!');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $forms = Form::with('permissions')->get();
        return view('backend.admin.roles.permission-synchronization', compact('role', 'forms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('backend.admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        DB::beginTransaction();
        try{
            $role->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Rol se ha actualizado exitosamente!');
            return redirect()->route('roles.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Rol no se pudo actualizar!');
            return redirect()->route('roles.index');
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
