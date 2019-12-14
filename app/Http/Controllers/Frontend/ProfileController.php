<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Role;
use App\Entities\User;
use App\Jobs\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileController extends BaseController implements ControllerContract
{
    public function register(Request $request){

        try{
            DB::beginTransaction();
            $client = User::create($request->all());
            $client->roles()->sync(Role::where('name', 'Cliente')->first()->id);
            $client->email_verification_token = 'aaabbbccc';
            $client->state = '0';
            $client->save();
            $this->dispatch(new RegistrationRequest($client));

            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'Felicidades, pronto recibiras un correo con los pasos a seguir!'
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function confirmToken($token){

    }
}
