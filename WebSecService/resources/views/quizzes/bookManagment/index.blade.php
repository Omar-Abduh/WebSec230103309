@extends('layouts.master')
@section('title', 'Book Management')
@section('content')
<div class="container mt-5">
    <h1 class="text-center">Book Management</h1>
    <div class="text-center mb-3">
        <a href="{{ route('books.create') }}" class="btn btn-success">Create New Book</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Published Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_year }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection