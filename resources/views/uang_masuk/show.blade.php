@extends('layout')

@section('content')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
            <div class="pull-left">
                <h2> Show Data Uang Masuk</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('uang_masuk.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created by:</strong>
                {{ $uang_masuk->created_by }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi Uang:</strong>
                {{ $uang_masuk->lokasi_uang }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Uang Masuk:</strong>
                {{ $uang_masuk->jumlah_uang }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Keterangan Masuk:</strong>
                {{ $uang_masuk->keterangan_masuk }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File:</strong><br>
                <img src="/fileassets/{{ $uang_masuk->file }}" width="600px">
            </div>
        </div>
    </div>
    </div>
@endsection
