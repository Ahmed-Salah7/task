@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Show Product Details','edit_link'=>'admin.product.edit','delete_link'=>'admin.product.destroy' , 'model_id'=>$product->id])
            @include('administration.partial.show_errors')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->


                    <div class="card-body">

                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Image :</label>
                            <label
                                class="col-sm-8 col-form-label">
                                <img style="max-width: 400px;" src="{{asset('storage/'.$product->image)}}" alt="">
                            </label>
                        </div>

                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Title :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$product->title}} </label>
                        </div>


                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Description :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$product->description}} </label>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@stop
