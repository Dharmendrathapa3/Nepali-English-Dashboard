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
            <li class="breadcrumb-item"><a href="{{route('content.index')}}">{{__('Content')}}</a></li>
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
          <h3 class="card-title"> {{__('Content')}}  @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif </h3>
        </div>

        <form action="@if(@$text=='Edit'){{route('content.update',@$content->id)}} @else {{route('content.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-7">

              <div class="card-body">
                <div class="form-group">
                  <label for="title">{{__("Content's")}} {{__('Title')}} :*</label>
                  <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter Content Title" value="{{@$content->title}}">
                  @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="title">{{__("Content's")}} {{__('Sub Title')}} :</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter Content Sub Title" value="{{@$content->subtitle}}">
                </div>
                <div class="form-group">
                  <label for="description">{{__("Content's")}} {{__('Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor" name="description"> {{@$content->description}}</textarea>
                </div>
                <div class="form-group">
                  <label for="short_description">{{__("Content's")}} {{__('Short Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor1" name="short_description">{{@$content->short_description}} </textarea>
                </div>

              </div>

            </div>



            <div class="col-md-5">
              <div class="card-body">

                <div class="row">

                  <div class="form-group col-lg-6" style="width:max-content;">
                    <label>{{__('Display on')}}: </label>
                    <select class="form-control select2" style="width: 100%;" id="show_on" name="show_on">
                      <option selected="selected" value="header" @if(@$content->show_on=='header') selected @endif>Header</option>
                      <option value="footer" @if(@$content->show_on=='footer') selected @endif>Footer</option>
                      <option value="both" @if(@$content->show_on=='both') selected @endif >Both</option>
                      <option value="none" @if(@$content->show_on=='none') selected @endif >None</option>
                    </select>
                  </div>

                  <div class="form-group col-lg-6" style="width:max-content;">
                    <label>{{__('Publish Status')}}: </label>
                    <select class="form-control select2" style="width: 100%;" id="status" name="status">
                      <option selected="selected" value="yes" @if(@$content->status=='yes') selected @endif >{{__('Yes')}}</option>
                      <option value="no" @if(@$content->status=='no') selected @endif >{{__('No')}}</option>
                    </select>
                  </div>

                </div><br>

                <div class="form-group">
                  <label>{{__('Feature Image')}}:</label><br>
                  <input type="file" id="feature_img" name="feature_img"><br><br>
                  <img id="previewfeature_img">

                  @if(@$text=='Edit')
                  <img id="outputfeature_img" src="{{asset(@$content->feature_img)}}" style=" width: 100px; height:100px;">
                  <a href="#" id="hidefeature_img" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                  @endif
                </div> <br>

                <div class="form-group">
                  <label>{{__('Parallex Image')}}:</label><br>
                  <input type="file" id="parallex_img" name="parallex_img"><br><br>
                  <img id="previewparallex_img">
                  @if(@$text=='Edit')
                  <img id="outputparallex_img" src="{{asset(@$content->parallex_img)}}" style="width: 100px; height:100px;">
                  <a href="#" id="hideparallex_img" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                  @endif
                </div><br>

                <div class="form-group">
                  <label for="meta_title">{{__('Meta')}} {{__('Title')}}:*</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{@$content->meta_title}}">
                </div>
                <div class="form-group">
                  <label for="meta_keyword">{{__('Meta')}} {{__('Keyword')}}:</label>
                  <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Enter Meta Keyword" value="{{@$content->meta_keyword}}">
                </div>
                <div class="form-group">
                  <label for="meta_description">{{__('Meta')}} {{__('Description')}}:</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" value="{{@$content->meta_description}}">
                </div>

                <div>

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

    $("#feature_img").on('change', function() {

      event.preventDefault();
      if (event.target.files.length > 0) {
        var imgsrc = URL.createObjectURL(event.target.files[0])


        $("#previewfeature_img").attr("height", "100")
        $("#previewfeature_img").attr('src', imgsrc);

        //for hide image
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
        $("#outputparallex_img").css('display', 'none');

        // for hide image
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