<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;

use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseEntity
{
    use SoftDeletes;


    protected $fillable = [
        'name',
        'description',
        'state'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class,'user_roles'  ,'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions_forms' , 'role_id','permission_id' );
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'role_permissions_forms' , 'role_id', 'form_id' );
    }

    public function hasForm(Form $form)
    {
        if($this->forms->unique()->find($form)){
            return true;
        }else{
            return false;
        }
    }


}
