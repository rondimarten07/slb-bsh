<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kehadiran PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .title { text-align: center; margin-bottom: 20px; font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="title">Daftar Kehadiran Bulan {{ Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</div>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                @foreach($datesInMonth as $date)
                    <th>{{ $date->format('d') }}</th>
                @endforeach
                <th>I</th>
                <th>S</th>
                <th>A</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                @php
                    $countI = 0;
                    $countS = 0;
                    $countA = 0;
                @endphp
                <tr>
                    <td>{{ $student->name }}</td>
                    @foreach($datesInMonth as $date)
                        <td>
                            @if($student->presences->contains('date', $date))
                                @switch($student->presences->where('date', $date)->first()->note)
                                    @case('izin')
                                        <span>I</span>
                                        @php $countI++; @endphp
                                        @break
                                    @case('sakit')
                                        <span>S</span>
                                        @php $countS++; @endphp
                                        @break
                                    @case('alpa')
                                        <span>A</span>
                                        @php $countA++; @endphp
                                        @break
                                @endswitch
                            @endif
                        </td>
                    @endforeach
                    <td>{{ $countI }}</td>
                    <td>{{ $countS }}</td>
                    <td>{{ $countA }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
