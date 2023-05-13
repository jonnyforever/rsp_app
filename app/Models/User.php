<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'note',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function post(){
        return $this->hasOne('App\Models\Post', 'user_id');
    }

    public function get_all_posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function get_roles(){
        //return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', "role_id");

        return $this->belongsToMany('App\Models\Role')->withPivot('created_at');

        //if a different table is required, use the commented line above to customize table names
    }
    
    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
    /**
     * This is an accessor 
     * When retrieving the User info, the name will be set as described in this function
     * - see route : get_name
     */
    public function getNameAttribute($value){
        return ucfirst($value);
    }

    /**
     * This is a mutator
     * When saving this field in the database, it will mutate the value according to the function
     * - see route : set_name
     */
    public function setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function isAdmin(){
        if($this->role->name == 'admin'){
            return true;
        }
        return false;
    }
}
