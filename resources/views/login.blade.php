@extends('layouts.master')

@section('title', 'Login')

@section('content')
<form>
    <input type="text" name="name" value="@{{ $name }}" />
</form>

@endsection