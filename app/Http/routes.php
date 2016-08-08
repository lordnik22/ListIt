<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use ListIt\APIToken;
use \ListIt\Services\ConversionService;
use Illuminate\Http\RedirectResponse;

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

/* $app->get('/', function () use ($app) {
  return $app->version();
  }); */

$app->group(['middleware' => 'origin', 'prefix' => '/api', 'namespace' => 'ListIt\Http\Controllers\Api'], function () use ($app) {

    $app->get('/', function() {
        /* $user = new \ListIt\User();
          $user->Name = 'michi';
          $user->Email = 'michi@michi.michi';
          $user->Password = Hash::make('michi');
          $user->save(); */
        return view('index');
        //return response()->json(['error' => 'asdasdasd'], 401);
    });

    $app->post('/login', function(Request $request) {
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required'
        ]);        
        
        if ($request->input('user') && $request->input('password')) {
            $user = \ListIt\User::where(['Name' => $request->input('user')])->first();

            if ($user != null && Hash::check($request->input('password'), $user->Password)) {
                $user->APIToken = APIToken::generateToken(255);

                $user->save();
            }
            return response()->json(['APIToken' => $user->APIToken]);
        }
        return response()->json(['error' => 'Authentication Failed'], 403);
    });


    $app->post('/users', 'UserController@create');



    $app->get('/test', function(Request $req) {
        return 'Hello, ' . $req->input('name');
    });
});

$app->group(['middleware' => ['auth', 'origin'], 'prefix' => '/api', 'namespace' => 'ListIt\Http\Controllers\Api'], function () use ($app) {

    $app->get('/users/{id}', function($id) {
        return \ListIt\User::find($id);
    });

    $app->get('/users', 'UserController@get');   
    
    $app->get('/receipts', 'ReceiptController@get');                             

    $app->get('/receipts/{id}', 'ReceiptController@getOne');

    $app->post('/products', 'ProductController@create');
    
    $app->get('/products', 'ProductController@get');    
    
    $app->get('/products/{id}', function($id) {        
        return \ListIt\Product::where('ProductID', $id);
    });
    
    $app->delete('/receipts/{id}', function($id) {
        \ListIt\Receipt_Product::where('ReceiptID', $id)->delete();
        \ListIt\Receipt::find($id)->delete();
    });
});

$app->group(['middleware' => 'origin', 'namespace' => '\ListIt\Http\Controllers'], function () use ($app) {
    
    
    $app->get('/', 'HomeController@index');
    
    $app->post('/login', function(Request $request) {
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required'
        ]);                        
        
        if ($request->input('user') && $request->input('password')) {
            $user = \ListIt\User::where(['Name' => $request->input('user')])->first();                                     
        
            if ($user != null && Hash::check($request->input('password'), $user->Password)) {
                $user->APIToken = APIToken::generateToken(255);

                $user->save();
                
                $request->session()->put('api-token', $user->APIToken);
                return RedirectResponse::create('/receipts');                
            }                                                                      
        }
        return RedirectResponse::create('/');
        
    });            
    
    $app->post('/users', function(Request $request) {
        $this->validate($request, [
            'user' => 'required|unique:user,Name',
            'email' => 'required|email|unique:user,Email',
            'password' => 'required'
        ]);

        $user = new \ListIt\User();
        $user->Name = $request->input('user');
        $user->Email = $request->input('email');
        $user->Password = Hash::make($request->input('password'));
        
        $user->save();
        
        return redirect('login');
    });
    
    
    
});

$app->group(['middleware' => 'auth', 'origin', 'namespace' => '\ListIt\Http\Controllers'], function () use ($app) {       
    
    // RECEIPTS //       
    
    $app->get('/receipt/new', function() {
        return view('createreceipt');
    });
    
    $app->post('/receipt', 'ReceiptController@create');
    
    $app->get('/receipt/{id}/update', 'ReceiptController@showReceiptForm');
    
    $app->put('/receipt/{id}', 'ReceiptController@update');
    
    $app->get('/receipt/{id}', 'ReceiptController@getOne');
    
    $app->get('/receipts', 'ReceiptController@get');        
    
    $app->delete('/receipt/{id}', 'ReceiptController@delete');
    
    // PRODUCTS //
    
    $app->get('/receipt/{id}/product/new', function($id) {                                         
        return view('createproduct', ['ID' => $id]);
    });
    
    $app->post('/receipt/{id}/product', 'ProductController@create');        
    
    $app->get('/receipt/{id}/receiptproduct/{receiptproductid}/update', 'ProductController@showProductForm');
    
    $app->put('/receipt/{id}/receiptproduct/{receiptproductid}', 'ProductController@update');
    
    $app->delete('/receipt/{id}/receiptproduct/{receiptproductid}', function($id, $receiptproductid)  {                
        \ListIt\Receipt_Product::findOrFail($receiptproductid)->delete();                     
        
        return redirect('/receipt/'. $id);
    });     
    
    // STATISTICS //
    
    $app->get('/stats', 'StatisticController@get');
    
    $app->post('/compareYears', 'StatisticController@compareYears');
        
    $app->get('/logout', function(Request $request) {        
        $request->session()->forget('api-token');
        
        return redirect('/');
    });
    
});





//$app->get('/users/trest', 'UserController@action');