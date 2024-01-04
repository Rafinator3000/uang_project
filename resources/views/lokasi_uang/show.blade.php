@extends('layout')

@section('content')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
            <div class="pull-left">
                <h2> Show Data Lokasi Uang</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('lokasi_uang.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Lokasi:</strong>
                {{ $lokasi_uang->nama_lokasi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan:</strong>
                {{ $lokasi_uang->keterangan_lokasi }}
            </div>
        </div>
    </div>
    </div>
@endsection
