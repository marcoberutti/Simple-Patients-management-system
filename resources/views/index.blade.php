@extends('layouts.app')

<style>
    img{
        height:150px;
    }
    a{
        text-decoration: none !important;
    }
</style>

@section('content')
<div class="container d-flex justify-content-between align-items-center text-end">
    @if (!auth()->check())
    <div>
        <h1>Patients management app</h1>
        <p>CLICK <a href="http://127.0.0.1:8000/login">LOGIN</a> FOR ENTER OR <a href="http://127.0.0.1:8000/register">REGISTER</a></p>
    </div>
    @endif

</div>
@endsection
