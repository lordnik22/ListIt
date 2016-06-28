<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use ListIt\APIToken;
use \ListIt\Services\ConversionService;

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
    
    $app->get('/login', function() {
        return view('login', ['name' => 'alpha', 'password' => 'beta']);
    });
    
    $app->get('/register', function() {
        return view('register');
    });
    
    
    //Startseite
    $app->get('/index', function() {
        return view('index', ['name' => 'alpha', 'password' => 'beta']);
    });
    $app->get('/home', function() {
        return view('index', ['name' => 'alpha', 'password' => 'beta']);
    });
    //---------
    
    
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
            }                                                                      
        }
        return redirect('receipts');
        //$request->session()->put('key', 'value');               
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
    
    $app->get('/receipts', 'ReceiptController@get');
    
    $app->get('/receipt/{id}', 'ReceiptController@getOne');
    
    $app->get('/receipt/{id}/createproduct', function() {                        
        return view('createproduct');
    });
    
    $app->post('/receipt/{id}/createproduct', function(Request $request, $id) {                        
        $this->validate($request, [
            'name' => 'required',
            'totalPrice' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1'            
        ]);
        
        \DB::transaction(function () use ($request, $id) {
            $receipt = \ListIt\Receipt::findOrFail($id);                                

            $product = \ListIt\Product::firstOrCreate(['Name'=>$request->input('name')]);

            $receipt_product = new \ListIt\Receipt_Product();
            $receipt_product->receiptID = $receipt->ID;
            $receipt_product->productID = $product->ID;
            $receipt_product->TotalPrice = $request->input('totalPrice');
            $receipt_product->Quantity = $request->input('quantity');
            $receipt_product->save();
        });
        
        return redirect('/receipt/'. $id);
    });
    
    $app->get('/createreceipt', function() {
        return view('createreceipt');
    });
    
    $app->post('/createreceipt', function(Request $request) {
        $this->validate($request, [
            'country' => 'string',
            'streetNr' => 'number'
        ]);
        
        $receiptID = \DB::transaction(function () use ($request) {
                        
            $country = new \ListIt\Country();          
            if(!empty($request->input('country'))) {
                $country = \ListIt\Country::firstOrCreate(['Name'=>$request->input('company')]);
            }
                                                
            $region = \ListIt\Region::firstOrCreate(['Name'=>$request->input('region'), 'CountryID'=>$country->ID]);            
            
            $street = new \ListIt\Country();
            if(!empty($request->input('street'))) {
                $street = \ListIt\Street::firstOrCreate(['Name'=>$request->input('street')]);            
            }                
            
            $shoplocation = \ListIt\Shoplocation::firstOrCreate(['StreetNr'=>$request->input('streetNr'), 'StreetID'=>$street->ID, 'RegionID'=>$region->ID]);
            
            $company = new \ListIt\Country();          
            if(!empty($request->input('company'))) {
                $company = \ListIt\Company::firstOrCreate(['Name'=>$request->input('company')]);
            }
            
            $company_shoplocation = \ListIt\Company_Shoplocation::firstOrCreate(['CompanyID'=>$company->ID, 'ShoplocationID'=>$shoplocation->ID]);
                        
            $user = \ListIt\User::where('APIToken', $request->session()->get('api-token'))->firstOrFail();
            
            $receipt = new \ListIt\Receipt();
            $receipt->Datum = date('m-d-Y H:i:s');
            $receipt->UserID = $user->ID;
            $receipt->CompanyShoplocationID = $company_shoplocation->ID;
            $receipt->save();
            
            var_dump($receipt->ID);
            
            return $receipt->ID;                        
        });
        
        return redirect('/receipt/'. $receiptID);
        
    });
    
    /* 
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
            }                                                                      
        }
        return redirect('receipts');
        //$request->session()->put('key', 'value');               
    }); */
    
    
});





//$app->get('/users/trest', 'UserController@action');