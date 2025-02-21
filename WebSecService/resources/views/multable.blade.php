@extends('layouts.master')
@section('title', 'Multiplication Table')
@section('content')
    <div class="card m-4">
        <div class="card-header">Multiplication Table</div>
        <div class="card-body">
            <div class="row">
                @foreach (range(1, 12) as $j)
                    <div class="col-sm-3">
                        <div class="card m-3">
                            <div class="card-header">{{ $j }} Multiplication Table</div>
                            <div class="card-body">
                                <table>
                                    @foreach (range(1, 10) as $i)
                                        <tr>
                                            <td>{{ $i }} * {{ $j }}</td>
                                            <td>= {{ $i * $j }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
