@extends('administration.layouts.master')
@push('styles')
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    @include('administration.partial.title',['title'=>'Users Management','create_link'=>'admin.user.create'])
    @include('administration.partial.show_errors')
    @include('administration.partial.show_success')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="users_table" class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#users_table').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{!!route('admin.users.index.ajax')!!}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action'},
                    ]
                }
            );
        });
    </script>
@endpush
