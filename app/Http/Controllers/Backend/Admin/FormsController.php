<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\Controllers\BaseController;
use App\Core\interfaces\ControllerContract;
use App\Entities\Form;
use App\Entities\Module;
use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FormsController extends BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $forms = Form::all()->sortBy('order');
        return view('backend.admin.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules= Module::all();
        return view('backend.admin.forms.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->module_id === 'Null'){
            $request['module_id'] = NULL;
        }

        DB::beginTransaction();
        try{
            $form = Form::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El formulario se ha creado exitosamente!');
            return redirect()->route('forms.index');
        }catch (\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            $request->session()->flash('flash_error', 'El formulario no se pudo crear!');
            return redirect()->route('forms.index');
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
    public function edit(Form $form)
    {
        $modules= Module::all();
        return view('backend.admin.forms.edit', compact('form', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        if($request->module_id === 'Null'){
            $request['module_id'] = NULL;
        }


        DB::beginTransaction();
        try{
            $form->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Formulario se ha actualizado exitosamente!');
            return redirect()->route('forms.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El Formulario no se pudo actualizar!');
            return redirect()->route('forms.index');
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
