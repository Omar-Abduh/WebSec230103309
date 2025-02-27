@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')
    <form action="{{ route('products.save', $products->id ?? '') }}" method="post">
        {{ csrf_field() }}
        <div class="row mb-2">
            <div class="col-6">
                <label for="code" class="form-label">Code:</label>
                <input type="text" class="form-control" placeholder="Code" name="code" required
                    value="{{ $products->code }}">
            </div>
            <div class="col-6">
                <label for="model" class="form-label">Model:</label>
                <input type="text" class="form-control" placeholder="Model" name="model" required
                    value="{{ $products->model }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Name" name="name" required
                    value="{{ $products->name }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <label for="model" class="form-label">Price:</label>
                <input type="number" class="form-control" placeholder="Price" name="price" required
                    value="{{ $products->price }}">
            </div>
            <div class="col-6">
                <label for="model" class="form-label">Photo:</label>
                <input type="text" class="form-control" placeholder="Photo" name="photo" required
                    value="{{ $products->photo }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="name" class="form-label">Description:</label>
                <textarea class="form-control" placeholder="Description" name="description" required>{{ $products->description }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
