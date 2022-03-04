<?php

namespace App\Models\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostsValidation extends Controller
{
     public function ValidateCreatePosts($data){

        return Validator::make($data, [

           'title' => 'required|max:255',

          'content' => 'required',

          'author' => 'required',

          'status' => 'required',

          'keywords' => 'required|array',

          'category_id' => 'required'

             ]);
    }




}    