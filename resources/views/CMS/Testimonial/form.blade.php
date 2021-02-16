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
            <li class="breadcrumb-item"><a href="{{route('testimonial.index')}}">{{__('Testimonials')}}</a></li>
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
          <h3 class="card-title"> {{__('Testimonials')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</h3>
        </div>

        <form action="@if($text=='Edit') {{route('testimonial.update',@$testimoniales->id)}} @else {{route('testimonial.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">

            <div class="col-md-8">

              <div class="card-body">
                <div class="form-group">
                  <label for="name">{{__('Testimonials')}} {{__('Name')}} :*</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" placeholder="Enter Testimonial Name" value="{{@$testimoniales->name}}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">{{__('Testimonials')}} {{__('Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor" name="description"> {{@$testimoniales->description}} </textarea>
                </div>

              </div>

            </div>


            <div class="col-md-4">

              <div class="card-body">

                <div class="form-group" style="width: max-content;">
                  <label for="position">{{__('Position')}}:</label>
                  <input type="number" class="form-control" id="position" name="position" value="{{@$testimoniales->position}}">
                </div>

                <div class="form-group col-lg-6" style="width: max-content;">
                  <label>{{__('Publish Status')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="status" name="status">
                    <option selected="selected" value="yes" @if(@$testimoniales->status=='yes') selected @endif >Yes</option>
                    <option value="no" @if(@$testimoniales->status=='no') selected @endif >No</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>{{__('Testimonials')}} {{__('Image')}}:</label><br>
                  <input type="file" id="image" name="image"><br><br>
                  <img id="previewimage">
                  @if(isset($testimoniales->image))

                  <img id="outputimage" src="{{asset(@$testimoniales->image)}}" style="width: 100px; height:100px;" />
                  <a href="#" id="hideimage" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

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



@endsection
@section('footer-section')
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

@include('layouts/ckeditor')

<script>
  $(document).ready(function() {

    $("#image").on('change', function() {

      event.preventDefault();
      if (event.target.files.length > 0) {
        var imgsrc = URL.createObjectURL(event.target.files[0])


        $("#previewimage").attr("height", "100");
        $("#previewimage").attr('src', imgsrc);
        $("#outputimage").css('display', 'none');
        $("#hideimage").css('display', 'none');


      }

    });

    $("#hideimage").on('click', function() {
      $("#outputimage").css('display', 'none');
      $("#hideimage").css('display', 'none');

    });

  });
</script>

@endsection