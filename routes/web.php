<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->post('register', '\App\Http\Controllers\AuthController@register');

$router->get('/', function () use ($router) {

    return $router->app->version();
});

$router->post('login', 'AuthController@login');
$router->post('logout', 'AuthController@logout');
$router->post('refresh', 'AuthController@refresh');
$router->post('me', 'AuthController@me');

 // Matches "/api/profile
 $router->get('profile', 'UserController@profile');

 // Matches "/api/users/1 
 //get one user by id
 $router->get('users/{id}', 'UserController@singleUser');

 // Matches "/api/users
 $router->get('users', 'UserController@allUsers');


 $router->post('categories', 'CategoryController@create');
 $router->get('categories', 'CategoryController@allCategories');
 $router->get('categories/{id}', 'CategoryController@showOneCategory');
 $router->put('categories/{id}', 'CategoryController@update');
 $router->delete('categories/{id}', 'CategoryController@delete');


 $router->post('posts/create', 'PostsController@create');
 $router->get('posts', 'PostsController@allPosts');
 $router->get('posts/{id}', 'PostsController@showOnePost');
 $router->put('posts/{id}', 'PostsController@update');
 $router->delete('posts/{id}', 'PostsController@delete');


 


 $router->post('subcategories', 'SubcategoryController@create');
 $router->get('subcategories', 'SubcategoryController@allSubCategories');
 $router->get('subcategories/{id}', 'SubcategoryController@showOneSubCategory');
 $router->put('subcategories/{id}', 'SubcategoryController@update');
 $router->delete('subcategories/{id}', 'SubcategoryController@delete');

 $router->get('postcategory', 'PostsController@allPostCategory');



 $router->get('chart', 'PostsController@firstChart');


 $router->get('counts', 'PostsController@counts');

 
//    $router->get('/charts', function ()  {
//    return view('firstchart');
// });


