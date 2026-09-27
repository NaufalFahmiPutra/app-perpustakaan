<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { width: 160px; background: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Detail Anggota</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <table>
        <tr>
            <th>Nama</th>
            <td>{{ $members['nama'] }}</td>
        </tr>
        <tr>
            <th>NIM</th>
            <td>{{ $members['nim'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $members['email'] }}</td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td>{{ $members['nomor_telepon'] }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $members['alamat'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $members['status'] ?? '-' }}</td>
    </table>
</body>
</html>
