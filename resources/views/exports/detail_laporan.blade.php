<!DOCTYPE html>
<html>

<head>
    <title>Detail Laporan</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }
    </style>
</head>

<body>
    <h1>Detail Laporan</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor Laporan</th>
                <th>Waktu Dihubungi</th>
                <th>Ruangan/Unit</th>
                <th>Petugas Pelapor</th>
                <th>Jenis Kerusakan</th>
                <th>Status Laporan</th>
                <th>Petugas IT</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td>{{ $record->nmr_laporan }}</td>
                <td>{{ \Carbon\Carbon::parse($record->waktu_dihubungi)->format('d-m-Y H:i:s') }}</td>
                <td>{{ $record->ruangan_unit }}</td>
                <td>{{ $record->petugas_pelapor }}</td>
                <td>{{ $record->jenis_kerusakan }}</td>
                <td>{{ $record->status_laporan }}</td>
                <td>{{ $record->petugas_it }}</td>
                <td>{{ \Carbon\Carbon::parse($record->waktu_selesai)->format('d-m-Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>