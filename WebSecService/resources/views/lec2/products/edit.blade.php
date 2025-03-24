@extends('layouts.master')
@section('title', ($products->id ? 'Edit' : 'Add') . ' Product')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $products->id ? 'Edit' : 'Add' }} Product
                    </div>

                    <div class="card-body">
                        <form action="{{ route('products.save', $products->id ?? '') }}" method="post">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="code" class="form-label">Code:</label>
                                <input type="text" class="form-control" placeholder="Code" name="code" required
                                    value="{{ $products->code }}">
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model:</label>
                                <input type="text" class="form-control" placeholder="Model" name="model" required
                                    value="{{ $products->model }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" required
                                    value="{{ $products->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" class="form-control" placeholder="Price" name="price" required
                                    value="{{ $products->price }}">
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount:</label>
                                <input type="number" class="form-control" placeholder="amount" name="amount" required
                                    value="{{ $products->amount }}">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo:</label>
                                <input type="text" class="form-control" placeholder="Photo" name="photo" required
                                    value="{{ $products->photo }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" placeholder="Description" name="description" required>{{ $products->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
