<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use ListIt\APIToken;

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

    $app->get('/receipts', function() {
        return json_encode(\ListIt\Receipt::with('receipt_products', 'receipt_products.product')->get()->map('getJsonReceipt'), JSON_PRETTY_PRINT);

        /* return json_encode(array_merge(\ListIt\Receipt::with('receipt_products', 'receipt_products.product')->get()->map(function($receipt) {
          return getjsonReceipt($receipt);
          })->toArray(), ['SQLQueries' => \DB::getQueryLog()]), JSON_PRETTY_PRINT); */
    });            

    $app->get('/receipts/{id}', 'ReceiptController@get($id)');

    $app->get('/products', function() {
        return \ListIt\Product::all();
    });
    
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
    
    $app->get('/login', function() {
        return view('login', ['name' => 'Peter "><script>alert(1)</script>']);
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
    });



    $app->get('/test', function(Request $req) {
        return 'Hello, ' . $req->input('name');
    });
});




//$app->get('/users/trest', 'UserController@action');