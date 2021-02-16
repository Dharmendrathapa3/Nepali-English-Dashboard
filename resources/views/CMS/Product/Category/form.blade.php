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
            <li class="breadcrumb-item"><a href="{{route('ProductCategory.index')}}">{{__('Product')}} {{__('Category')}}</a></li>
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
          <h3 class="card-title">{{__('Product')}} {{__('Category')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</h3>
        </div>

        <form action="@if(@$text=='Edit'){{route('ProductCategory.update',$procat->id)}} @else {{route('ProductCategory.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-7">

              <div class="card-body">
                <div class="form-group">
                  <label for="name">{{__('Product')}} {{__('Category')}} {{__('Name')}}:*</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Category Name" value="{{@$procat->name}}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


                <div class="form-group">
                  <label for="description">{{__('Product')}} {{__('Category')}} {{__('Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor" name="descroption"> {{@$procat->descroption}} </textarea>
                </div>

              </div>

            </div>



            <div class="col-md-5">
              <div class="card-body">

                <div class="form-group col-lg-6" style="width:max-content;">
                  <label>{{__('Parent')}} {{__('Product')}} {{__('Category')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="parent" name="parent">
                    <option selected="selected" disabled>Select Product Category</option>


                    @if(count($productcatgeory)>0)

                          @foreach ($productcatgeory as $category)
                          
                        
                              <option value="{{$category->id}}" @if(@$procat->parent==$category->id) selected @endif > {{ $category->name }} </option>  

                                    @include('Tree.child_category', ['child_category' => $category->childrenCategories,'procat'=>@$procat,'a'=>2])
                                    
                        
                          @endforeach

                    @endif

                  </select>
                </div>



                <div class="form-group col-lg-6" style="width:max-content;">
                  <label>{{__('Publish Status')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="stauts" name="stauts">
                    <option selected="selected" value="yes" @if(@$procat->stauts=='yes') selected @endif >Yes</option>
                    <option value="no" @if(@$procat->stauts=='no') selected @endif>No</option>
                  </select>
                </div>

                <div class="form-group" style="width: max-content;">
                  <label for="position">{{__('Product')}} {{__('Category')}} {{__('Position')}} : </label>
                  <input type="number" class="form-control" id="position" name="position" value="{{@$procat->position}}">
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

@endsection