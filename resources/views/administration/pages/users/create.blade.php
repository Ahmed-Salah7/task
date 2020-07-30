@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Create User Account'])
            @include('administration.partial.show_errors')
            @include('administration.partial.show_success')

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" action="{{route("admin.user.store")}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" value="{{old('email')}}" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" value="{{old('password')}}" name="password" class="form-control">
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
