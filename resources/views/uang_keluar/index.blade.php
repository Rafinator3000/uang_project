@extends('layout')
@section('content')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-left">
                        <h2>Data Uang Keluar</h2>
                    </div>
                    {{-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('uang_keluar.create') }}"> Create New lokasi Data </a>
            </div> --}}
                </div>
            </div>
            @can('uang_keluar-create')
                <a class="btn btn-success" href="{{ route('uang_keluar.create') }}"> Create New Data Uang Keluar</a>
            @endcan

            @can('uang_keluar-pdf')
                <a class="btn btn-primary" href="{{ route('uang_keluar-pdf') }}"> Export PDF</a>
            @endcan

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Created By</th>
                        <th>Lokasi Uang</th>
                        <th>Jumlah Uang Keluar</th>
                        <th>Keterangan Keluar</th>
                        <th>File</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">Data yang dihapus tidak bisa dikembalikan.</div>
                        <div class="modal-footer">
                            <form id="delete_form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function deleteConfirm(url) {
                    $('#delete_form').attr('action', url);
                    $('#deleteModal').modal();
                }
            </script>

            <script type="text/javascript">
                $(function() {
                    var table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('uang_keluar.index') }}",
                        columnDefs: [{
                            "targets": 5,
                            "data": 'file_file',
                            "render": function(data, type, row, meta) {
                                console.log(data);
                                return '<img class="p-3" src="<?php echo url('/'); ?>/fileassets/' + data +
                                    '" alt="' +
                                    data + '" height="200" width="200" />';
                            }
                        }],
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'created_by',
                                name: 'created_by'
                            },
                            {
                                data: 'lokasi_uang',
                                name: 'lokasi_uang',
                            },
                            {
                                data: 'jumlah_keluar',
                                name: 'jumlah_keluar',
                            },
                            {
                                data: 'keterangan_keluar',
                                name: 'keterangan_keluar',
                            },
                            {
                                data: 'file',
                                name: 'file',
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ]
                    });
                });
            </script>
        </div>
    @endsection
