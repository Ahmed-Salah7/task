@extends('administration.layouts.master')
@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Create Role'])
            @include('administration.partial.show_errors')
            @include('administration.partial.show_success')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" action="{{route("admin.role.store")}}" method="POST">
                        @csrf
                        <div class="card-body">

                            <divl class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control">
                            </divl>


                            <div class="form-group">
                                <label>Multiple</label>
                                <select name="permissions[]" class="select2" multiple="multiple"
                                        data-placeholder="Select a State"
                                        style="width: 100%;">
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@push('scripts')
    <!-- Select2 -->
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
