@extends('layout')

@section('content')
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ADMIN DASHBOARD</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                You are Logged In
            </div>
            <!-- /. ROW  -->
            <div class="row text-center pad-top">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users fa-5x"></i>
                            <h4>Manage Users</h4>
                        </a>
                    </div>


                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-gear fa-5x"></i>
                            <h4>Manage Roles</h4>
                        </a>
                    </div>


                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{ route('lokasi_uang.index') }}">
                            <i class="fa fa-map-marker fa-5x"></i>
                            <h4>Lokasi Uang</h4>
                        </a>
                    </div>


                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{ route('uang_masuk.index') }}"> <i class="fa fa-arrow-down fa-5x"></i>
                            <h4>Uang Masuk</h4>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{ route('uang_keluar.index') }}"> <i class="fa fa-arrow-up fa-5x"></i>
                            <h4>Uang Keluar</h4>
                        </a>
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <div class="row text-center pad-top">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="#">
                            <i class="fa fa-money fa-5x"></i>
                            <h4>Total Uang Masuk: <br> {{ $total_uang_masuk }}</h4>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="#">
                            <i class="fa fa-money fa-5x"></i>
                            <h4>Total Uang Keluar: <br> {{ $total_uang_keluar }}</h4>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="#">
                            <i class="fa fa-user fa-5x"></i>
                            <h4>Total Users: <br> {{ $total_users }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row text-center pad-top">
                {{-- @php
                    $i = 1;
                @endphp --}}
                <div class="col-lg-6 col-md-6">
                    <h5><b>Lokasi Uang Masuk</b></h5>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi Uang</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $organizedData = [];
                
                            // Organize data based on location
                            foreach ($data as $item) {
                                $lokasi = $item->lokasi_uang_nama->nama_lokasi;
                                if (!isset($organizedData[$lokasi])) {
                                    $organizedData[$lokasi] = 0;
                                }
                                $organizedData[$lokasi] += $item->jumlah_masuk;
                            }
                
                            $i = 0;
                            ?>
                            @foreach ($organizedData as $lokasi => $total)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $lokasi }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <h5><b>Lokasi Uang Keluar</b></h5>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi Uang</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $organizedData = [];
                
                            // Organize data based on location
                            foreach ($dataK as $item) {
                                $lokasi = $item->lokasi_uang_nama->nama_lokasi;
                                if (!isset($organizedData[$lokasi])) {
                                    $organizedData[$lokasi] = 0;
                                }
                                $organizedData[$lokasi] += $item->jumlah_keluar;
                            }
                
                            $i = 0;
                            ?>
                            @foreach ($organizedData as $lokasi => $total)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $lokasi }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /. PAGE WRAPPER  -->
        <div class="footer">


            <div class="row">
                <div class="col-lg-12">
                    &copy; 2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;"
                        target="_blank">www.binarytheme.com</a>
                </div>
            </div>
        </div>
    </div>
@endsection
