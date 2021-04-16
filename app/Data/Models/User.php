<?php

namespace App\Data\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'email_verified_at',
        'is_active',
        'is_blocked',
        'name',
        'email',
        'password',
    ];

    protected $table = "users";

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

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }

    public function getDisplayName()
    {
        try {
            $first_name = trim($this->person->first_name) . " ";

            $middle_name = trim($this->person->middle_name) . " ";

            $last_name = trim($this->person->last_name) . " ";

            $person_name = $first_name . $middle_name . $last_name;

            if (strlen(trim($person_name)) > 0) {
                return $person_name . " ($this->name)";
            } else {
                return $this->name;
            }


        } catch (\Exception $e) {
            return $this->name;
        }
    }

    public function isInRole($roleArrayOrString){
        if (!is_array($roleArrayOrString)) $roleArrayOrString = explode(",", $roleArrayOrString);
        foreach ($roleArrayOrString as $role){
            $r = $this->roles()->firstWhere("name", $role);
            if (null != $r) return true;
        }
        return false;
    }

    public function person()
    {
        return $this->hasOne(Peron::class, "user_id", "id");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, "user_roles", "user_id", "role_id");
    }
}
