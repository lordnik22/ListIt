<?php

require_once __DIR__.'/../vendor/autoload.php';


try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->configure('session');

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/* $app['config']['session.driver'] = 'file';
$app['config']['session.lottery'] = [1, 5];
$app['config']['session.expire_on_close'] = true;
$app['config']['session.path'] = '/';
$app['config']['session.domain'] = 'listit';
$app['config']['session.cookie'] = 'SESS'; */


/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

 $app->middleware([
    //Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    Illuminate\Session\Middleware\StartSession::class,
    //Illuminate\View\Middleware\ShareErrorsFromSession::class,
 ]);

$app->routeMiddleware([
    'auth' => ListIt\Http\Middleware\Authenticate::class,
    'origin' => ListIt\Http\Middleware\OriginAllow::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(TCK\Odbc\OdbcServiceProvider::class);
$app->register(ListIt\Providers\AppServiceProvider::class);
$app->register(ListIt\Providers\LumenFixSessionManagerProvider::class);
$app->register(ListIt\Providers\AuthServiceProvider::class);
$app->register(ListIt\Providers\ConversionServiceProvider::class);
$app->register(ListIt\Providers\ValidationServiceProvider::class);
$app->register(\Illuminate\Session\SessionServiceProvider::class);
/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__.'/../app/Http/routes.php';
});

return $app;
