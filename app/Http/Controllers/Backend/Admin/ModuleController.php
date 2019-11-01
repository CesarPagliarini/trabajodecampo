<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\Controllers\BaseController;
use App\Core\interfaces\ControllerContract;
use App\Entities\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModuleController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all()->sortBy('order');
        return view('backend.admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.modules.create');
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
            $module = Module::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El módulo se ha creado exitosamente!');
            return redirect()->route('modules.index');
        }catch (\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            $request->session()->flash('flash_error', 'El módulo no se pudo crear!');
            return redirect()->route('modules.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        return view('backend.admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        DB::beginTransaction();
        try{
            $module->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Módulo se ha actualizado exitosamente!');
            return redirect()->route('modules.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Módulo no se pudo actualizar!');
            return redirect()->route('modules.index');
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
