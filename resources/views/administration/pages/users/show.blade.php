@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Show User Account Details','edit_link'=>'admin.user.edit','delete_link'=>'admin.user.destroy' , 'model_id'=>$user->id])
            @include('administration.partial.show_errors')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->


                    <div class="card-body">
                        <div class=" row">
                            <label class="col-sm-4 col-form-label">name :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$user->name}} </label>
                        </div>


                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Email :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$user->email}} </label>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@stop
