@extends('layouts.loggedOut')

@section('title', 'Login')

@section('content')
    @parent
    <form method="POST" action="/login">
        Benutzername:
        <input type="text" name="user" value="" />
        Passwort:
        <input type="password" name="password" value=""/>
        Email:
        <input type="password" name="password" value=""/>
        <input type="submit"/>
    </form>
@endsection