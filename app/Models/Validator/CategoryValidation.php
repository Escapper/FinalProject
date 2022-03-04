<?php

namespace App\Models\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryValidation extends Controller
{
     public function ValidateCreateCategory($data){

        return Validator::make($data, [

          'name' => 'required',

          'description' => 'required',

          'status' => 'required',

          'is_parent' => 'required',

          'has_parent' => 'required',

             ]);
    }




}    