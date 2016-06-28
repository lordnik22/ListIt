<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css" />                     
        <title>ListIt - @yield('title')</title>
        @if (env('APP_ENV', 'none') == 'local')
            <script>document.write('<script src="http://'
            + (location.host || 'localhost').split(':')[0]
            + ':35729/livereload.js"></'
            + 'script>')</script>
        @endif
    </head>
    @yield('basestructure')
</html>