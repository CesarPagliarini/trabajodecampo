<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Role;
use App\Entities\User;
use App\Jobs\RegistrationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ProfileController extends BaseController implements ControllerContract
{
    public function register(Request $request){

        try{
            DB::beginTransaction();
            $client = User::create($request->all());
            $client->roles()->sync(Role::where('name', 'Cliente')->first()->id);
//            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
//            $token = '';
//            for ($i = 0; $i < 5; $i++)
//                $token .= $characters[mt_rand(0, 61)];
            $token = 'abc';
            $client->email_verification_token = $token;
            $client->state = '0';
            $client->save();
            $this->dispatch(new RegistrationRequest($client));
            DB::commit();

            Session::put(['internal_message' =>  'Gracias por registrarte, te enviamos un email para confirmar los datos ingresados.']);
            return route('frontend.register-success');
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function confirmToken($token){

        $user = User::where('email_verification_token', $token)->first();
        if($user){
            try{
                DB::beginTransaction();
                $user->state = '1';
                $user->email_verification_token = null;
                $user->email_verified_at = Carbon::now();
                $user->save();
                DB::commit();
                $message = 'Muchas gracias por registrarte';
                return view('frontend.pages.thanks-page', compact('message'));
            }catch(\Exception $e){
                DB::rollBack();
                dd($e->getMessage());
            }
        }else{
            return abort(404);
        }

    }
    public function registerSuccess(Request $request){

        $message = Session::get('internal_message');
        Session::forget(['internal_message']);
        return view('frontend.pages.thanks-page', compact('message'));
    }

    public function profile(){
        $user = Auth::user();
        return view('frontend.pages.profile', compact('user'));
    }


}
