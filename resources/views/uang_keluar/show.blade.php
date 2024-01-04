@extends('layout')

@section('content')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
            <div class="pull-left">
                <h2> Show Data Uang Keluar</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('uang_keluar.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created by:</strong>
                {{ $uang_keluar->created_by }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi Uang:</strong>
                {{ $uang_keluar->lokasi_uang }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Uang Keluar:</strong>
                {{ $uang_keluar->jumlah_uang }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan Keluar:</strong>
                {{ $uang_keluar->keterangan_keluar }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File:</strong><br>
                <img src="/fileassets/{{ $uang_keluar->file }}" width="600px">
            </div>
        </div>
    </div>
    </div>
@endsection
