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

            @include('administration.partial.title',['title'=>'Update Role Data','delete_link'=>'admin.role.destroy','model_id'=>$role->id])
            @include('administration.partial.show_errors')
            @include('administration.partial.show_success')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route("admin.role.update",$role->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" value="{{$role->id}}" name="id">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" value="{{$role->name}}" name="name" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Choose Roles</label>
                                <select name="permissions[]" class="select2" multiple="multiple"
                                        data-placeholder="Select a State"
                                        style="width: 100%;">
                                    @foreach($permissions as $permission)
                                        <option {{in_array($permission->id,$role_permissions ) ? 'selected':''}}
                                                value="{{$permission->id}}">{{$permission->name}}</option>
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
