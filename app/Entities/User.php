<?php

namespace App\Entities;




use App\Core\Entities\BaseEntity;

use App\Core\Traits\RulesManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class User extends BaseEntity implements Authenticatable
{

    use AuthenticableTrait, Notifiable, RulesManager, SerializesModels;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'state',
        'last_name',
        'address',
        'cel_phone',
        'city',
        'region',
        'zip_code',
        'country',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $password
     * @return Void
     */
    public function setPasswordAttribute($password): Void{

        if (!empty($password) && Hash::needsRehash($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }else{
            $this->attributes['password'] = $this->$password;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles'  ,'user_id');
    }

    public function getFormsAttribute()
    {
        $filtered = new Collection();
        foreach($this->roles as $rol){
           $filtered = $filtered->merge($rol->forms->unique());
        }
        if(!$filtered->count()){
            return new Collection();
        }
        return $filtered;
    }
    public function roleList()
    {
        return $this->belongsToMany(Role::class,'user_roles'  ,'user_id')
            ->select('name');
    }


}
