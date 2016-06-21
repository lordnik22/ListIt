@extends('layouts.loggedOut')

@section('title', 'Login')

@section('content')
<form method="POST" action="/login">
    Benutzername:
    <input type="text" name="user" value="{{ $name }}" />
    Passwort:
    <input type="password" name="password" value="{{ $password }}"/>
    <input type="submit"/>
</form>

@endsection