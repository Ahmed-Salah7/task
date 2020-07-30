@extends('administration.layouts.master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">

            @include('administration.partial.title',['title'=>'Show Administration Account Details','edit_link'=>'admin.administration.edit','delete_link'=>'admin.administration.destroy' , 'model_id'=>$administration->id])

            <div class="row">
                <div class="col-12 card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class=" row">
                            <label class="col-sm-4 col-form-label">name :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$administration->name}} </label>
                        </div>
                        <div class=" row">
                            <label class="col-sm-4 col-form-label">Email :</label>
                            <label
                                class="col-sm-8 col-form-label">{{$administration->email}} </label>
                        </div>
                        <div class=" row">
                            <label class="col-sm-4 col-form-label ">Permissions :</label>
                            @if(!empty($administration->getRoleNames()))
                                @foreach($administration->getRoleNames() as $role)
                                    <span class="col-form-label badge-permissions badge badge-success">{{ $role }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
