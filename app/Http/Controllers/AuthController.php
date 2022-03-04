<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Validator\UserValidation as V;

class AuthController extends Controller
{

    protected static $V;
    protected static $Auth;

    public static function init(){
        self::$V = new V;
        self::$Auth = new Auth;
    }

    

     /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        $validator =  self::$V->ValidateRegister($request->all());

        if ($validator->fails())
            {
    
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
    
                {
    
                    $ErrArr[$field_name] = $messages[0]; 
                    
                }
    
                return  response()->json(['data' => ['errors' => $ErrArr]],422);
            }

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

           
    
           
            $user->save();

            //return successful response
            

            $credentials = request(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return response()->json(['user' => $user, $this->respondWithToken($token)], 201);
           
            
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' =>  $e], 409);
        }
       
       
    }
  
    






    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register', 'me']]);
        self::init();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validator =  self::$V->ValidateLogin($request->all());

        if ($validator->fails())
            {
    
                foreach ($validator->messages()->getMessages() as $field_name => $messages)
    
                {
    
                    $ErrArr[$field_name] = $messages[0]; 
                    
                }
    
                return  response()->json(['data' => ['errors' => $ErrArr]],422);
            }

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}