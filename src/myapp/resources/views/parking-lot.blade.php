<!-- resources/views/parking-lot.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Spots</title>
    <style>
        .parking-lot {
            display: flex;
            flex-direction: column;
            gap: 5px; /* Space between rows */
            max-width: 100%; /* Adjust width as needed */
            margin: 0 auto; /* Center the grid */
        }
        .parking-row {
            display: flex;
            gap: 5px; /* Space between spots in a row */
        }
        .parking-spot {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border: 1px solid #000;
        }
        .regular {
            background-color: #ddd;
        }
        .motorcycle {
            background-color: #f2f2f2;
        }
        .occupied {
            background-color: #f00;
        }
    </style>
</head>
<body>
    <h1>Parking Spots</h1>
    <div class="parking-lot">
        @foreach ($parkingSpotRows as $row)
        @if($loop->index % 2 == 0)
            <div class="parking-row">
                <hr>
            </div>
        @endif
            <div class="parking-row">
                @foreach ($row as $spot)
                    <div class="parking-spot {{ $spot->spot_type == 'regular' ? 'regular' : 'motorcycle' }} {{ $spot->occupied ? 'occupied' : null }}">
                        {{ $spot->id }}: {{ $spot->spot_type == 'regular' ? 'R' : 'M' }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>
