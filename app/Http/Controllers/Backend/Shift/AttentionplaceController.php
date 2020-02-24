<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Entities\AttentionPlace;
use App\Http\Requests\Backend\attentionplaces\AttentionplacesCreateFormRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\attentionplaces\AttentionplacesUpdateFormRequest;
use Illuminate\Support\Facades\DB;

class AttentionplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attention_places = AttentionPlace::all();
        return view('backend.attention-places.index',compact('attention_places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.attention-places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttentionplacesCreateFormRequest $request)
    {
        DB::beginTransaction();
        try{
            AttentionPlace::create($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Centro de atencion se ha creado exitosamente!');
            return redirect()->route('attention-places.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El Centro de atencion no se pudo crear!');
            return redirect()->route('attention-places.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param AttentionPlace $attention_place
     * @return \Illuminate\Http\Response
     */
    public function edit(AttentionPlace $attention_place)
    {
        return view('backend.attention-places.edit', compact('attention_place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttentionplacesUpdateFormRequest $request, AttentionPlace $attention_place)
    {
        DB::beginTransaction();
        try{
            $attention_place->update($request->all());
            DB::commit();
            $request->session()->flash('flash_message', 'El Centro de atencion se ha actualizado exitosamente!');
            return redirect()->route('attention-places.index');
        }catch (\Exception $e){

            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El Centro de atencion no se pudo actualizar!');
            return redirect()->route('attention-places.index');
        }
    }

}
