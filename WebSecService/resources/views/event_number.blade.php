<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/bootstrap.min.js"></script>
    <title>Event Number</title>
</head>

<body>
    <div class="card">
        <div class="card-header">Even Numbers</div>
        <div class="card-body">
            @foreach (range(1, 100) as $i)
                @if ($i % 2 == 0)
                    <span class="badge" style="background-color: green">{{ $i }}</span>
                @else
                    <span class="badge" style="background-color: red">{{ $i }}</span>
                @endif
            @endforeach
        </div>
    </div>
</body>

</html>
