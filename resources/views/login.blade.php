@extends('layouts.loggedOut')

@section('title', 'Login')

@section('content')
    <form method="POST" action="/login">
        <label>
            <span>Benutzername</span>
            <input type="text" name="user" value="{{ $name }}" />
        </label>
        <label>
            <span>Passwort</span>
            <input type="password" name="password" value="{{ $password }}"/>
        </label>
        <input type="submit"/>
    </form>
@endsection