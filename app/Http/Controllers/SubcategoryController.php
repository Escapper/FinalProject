<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use  App\Models\Subcategory;
use App\Models\Validator\SubcategoryValidation as V;
use App\Models\Collections\SubCategoryCollections;


class SubcategoryController extends Controller
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
        
        $validator =  self::$V->ValidateCreateSubCategory($request->all());

        if ($validator->fails())
            {
    
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
    
                {
    
                    $ErrArr[$field_name] = $messages[0]; 
                    
                }
    
                return  response()->json(['data' => ['errors' => $ErrArr]],422);
            }

        try {


            $Subcategory = new Subcategory;

            $array['name'] =  json_encode($request->name, JSON_UNESCAPED_UNICODE);

            $array['description'] =  json_encode($request->description, JSON_UNESCAPED_UNICODE);

            $array['parent_id'] =  json_encode($request->parent_id, JSON_UNESCAPED_UNICODE);

            $Subcategory->fill($array);

            if($Subcategory->save()){

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

    public function allSubCategories()
    {
        

        $Subcategory =  new Subcategory;

        return new SubCategoryCollections($Subcategory->all());
 
    }


    public function showOneSubCategory($id)
    {
        return response()->json(Subcategory::find($id));
    }


    public function update($id, Request $request)
    {
        $author = Subcategory::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Subcategory::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
    
} 