@extends('layout')

@section('content')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
            <div class="pull-left">
                <h2>Edit Data Uang Keluar</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('uang_keluar.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your
            input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('uang_keluar.update', $uang_keluar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Created By:</strong>
                    <input type="text" name="created_by" value="{{ $uang_keluar->created_by }}" class="form-control"
                        placeholder="Created By">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Lokasi Uang:</strong>
                    {{-- <input type="text" name="created_by" class="form-control" placeholder="Created By"> --}}
                    <select name="lokasi_uang" class="form-control">
                        <?php
                        foreach ($data_lokasi_uang as $lokasi) {
                            echo "<option value='" . $lokasi['id'] . "'>" . $lokasi['nama_lokasi'] . ' </option>';
                        }
                        ?>
                    </select>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
                <div class="form-group">
                    <strong>Jumlah Uang Keluar:</strong>
                    <input type="number" name="jumlah_keluar" value="{{ $uang_keluar->jumlah_keluar }}" class="form-control" placeholder="Jumlah keluar">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Keterangan Keluar:</strong>
                    <textarea class="form-control" style="height:150px" name="keterangan_keluar" placeholder="Keterangan">{{ $uang_keluar->keterangan_keluar }}</textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>File:</strong>
                        <input type="file" name="file" class="form-control" placeholder="file">
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    </div>
@endsection
