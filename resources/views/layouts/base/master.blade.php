<!DOCTYPE html>
<html>
    <head>
        <title>ListIt - @yield('title')</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if (env('APP_ENV', 'none') == 'local')
            <script>document.write('<script src="http://'
            + (location.host || 'localhost').split(':')[0]
            + ':35729/livereload.js"></'
            + 'script>')</script>
            <link rel="stylesheet" href="/css/app.css" type="text/css" />
            <script type="text/javascript" src="js/app.js"></script>
        @else
            <link rel="stylesheet" href="/css/app.min.css" type="text/css" />
            <script type="text/javascript" src="/js/app.min.js"></script>            
        @endif
    </head>
    @yield('basestructure')
</html>