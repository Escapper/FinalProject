<?php

namespace App\Models\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;



class UsersCollections extends ResourceCollection
{

    public static $wrap = 'data';

    public function toArray($request)
    {
        return $this->collection->map(function($data) {


            

    

            $data->name = ($data->name);

            $data->email = ($data->email);

            $data->id = json_decode($data->id);

          

            return [
                        
                'id' => $data->id,

                'name' =>  $data->name,

                'email' =>  $data->email,


                
        ];
           
     
    });

}


}


              
