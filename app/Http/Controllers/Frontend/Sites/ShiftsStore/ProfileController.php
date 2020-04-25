<?php

namespace App\Http\Controllers\Frontend\Sites\ShiftsStore;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Role;
use App\Entities\Client;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProfileController extends BaseController implements ControllerContract
{
    public function register(Request $request){

        $rules = [
            'register_name' => 'required',
            'register_last_name' => 'required',
            'register_password' => 'required|unique:users',
            'email' => 'required',
        ];
        $messages = [
            'register_name.required' => 'debes ingresar tu nombre',
            'register_last_name.required' => 'debes ingresar tu apellido',
            'email.required' => 'debes ingresar un email valido',
            'email.unique' => 'el email ingresado se encuentra en uso',
            'register_password.required' => 'debes ingresar un password',

        ];
        $validator = Validator::make($request->all(),$rules , $messages );
        if($validator->fails()){

            return redirect()->back()->withErrors($validator->errors());
        }

        try{
            DB::beginTransaction();
            $clientData = [
              'name' => $request['register_name'],
              'last_name' => $request['register_last_name'],
              'password' => $request['register_password'],
              'email' => $request['register_email'],
            ];

            $client = Client::create($clientData);
            $client->roles()->sync(Role::where('name', 'Cliente')->first()->id);
            $client->state = '1';
            $client->save();
            DB::commit();
            return view('frontend.sites.shifts-store.pages.profile');
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }



}
