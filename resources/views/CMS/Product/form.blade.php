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
            <li class="breadcrumb-item"><a href="{{route('product.index')}}">{{__('Product')}}</a></li>
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
          <h3 class="card-title">{{__('Product')}}  @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif </h3>
        </div>

        <form action=" @if($text=='Edit') {{route('product.update',@$products->id)}} @else {{route('product.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-7">

              <div class="card-body">
                <div class="form-group">
                  <label for="title">{{__('Product')}} {{__('Title')}}:*</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter Product Title" value="{{@$products->title}}">
                  @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">{{__('Product')}} {{__('Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor" name="description"> {{@$products->description}}</textarea>
                </div>

              </div>

            </div>



            <div class="col-md-5">
              <div class="card-body">
              <div class="form-group col-lg-6" style="width:max-content;">
                  <label>{{__('Parent')}} {{__('Product')}} {{__('Category')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="category_id" name="category_id">
                    <option selected="selected" disabled>Select Product Category</option>

                    @foreach($productcatgeory as $row)
                    <option value="{{$row->id}}" > {{@$row->name}}</option>
                    @endforeach

                  </select>
                </div>


                <div class="form-group col-lg-6" style="width:max-content;">
                  <label>{{__('Publish Status')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="status" name="status">
                    <option selected="selected" value="yes" @if(@$products->status=='yes') selected @endif >Yes</option>
                    <option value="no" @if(@$products->status=='no') selected @endif>No</option>
                  </select>
                </div>



                <div class="form-group">
                  <label>{{__('Product')}} {{__('Image')}}:</label><br>
                  <input type="file" id="image" name="image"><br><br>

                  <img id="previewimage">

                  @if(isset($products->image))
                  <img id="outputimage" src="{{ asset(@$products->image) }}" style=" width: 100px; height:100px;">
                  <a href="#" id="hideimage" class="fa fa-times-circle removeItem" style="position: absolute; color: red; margin: -10px auto; "></a>

                  @endif
                </div> <br>



                <div class="form-group">
                  <label for="meta_title">{{__('Meta')}} {{__('Title')}}:*</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{@$products->meta_title}}">
                </div>
                <div class="form-group">
                  <label for="meta_keyword">{{__('Meta')}} {{__('Keyword')}}:</label>
                  <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Enter Meta Keyword" value="{{@$products->meta_keyword}}">
                </div>
                <div class="form-group">
                  <label for="meta_description">{{__('Meta')}} {{__('Description')}}:</label>
                  <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" value="{{@$products->meta_description}}">
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