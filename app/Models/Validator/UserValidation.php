<?php

namespace App\Models\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserValidation extends Controller
{
     public function ValidateLogin($data){

        return Validator::make($data, [

          'email' => 'required|email',

          'password' => 'required',  

             ]);
    }

    public function ValidateRegister($data){

        return Validator::make($data, [

            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required', 

             ]);
    }




}    