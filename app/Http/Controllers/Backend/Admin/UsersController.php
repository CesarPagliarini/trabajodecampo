<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Core\Controllers\BaseController;
use App\Core\interfaces\ControllerContract;
use App\Entities\Role;
use App\Entities\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UsersController extends BaseController implements ControllerContract
{
    public function __construct(){
        $this->model = new User;
    }

    public function index()
    {

        $users = User::all();
        return view('backend.admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.admin.users.edit', compact('user','roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = User::create($request->all());
            $user->roles()->sync($request->roles);
            $user->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha creado exitosamente!');
            return redirect()->route('users.index');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', 'El usuario no se pudo crear!');
            return redirect()->route('users.index');
        }

    }
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        try{
            $stmt = $request->password == '' ? $request->except('password') : $request->all();
            $user->update($stmt);
            $user->roles()->sync($request->roles);
            $user->save();

            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha actualizado exitosamente!');
            return redirect()->route('users.index');

        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('users.index');
        }

    }


}
