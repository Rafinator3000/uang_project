<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Export Data Uang Keluar</title>
</head>
<body>
    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Uang Keluar</h2>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Created By</th>
            <th>Lokasi Uang</th>
            <th>Jumlah Keluar</th>
            <th>Keterangan Keluar</th>
            {{-- <th>File</th> --}}
        </tr>
        <?php 
            $i = 1;
            // dd($uang_keluar);
        ?>
        @foreach ($uang_keluar as $uang_keluar1)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $uang_keluar1->created_by }}</td>
                <td>{{ $uang_keluar1->lokasi_uang }}</td>
                <td>{{ $uang_keluar1->jumlah_keluar }}</td>
                <td>{{ $uang_keluar1->keterangan_keluar }}</td>
                {{-- <td>{{ $uang_keluar1->file }}</td> --}}
            </tr>
        @endforeach
    </table>
</body>
</html>