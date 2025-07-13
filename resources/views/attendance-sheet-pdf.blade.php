<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kehadiran PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .title { text-align: center; margin-bottom: 20px; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="title">Daftar Kehadiran Bulan {{ Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Nama</th>
                <th colspan="{{ count($datesInMonth) }}">Tanggal</th>
                <th colspan="4">Total Presensi</th>
            </tr>
            <tr>
                @foreach($datesInMonth as $date)
                    <th>{{ $date->format('d') }}</th>
                @endforeach
                <th>H</th>
                <th>I</th>
                <th>S</th>
                <th>A</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                @php
                    $countH = 0;
                    $countI = 0;
                    $countS = 0;
                    $countA = 0;
                @endphp
                <tr>
                    <td>{{ $student->name }}</td>
                    @foreach($datesInMonth as $date)
                        <td>
                            @php
                                $presence = $student->presences->first(function($item) use ($date) {
                                    return $item->date->format('Y-m-d') === $date->format('Y-m-d');
                                });
                            @endphp
                            @if($presence)
                                @switch($presence->note)
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
                                    @case('hadir')
                                        <span>H</span>
                                        @php $countH++; @endphp
                                        @break
                                @endswitch
                            @endif
                        </td>
                    @endforeach
                    <td>{{ $countH }}</td>
                    <td>{{ $countI }}</td>
                    <td>{{ $countS }}</td>
                    <td>{{ $countA }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
