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
            <li class="breadcrumb-item"><a href="{{route('catrgories.index')}}">{{__('Category')}}</a></li>
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
          <h3 class="card-title">{{__('Category')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif </h3>
        </div>
        @include('Error/flash_message')
        <form action="@if($text =='Edit') {{route('catrgories.update',@$menu_category->id)}} @else {{route('catrgories.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-8">

              <div class="card-body">
                <div class="form-group">
                  <label for="title">{{__('Category')}} {{__('Title')}}:*</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title" placeholder="Enter Category Title" value="{{@$menu_category->title}}">
                  @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="my-editor">{{__('Category')}} {{__('Description')}}:</label>
                  <textarea name="description" class="form-control ckeditor" id="my-editor" cols="30" rows="10"> {{@$menu_category->description}}</textarea>
                </div>

                <div class="form-group" style="width: max-content;">
                  <label for="position">{{__('Position')}}:</label>
                  <input type="number" class="form-control" id="position" name="position" value="{{@$menu_category->position}}">
                </div>

              </div>

            </div>



            <div class="col-md-4">
              <div class="row">
                <div class="card-body">

                  <div class="form-group col-lg-6">
                    <label>{{__('Display on')}}: </label>
                    <select class="form-control select2" style="width: 100%;" id="show_on" name="show_on">
                      <option selected="selected" value="header" @if(@$menu_category->show_on=='header') selected @endif >Header</option>
                      <option value="footer" @if(@$menu_category->show_on=='footer') selected @endif >Footer</option>
                      <option value="both" @if(@$menu_category->show_on=='both') selected @endif >Both</option>
                      <option value="none" @if(@$menu_category->show_on=='none') selected @endif >None</option>
                    </select>
                  </div>

                  <div class="form-group col-lg-6">
                    <label>{{__('Publish Status')}}: </label>
                    <select class="form-control select2" style="width: 100%;" id="status" name="status">
                      <option selected="selected" value="yes" @if(@$menu_category->status=='yes') selected @endif >Yes</option>
                      <option value="no" @if(@$menu_category->status=='no') selected @endif>No</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Feature Image')}}:</label><br>
                    <input type="file" id="feature_img" name="feature_img"><br><br>
                    <img id="previewfeature_img" />

                    @if(@$text=='Edit')


                    <img id="outputfeature_img" src="{{asset(@$menu_category->feature_img)}}" style=" width: 100px; height:100px;">
                    <a href="#" id="hidefeature_img" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                    @endif

                  </div>

                  <div class="form-group">
                    <label>{{__('Parallex Image')}}:</label><br>
                    <input type="file" id="parallex_img" name="parallex_img"><br><br>
                    <img id="previewparallex_img" />

                    @if(@$text=='Edit')
                    <img id="outputparallex_img" src="{{asset(@$menu_category->parallex_img)}}" style="width: 100px; height:100px;">
                    <a href="#" id="hideparallex_img" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                    @endif

                  </div>

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

@include('layouts/ckeditor')
<script>
  $(document).ready(function() {


    $("#feature_img").on('change', function() {

      event.preventDefault();
      if (event.target.files.length > 0) {
        var imgsrc = URL.createObjectURL(event.target.files[0])
        $("#previewfeature_img").attr("height", "100")
        $("#previewfeature_img").attr('src', imgsrc);

        // for hide image
        $("#outputfeature_img").css('display', 'none');
        $("#hidefeature_img").css('display', 'none');


      }

    });


    $("#parallex_img").on('change', function() {
      event.preventDefault();
      if (event.target.files.length > 0) {
        var imgsrc = URL.createObjectURL(event.target.files[0])
        $("#previewparallex_img").attr("height", "100");
        $("#previewparallex_img").attr('src', imgsrc);

        //for hide image
        $("#outputparallex_img").css('display', 'none');
        $("#hideparallex_img").css('display', 'none');


      }
    });

    //for hide image
    $("#hideparallex_img").on('click', function() {
      $("#outputparallex_img").css('display', 'none');
      $("#hideparallex_img").css('display', 'none');

    });

    $("#hidefeature_img").on('click', function() {
      $("#outputfeature_img").css('display', 'none');
      $("#hidefeature_img").css('display', 'none');

    });



  });
</script>

@endsection