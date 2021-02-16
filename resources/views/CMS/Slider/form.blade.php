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
                        <li class="breadcrumb-item"><a href="{{route('slider.index')}}">{{__('Slider')}}</a></li>
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
                    <h3 class="card-title">{{__('Slider')}}  @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</h3>
                </div>

                <form action=" @if($text=='Edit') {{route('slider.update',$sliders->id)}} @else {{route('slider.store')}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-8">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Sliders')}} {{__('Name')}} :*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{__('Sliders')}} {{__('Name')}}" value="{{@$sliders->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sub_title">{{__('Sliders')}} {{__('Sub Title')}}:</label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="{{__('Sliders')}} {{__('Sub Title')}}" value="{{@$sliders->sub_title}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{__('Sliders')}} {{__('Description')}}:</label>
                                    <textarea class=" ckeditor form-control" id="my-editor" name="description"> {{@$sliders->description}} </textarea>
                                </div>



                            </div>

                        </div>



                        <div class="col-md-4">

                            <div class="card-body">

                                <div class="form-group" style="width: max-content;">
                                    <label for="position">{{__('Position')}}:</label>
                                    <input type="number" class="form-control" id="position" name="position" value="{{@$sliders->position}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>{{__('Publish Status')}}: </label>
                                    <select class="form-control select2" style="width: 100%;" id="status" name="status">
                                        <option selected="selected" value="yes" @if(@$sliders->status=='yes') selected @endif >{{__('Yes')}}</option>
                                        <option value="no" @if(@$sliders->status=='no') selected @endif >{{__('No')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{__('Sliders')}} {{__('Image')}}:</label><br>
                                    <input type="file" id="img" name="img"><br><br>
                                    <img id="previewimage">
                                    @if(@$sliders->img )
                                    <img id="outputimage" src="{{ asset( @$sliders->img ) }}" width="100px" height="100px">
                                    <a href="#" id="hideimage" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                                    @endif
                                </div>


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

<script>
    $(document).ready(function() {

        $("#img").on('change', function() {

            event.preventDefault();
            if (event.target.files.length > 0) {
                var imgsrc = URL.createObjectURL(event.target.files[0])


                $("#previewimage").attr("height", "100");
                $("#previewimage").attr('src', imgsrc);
                $("#outputimage").css('display', 'none');
                $("#hideimage").css('display', 'none');

            }

        });

        //for hide image
        $("#hideimage").on('click', function() {
            $("#outputimage").css('display', 'none');
            $("#hideimage").css('display', 'none');

        });

    });
</script>

@endsection