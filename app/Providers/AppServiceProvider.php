<?php

namespace ListIt\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    	/** @var \Illuminate\Http\Request $request */
        $request = $this->app->make('request');
        if($request->isMethod('OPTIONS')) {
		$this->app->options($request->path(), ['middleware' => 'origin', function(){ }]);
	}
        
        \DB::connection()->enableQueryLog();
    }
}
