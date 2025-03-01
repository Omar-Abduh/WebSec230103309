@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <h1 class="mt-3" style="text-align: center">Welcome to WebSec</h1>
    <div class="contiainer m-3">
        <div class="card-body" style="text-align: center">
            <button type="button" class="btn btn-primary" onclick="doSomething()">Press Me</button>
        </div>

    </div>
    <script>
        function doSomething() {
            alert('Hello From JavaScript');
        }
    </script>
@endsection
