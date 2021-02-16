@extends('app')

@section('head-section')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('gallery.index')}}">{{__('Gallery')}}</a></li>
                        <li class="breadcrumb-item active">@if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title"> {{__('Gallery')}}  @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif  </h3>
                </div>

                <form action="@if(@$text=='Edit') {{route('gallery.update',$gallery->id)}} @else {{route('gallery.store')}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">


                        <div class="card-body ">

                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group ">
                                        <label for="name">{{__('Gallery')}} {{__('Name')}}:*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Tag Name" value="{{@$gallery->name}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group col-lg-4">
                                        <label>{{__('Main Image')}} :</label><br>
                                        <input type="file" id="img" name="img"><br>

                                        <img id="previewimage">

                                        @if(isset($gallery->img))
                                        <img id="outputimage" src="{{ asset(@$gallery->img) }}" width="200px" height="100px">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group col-lg-4 ">
                                        <label>{{__('Publish Status')}}: </label>
                                        <select class="form-control select2" style="width: 100%;" id="status" name="status">
                                            <option selected="selected" value="yes" @if(@$gallery->status=='yes') selected @endif>{{__('Yes')}}</option>
                                            <option value="no" @if(@$gallery->status=='no')) selected @endif >{{__('No')}}</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group" id="image_preview">
                                <label>{{__('Albumb')}} {{__('Image')}}:</label><br>
                                <input type="file" id="images" name="images[]" multiple><br><br>

                                @if(isset($gallery->images))
                                <div class="row">
                                    @foreach($gallery->images as $key=>$photos)
                                    <div class="col-lg-3 image__wrapper">

                                        <img id="outputalbum-{{$key}}" src="{{ asset(@$photos) }}" style="width: 100px; height:100px; margin: 7px;"> &nbsp; &nbsp;
                                        <a href="#" id="delete-{{$key}}" onclick="ImageDelete('{{$key}}','{{$photos}}','{{$gallery->id}}');" class="fa fa-times-circle removeItem" style="position: absolute; color: red;  margin: -5px -30px "></a>

                                    </div>
                                    @endforeach

                                </div>
                                @endif
                            </div>


                        </div>





                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>


            </div>

        </div>



</div>


@endsection
@section('footer-section')
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

@include('layouts/ckeditor')

<script type="text/javascript">
    // $(document).on('click', '.removeItem', function() {
    //     $(this).parent().hide();

    // })


    function ImageDelete($key, $photoName, $photoID) {

        $('#outputalbum-'.concat($key)).css('display', 'none');
        $('#delete-'.concat($key)).css('display', 'none');

        // console.log($photoID);

        var path = "{{ URL::route('gallery.imagedelete') }}";


        $.ajax({

            url: path,
            method: 'POST',
            data: {
                id: $photoID,
                name: $photoName,
                _token: "{{ csrf_token() }}",
            },


        });



    }
</script>

<script>
    $(document).ready(function() {




        $("#img").on('change', function() {

            event.preventDefault();
            if (event.target.files.length > 0) {
                var imgsrc = URL.createObjectURL(event.target.files[0])


                $("#previewimage").attr("height", "100");
                $("#previewimage").attr('src', imgsrc);
                $("#outputimage").css('display', 'none');

            }

        });


        $("#images").on('change', function() {

            event.preventDefault();

            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' + style=' width: 100px; height:100px;' +> &nbsp; &nbsp;");
            }


        });



    });
</script>

@endsection