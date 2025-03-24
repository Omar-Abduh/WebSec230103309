@extends('layouts.master')
@section('title', 'Cart')
@section('content')
    <h1>Your Cart</h1>
    <p>Customers can use their account credit to purchase products.</p>
    <p>Your Credit: ${{ Auth::user()->credit }}</p>
    @if(session('cart'))
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $details['price'] }}</td>
                        <td>{{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <form action="{{ route('products.updateCart', $id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="decrease" class="btn btn-sm btn-secondary">-</button>
                                <button type="submit" name="action" value="increase" class="btn btn-sm btn-secondary">+</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total Amount: ${{ $total }}</strong></p>
        <form action="{{ route('products.purchase') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection