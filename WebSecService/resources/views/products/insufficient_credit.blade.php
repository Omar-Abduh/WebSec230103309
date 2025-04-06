@extends('layouts.master')
@section('title', 'Prime Numbers')
@section('content')
    <div class="text-center">
        <img src="{{ asset('images/errors/error.jpg') }}" alt="Error" width="50%">
        <p>Your credit amount is <strong>{{ auth()->user()->credit->credit_amount.'$' }}</strong> and it's <strong>not enough</strong>.</p>
        <p>Contact Your Administrator</p>
        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
    </div>
@endsection
