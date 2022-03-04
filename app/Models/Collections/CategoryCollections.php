<?php

namespace App\Models\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CategoryCollections extends ResourceCollection
{

    public static $wrap = 'data';

    public function toArray($request)
    {
        return $this->collection->map(function($data) {


         

            $data->name = json_decode($data->name);

            $data->description = json_decode($data->description);



            return [
                        
                'id' => $data->id,

                'name' =>  $data->name,

                'description' =>  $data->description,

                'status' => $data->status,

                'is_parent' => $data->is_parent,

                'has_parent' => $data->has_parent,

                'post_id' => $data->post_id,

               

                
        ];
           
     
    });

}


}


              
