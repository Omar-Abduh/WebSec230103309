@extends('layouts.master')
@section('title', 'Transcript')
@section('content')
    <div class="card m-5">
        <div class="card-header">
            <h1 class="mb-4 p-1" style="text-align: center">Student Transcript</h1>
            <div class="d-flex justify-content-between">
                <h3>CGPA: {{ number_format($overallGPA, 2) }}</h3>
                <h3>CGPA: {{ $overallGradeLetter }}</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
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
@endsection
