<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\Posts;
use App\Models\Validator\PostsValidation as V;
use App\Models\Collections\PostCollections;
use App\Models\Category;
use Khill\Lavacharts\Lavacharts;
use App\Models\Subcategory;
use Khill\Lavacharts\Laravel\LavachartsServiceProvider;
use Khill\Lavacharts\Laravel\LavachartsFacade;




class PostsController extends Controller
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
        
        $validator =  self::$V->ValidateCreatePosts($request->all());

        if ($validator->fails())
            {
    
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
    
                {
    
                    $ErrArr[$field_name] = $messages[0]; 
                    
                }
    
                return  response()->json(['data' => ['errors' => $ErrArr]],422);
            }

        try {


            $Posts = new Posts;

            $array['title'] =  json_encode($request->title);

            $array['content'] =  json_encode($request->content);

            $array['status'] = 1;

            $array['author'] =  json_encode($request->author);

            $array['keywords'] =  json_encode($request->keywords);

            $array['category_id'] = json_decode($request->category_id);

            $Posts->fill($array);

            if($Posts->save()){

                return  response()->json([
   
                    'msg' => 'Posts Create Success!',
       
                    'status' => true,
       
                ], 200);
    
            }

        }catch (\Illuminate\Database\QueryException $e) {
      
            return  response()->json([
   
                'msg' => 'Posts Create Failed!',
   
                'errors' => $e,
   
            ], 422);
   
        }

    }



 public function allPosts()
    {


        $Posts = Posts::get();

     //   return new PostCollections($Posts->all());

    //    return view('firstchart', compact('Posts'));

    }

    public function showOnePost($id)
    {
        return response()->json(Posts::find($id));
    }

    public function update($id, Request $request)
    {
        $author = Posts::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Posts::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

    public function allPostCategory() {
        $Category = Category::find(13);

        return $Category->Posts->keywords;
    }


public function firstChart() {
    $lava = new Lavacharts; 

    $votes  = $lava->DataTable();
    
    $votes->addStringColumn('Food Poll')
          ->addNumberColumn('Votes')
          ->addRow(['Tacos',  rand(1000,5000)])
          ->addRow(['Salad',  rand(1000,5000)])
          ->addRow(['Pizza',  rand(1000,5000)])
          ->addRow(['Apples', rand(1000,5000)])
          ->addRow(['Fish',   rand(1000,5000)]);
    
    $lava->BarChart('Votes', $votes);


    }

public function counts(Request $request) {



            

        
            $lava = new Lavacharts; 

    $reasons = $lava->DataTable();
    
    $reasons->addStringColumn('Total Number Of Doctors')
            ->addNumberColumn('Percent')
            ->addRow(['Single Doctor', 198])
            ->addRow(['Doctor Belongs to a center', 17]);
           
    
    $lava->DonutChart('Doctors', $reasons, [
        'title' => 'Total Number Of Doctors'
    ]);
    
    
       return view('firstchart', compact('lava'));

    }




}    