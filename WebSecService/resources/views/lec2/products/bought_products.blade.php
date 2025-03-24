@extends('layouts.master')
@section('title', 'Bought Products')
@section('content')
    <h1>Bought Products</h1>
    @if($boughtProducts->isEmpty())
        <p>You have not bought any products yet.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($boughtProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->price * $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection