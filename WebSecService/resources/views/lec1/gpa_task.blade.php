@extends('layouts.master')
@section('title', 'Transcript')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center bg-primary text-white">
                <h1 class="mb-0">Student Transcript</h1>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h3>CGPA: {{ number_format($overallGPA, 2) }}</h3>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <h3>Grade: {{ $overallGradeLetter }}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Credit Hours</th>
                                <th>Grade</th>
                                <th>Grade Letter</th>
                                <th>GPA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course['code'] }}</td>
                                    <td>{{ $course['name'] }}</td>
                                    <td>{{ $course['ch'] }}</td>
                                    <td>{{ $course['grade'] }}</td>
                                    <td>{{ $course['letter'] }}</td>
                                    <td>{{ number_format($course['gpa'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
