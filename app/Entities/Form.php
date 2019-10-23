<?php

namespace App\Entities;


use App\Core\interfaces\ComponentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Form extends Model implements ComponentInterface
{
    protected $fillable = [
        'module_id',
        'name',
        'key',
        'target',
        'icon',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions_forms' , 'form_id' );
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions_forms' , 'permission_id' );
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'id','module_id');
    }

    public function getUsersAttribute()
    {
        $filtered = new Collection();
        foreach($this->roles as $rol){
            $filtered->push($rol->users->unique());
        }
        return $filtered;
    }



    public function render()
    {
        return '
             <li class="'.$this->checkActive().'">
                <a href="'.url($this->target).'"><i class="'.$this->icon.'"></i> 
                    <span class="nav-label">
                        '.$this->name.'
                    </span>
                </a>
            </li>
        ';
    }

    public function checkActive()
    {
        return Route::current()->uri === $this->target ? 'active' : '';
    }
}
