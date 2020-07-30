@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            @include('administration.partial.title',['title'=>'Show Permission Details'])
            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Permission :</label>
                            <label class="col-sm-8 col-form-label">{{$permission->name}} </label>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
