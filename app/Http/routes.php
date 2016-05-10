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

$app->group(['middleware' => 'origin'], function () use ($app) {

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
        /* $app['auth']->viaRequest('api', function ($request) {
<<<<<<< HEAD
          echo $request->input('user') . " " . $request->input('password');
          if ($request->input('user') && $request->input('password')) {
          return \ListIt\User::where(['Name' => $request->input('user') /*,
          'Password' => Hash::make($request->input('password')) ])->first();
          }
          }); */

=======
            echo $request->input('user') . " " . $request->input('password');
            if ($request->input('user') && $request->input('password')) {
                return \ListIt\User::where(['Name' => $request->input('user') /*,
                                            'Password' => Hash::make($request->input('password')) ])->first();
            }
        }); */
        
        $this->validate($request, [
            'user' => 'required',            
            'password' => 'required'
        ]);
        
>>>>>>> 92de3f99675f9fa3f9454b8f1d99562a1d13905c
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

$app->group(['middleware' => ['auth', 'origin']], function () use ($app) {

    $app->get('/users/{id}', function($id) {
        return \ListIt\User::find($id);
    });

    $app->get('/users', function() {
        return \ListIt\User::all();
    });
});



//$app->get('/users/trest', 'UserController@action');