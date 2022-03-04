<?php

namespace App\Models\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;


class PostCollections extends ResourceCollection
{

    public static $wrap = 'data';

    public function toArray($request)
    {
        return $this->collection->map(function($data) {


           

            $data->title = json_decode($data->title);

            $data->content = json_decode($data->content);

            $data->keywords = json_decode($data->keywords);

            $data->status = json_decode($data->status);

            $data->author = json_decode($data->author);

            $data->category_id = json_decode($data->category_id);

            return [
                        
                'id' => $data->id,

                'title' =>  $data->title,

                'content' =>  $data->content,

                'status' => $data->status,

                'author' => $data->author,

                'keywords' => $data->keywords,

                'category_id' => $data->category_id

                
        ];
           
     
    });

}


}


              
