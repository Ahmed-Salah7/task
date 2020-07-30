@extends('administration.layouts.master')
@section('content')

    <!-- Content Header (Page header) -->
    @include('administration.partial.title',['title'=>'Media Management'])
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="text-center mb-3">
                <a href="{{route('admin.media.download.all')}}">
                    <button class="btn btn-success"> Download All</button>
                </a>
            </div>

            @include('administration.partial.show_success')
            @include('administration.partial.show_errors')

            <div class="form mb-5">
                <!-- Small boxes (Stat box) -->
                <form action="{{route('admin.media.upload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="input-group-text btn btn-success" id="inputGroupFileAddon01">
                                Upload
                            </button>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="btn btn-info custom-file-input " id="inputGroupFile01"
                                   name="images[]"
                                   required
                                   aria-describedby="inputGroupFileAddon01" multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
            <div class="card-columns">
                @foreach($medias as  $media)
                    <div class="card">
                        <img src="{{$media->getUrl('card')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="float-left">
                                <a href="{{route('admin.media.download',$media->id)}}"><i
                                        class="fas fa-2x text-warning fa-download"></i></a>
                                <a href="#"
                                   onclick="event.preventDefault();  document.getElementById('{{$media->id}}-media-delete').submit();">
                                    <i class="fas  fa-2x text-danger fa-minus-circle"></i></a>
                            </div>
                            <div class="float-right">
                                <a href=""
                                   onclick="event.preventDefault();  document.getElementById('{{$media->id}}-media-update').submit();">
                                    <i class="fas fa-2x text-success fa-id-badge"></i></a>

                                <a href="{{$media->getUrl('origin')}}"><i class="fas fa-2x text-info fa-eye"></i></a>

                                <form id="{{$media->id}}-media-update"
                                      action="{{route('admin.media.update',$media->id)}}" style="display: none;">
                                    <input type="submit">
                                </form>

                                <form id="{{$media->id}}-media-delete"
                                      action="{{route('admin.media.delete',$media->id)}}" style="display: none;">
                                    <input type="submit">
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- /.content -->



@stop
