@extends('layout')
@section('content')
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
            <div class="pull-left">
                <h2>Data Lokasi Uang</h2>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('lokasi_uang.create') }}"> Create New lokasi Data </a>
            </div> --}}
        </div>
    </div>
    @can('lokasi_uang-create')
    <a class="btn btn-success" href="{{ route('lokasi_uang.create') }}"> Create New Data Uang Masuk</a>
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
                <th>Nama</th>
                <th>Keterangan lokasi</th>
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
                ajax: "{{ route('lokasi_uang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_lokasi',
                        name: 'nama_lokasi'
                    },
                    {
                        data: 'keterangan_lokasi',
                        name: 'keterangan_lokasi',
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
