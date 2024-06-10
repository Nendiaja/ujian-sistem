<!DOCTYPE html>
<html>
<head>
    <title>Detail User PDF</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #555;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Konten detail user -->
    <h2>Detail User</h2>
    <table>
        <thead>
            <tr>
                <th>SAP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>PIC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->SAP }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->pic }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Konten detail nilai -->
    <h2>Detail Nilai</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Nilai</th>
                <th>Status Kelulusan</th>
                <th>Tanggal Ujian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoriUsers as $kategoriUser)
                <tr>
                    <td>{{ $kategoriUser->kategori->nama }}</td>
                    <td>{{ $kategoriUser->nilai_total }}</td>
                    <td>{{ $kategoriUser->grade }}</td>
                    <td>
                        @if ($kategoriUser->nilai_total != null && $kategoriUser->nilai_total != 0 && $kategoriUser->updated_at)
                            {{ $kategoriUser->updated_at->timezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i:s') }}
                        @endif
                    </td>   
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
