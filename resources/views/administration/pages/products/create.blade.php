@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Create product'])
            @include('administration.partial.show_errors')
            @include('administration.partial.show_success')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" action="{{route("admin.product.store")}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label> Image</label>
                                <input type="file" value="{{old('image')}}" name="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label> Title</label>
                                <input type="text" value="{{old('title')}}" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Description</label>

                                <textarea name="description" rows="10"
                                          class="form-control">{{old('description')}}</textarea>
                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@stop
