@extends('layouts.master')
@section('title', 'Even Numbers')
@section('content')

    <div class="card m-4">
        <div class="card-header">Even Numbers</div>
        <div class="card-body">
            @foreach (range(1, 100) as $i)
                @if ($i % 2 == 0)
                    <span class="badge" style="background-color: green">{{ $i }}</span>
                @else
                    <span class="badge" style="background-color: red">{{ $i }}</span>
                @endif
            @endforeach
        </div>
    </div>
@endsection
