@extends('layouts.master')
@section('title', 'MiniTest')
@section('content')
    <div class="card m-4">
        <div class="card-header">Supermarket Bill</div>
        <div class="card-body">
            <h1 style="text-align: center; font-weight: bold">Supermarket Bill</h1>
            <h6 style="text-align: center">Cairo, Egypt</h6>
            <h6 style="text-align: center">Tel.. 010101010</h6>
            <table class="table table-bordered">
                <thead>
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
            <h5 style="text-align: right; font-weight: bold">Total: {{ $bill->total }}</h5>
        </div>
    </div>
@endsection
