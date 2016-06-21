<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css" />                     
        <title>@yield('title') - ListIt</title>
    </head>
    <body id="loggedIn" >
        
        <div id="nav">
            <div id="boxrowleft">
                <div class="boxsmall"></div>
                <div class="boxmiddle"></div>
                <a id="profile" ><img  /></a>
            </div>
            <div id="navbar">                
                <a href="/home">Home</a>
                <a href="/login">Login</a>
            </div>
            <div id="boxrowrigth">
                <a id="profile" ><img  /></a>
                <div class="boxmiddle"></div>
                <div class="boxsmall"></div>                                
            </div>
        </div>
        
        @yield('content')
        
    </body>
</html>