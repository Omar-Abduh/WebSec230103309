@extends('layouts.master')
@section('title', 'MiniTest')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Supermarket Bill</h2>
            </div>
            <div class="card-body">
                <h1 class="text-center font-weight-bold">Supermarket Bill</h1>
                <h6 class="text-center">Cairo, Egypt</h6>
                <h6 class="text-center">Tel: 010101010</h6>
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill->items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity * $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h5 class="text-right font-weight-bold mt-4">Total: {{ $bill->total }}</h5>
            </div>
        </div>
    </div>
@endsection
