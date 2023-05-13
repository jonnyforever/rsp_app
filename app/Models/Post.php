<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $directory = "/images/";

    //this defines the table name
    protected $table = "posts";

    //this defines the primary key of the table
    protected $primaryKey = "id";

    //this allows the user of the function 'create' in eloquent 
    //fields must be 'whitelisted' in the class variable array below
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'path'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User'/*, 'id'*/);
    }
    
    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    public function getPathAttribute($value){
        return $this->directory . $value;
    }

    public static function scopeLatest($query){
        return $query->orderBy('id', 'desc')->get();
    }
}
