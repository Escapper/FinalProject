<?php

namespace App\Models;
    
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Category extends Model 
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','status', 'is_parent', 'has_parent', 'post_id'
    ];


    public function Posts(){
        return $this->belongsTo(Posts::class, 'id');
    }


    public function subcategories() {

        
        return $this->hasMany(Subcategory::class, 'id');
    }
   
    


}