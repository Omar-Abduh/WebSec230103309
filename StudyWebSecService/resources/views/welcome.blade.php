<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Test</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="" style="text-align: center; font-size: 50px; font-weight:bold">
        Multiplication Table
    </div>
    <div class="card m-2">
        <div class="card-header">Multiplication Table</div>
        <div class="card-body">
            <div class="row">
                <div class="card m-4 col-sm-2">
                    @php($j = 1)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card m-4 col-sm-2">
                    @php($j = 2)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="card m-4 col-sm-2">
                    @php($j = 3)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card m-4 col-sm-2">
                    @php($j = 4)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card m-4 col-sm-2">
                    @php($j = 5)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card m-4 col-sm-2">
                    @php($j = 6)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="card m-4 col-sm-2">
                    @php($j = 7)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="card m-4 col-sm-2">
                    @php($j = 8)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="card m-4 col-sm-2">
                    @php($j = 9)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="card m-4 col-sm-2">
                    @php($j = 10)
                    <div class="card-header">{{ $j }} Multiplication Table</div>
                    <div class="card-body">
                        <table>
                            @foreach (range(1, 10) as $i)
                                <tr>
                                    <td>{{ $i }} * {{ $j }}</td>
                                    <td> = {{ $i * $j }}</td>
                                    </li>
                            @endforeach
                        </table>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</body>

</html>
