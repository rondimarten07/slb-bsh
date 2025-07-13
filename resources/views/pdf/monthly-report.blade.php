<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan {{ $selectedUser->name }} - {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</h1>
    
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Report Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}</td>
                    <td>{{ $report->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <p>Total Reports: {{ $reports->count() }}</p> --}}
</body>
</html>
