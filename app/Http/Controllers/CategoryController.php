<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use  App\Models\Category;
use App\Models\Validator\CategoryValidation as V;
use App\Models\Collections\CategoryCollections;


class CategoryController extends Controller
{

    protected static $V;

    public static function init(){
        self::$V = new V;
    }

    public function __construct()
    {
        
        self::init();
    }

 /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
        
        $validator =  self::$V->ValidateCreateCategory($request->all());

        if ($validator->fails())
            {
    
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
    
                {
    
                    $ErrArr[$field_name] = $messages[0]; 
                    
                }
    
                return  response()->json(['data' => ['errors' => $ErrArr]],422);
            }

        try {


            $Category = new Category;

            $array['name'] =  json_encode($request->name, JSON_UNESCAPED_UNICODE);

            $array['description'] =  json_encode($request->description, JSON_UNESCAPED_UNICODE);

            $array['status'] = 1;

            $array['is_parent'] =  json_encode($request->is_parent);

            $array['has_parent'] =  json_encode($request->has_parent);

            $array['post_id'] =  json_encode($request->post_id);

           

            

            $Category->fill($array);

            if($Category->save()){

                return  response()->json([
   
                    'msg' => 'Category Create Success!',
       
                    'status' => true,
       
                ], 200);
    
            }

        }catch (\Illuminate\Database\QueryException $e) {
      
            return  response()->json([
   
                'msg' => 'Category Create Failed!',
   
                'errors' => $e,
   
            ], 422);
   
        }

    }

    public function allCategories()
    {
        

        $Category =  new Category;

        return new CategoryCollections($Category->all());
 
    }


    public function showOneCategory($id)
    {
        return response()->json(Category::find($id));
    }


    public function update($id, Request $request)
    {
        $author = Category::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
} 