@extends('layouts.clean')
@section('title')
     <title>Teste Login - main - CleanERP 2</title>
@endsection

@section('content')
    <a class="btn btn-dark" href="{{ route('loginajax') }}">Logout</a>
@endsection
