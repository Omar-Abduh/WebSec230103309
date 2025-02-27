@extends('layouts.master')
@section('title', 'Products')
@section('content')
    @foreach ($products as $product)
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12 col-lg-4">
                        <img src="{{ asset("images/products/$product->photo") }}" class="img-thumbnail" alt="{{ $product->name }}"
                            width="100%">
                    </div>
                    <div class="col col-sm-12 col-lg-8 mt-3">
                        <h3>{{ $product->name }}</h3>
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
                                <th>Description</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
