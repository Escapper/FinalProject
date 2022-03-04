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

class Posts extends Model 
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'post';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content','status', 'keywords', 'author', 'category_id'
    ];


   
        protected $casts = [
            'keywords' => 'array'
        ];
    
    
    public function category() {


        return $this->hasMany(Category::class, 'id');
    }

    

}