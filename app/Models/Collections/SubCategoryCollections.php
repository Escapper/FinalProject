<?php

namespace App\Models\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;


class SubCategoryCollections extends ResourceCollection
{

    public static $wrap = 'data';

    public function toArray($request)
    {
        return $this->collection->map(function($data) {


         

            $data->name = json_decode($data->name);

            $data->description = json_decode($data->description);

            $data->parent_id = json_decode($data->parent_id);



            return [
                        
                'id' => $data->id,

                'name' =>  $data->name,

                'description' =>  $data->description,

                'parent_id' => $data->parent_id,

                
                
        ];
           
     
    });

}


}


              
