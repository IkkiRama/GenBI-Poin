<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAPITULASI POIN DEPUTI {{ $month ? 'BULAN' : 'PERIODE 2024/2025' }}
        {{ $month ? strtoupper($month) : '' }} {{ $month ? $year : '' }}
        {{ $komsat !== "Semua" ? 'KOMISARIAT ' . strtoupper($komsat) : '' }}</title>
    <style>
        /* Basic Styling */
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            padding: 10px;
            background-color: #1e3a8a; /* Background Biru untuk Header */
            color: white;
            text-align: left;
            border-bottom: 1px solid #d1d5db;
        }
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        /* Color Coding for Points */
        .bg-red { background-color: #f87171; }  /* 0-19 Poin */
        .bg-yellow { background-color: #facc15; }  /* 20-40 Poin */
        .bg-green { background-color: #09db45; }  /* 41+ Poin */
    </style>
</head>
<body>
    <h1 class="font-bold text-center">
        REKAPITULASI POIN DEPUTI {{ $month ? 'BULAN' : 'PERIODE 2024/2025' }}
        {{ $month ? strtoupper($month) : '' }} {{ $month ? $year : '' }}
        {{ $komsat !== "Semua" ? 'KOMISARIAT ' . strtoupper($komsat) : '' }}
    </h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Komsat</th>
                <th>Bidang</th>
                <th>Total Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $rank)
                <tr class="
                    @if($index === 0) bg-green
                    @endif
                ">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rank['name'] }}</td>
                    <td>{{ $rank['komsat'] }}</td>
                    <td>{{ $rank['bidang'] }}</td>
                    <td>{{ $rank['total_points'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



</body>
</html>
