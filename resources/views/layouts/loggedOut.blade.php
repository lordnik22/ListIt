<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css" />                     
        <title>@yield('title') - ListIt</title>
    </head>
    <body id="loggedOut">
        
        ListIt
        <img src="/img/logoV2_0.png" />
        
        <div id="">
            <a href="/login">Login</a>
            <a href="/register">Registrieren</a>
        </div>
        
        
        @yield('content')
        
    </body>
</html>