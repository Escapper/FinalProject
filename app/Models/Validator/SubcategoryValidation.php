<?php

namespace App\Models\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubcategoryValidation extends Controller
{
     public function ValidateCreateSubCategory($data){

        return Validator::make($data, [

          'name' => 'required',

          'description' => 'required',

          'parent_id' => 'required'

         

             ]);
    }




}    