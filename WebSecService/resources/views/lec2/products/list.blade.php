@extends('layouts.master')
@section('title', 'Products')
@section('content')
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-10">
                <h1>Products</h1>
            </div>
            @can('add_products')
                <div class="col-md-2">
                    <a href="{{ route('products.edit') }}" class="btn btn-success w-100">Add Product</a>
                </div>
            @endcan
        </div>

        <form class="mb-4">
            <div class="row g-2">
                <div class="col-md-2">
                    <input name="keywords" type="text" class="form-control" placeholder="Search Keywords"
                        value="{{ request()->keywords }}" />
                </div>
                <div class="col-md-2">
                    <input name="min_price" type="number" class="form-control" placeholder="Min Price"
                        value="{{ request()->min_price }}" />
                </div>
                <div class="col-md-2">
                    <input name="max_price" type="number" class="form-control" placeholder="Max Price"
                        value="{{ request()->max_price }}" />
                </div>
                <div class="col-md-2">
                    <select name="order_by" class="form-select">
                        <option value="" {{ request()->order_by == '' ? 'selected' : '' }} disabled>Order By</option>
                        <option value="name" {{ request()->order_by == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request()->order_by == 'price' ? 'selected' : '' }}>Price</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="order_direction" class="form-select">
                        <option value="" {{ request()->order_direction == '' ? 'selected' : '' }} disabled>Order
                            Direction</option>
                        <option value="ASC" {{ request()->order_direction == 'ASC' ? 'selected' : '' }}>ASC</option>
                        <option value="DESC" {{ request()->order_direction == 'DESC' ? 'selected' : '' }}>DESC</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
                <div class="col-md-1">
                    <button type="reset" class="btn btn-danger w-100">Reset</button>
                </div>
            </div>
        </form>

        @foreach ($products as $product)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset("images/products/$product->photo") }}" class="img-fluid rounded-start"
                            alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                </div>
                                @can('edit_products')
                                    <div class="col-md-2 p-1">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-success w-100">Edit</a>
                                    </div>
                                @endcan
                                @can('delete_products')
                                    <div class="col-md-2 p-1">
                                        <a href="{{ route('products.delete', $product->id) }}"
                                            class="btn btn-danger w-100">Delete</a>
                                    </div>
                                @endcan
                                <div class="col-md-2 p-1">
                                    <a href="{{ route('products.addToCart', $product->id) }}" class="btn btn-primary w-100">Buy</a>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <tr>
                                    <th width="20%">Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $product->model }}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $product->price }} LE</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $product->amount }}</td>
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
