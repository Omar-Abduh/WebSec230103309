@extends('layouts.master')
@section('title', 'Bought Products')
@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">Bought Products</h1>

        @foreach (auth()->user()->boughtProducts as $product)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4 text-center">
                            <img src="{{ asset('images/' . $product->photo) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        </div>
                        <div class="col-12 col-lg-8 mt-3 mt-lg-0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="mb-0">{{ $product->name }}</h3>
                                <small class="text-muted">Bought at {{ $product->pivot->created_at->format('d M Y H:i:s') }}</small>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
