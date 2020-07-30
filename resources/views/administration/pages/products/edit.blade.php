@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Update Product Data','delete_link'=>'admin.product.destroy','model_id'=>$product->id])
            @include('administration.partial.show_errors')
            @include('administration.partial.show_success')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route("admin.product.update",$product->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" value="{{$product->id}}" name="id">

                        <div class="card-body">

                            <div class="form-group">
                                <label> Title</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label> Title</label>
                                <input type="text" value="{{$product->title}}" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Description</label>

                                <textarea name="description" rows="10"
                                          class="form-control">{{$product->description}}</textarea>

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
