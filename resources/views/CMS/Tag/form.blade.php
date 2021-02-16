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
            <li class="breadcrumb-item"><a href="{{route('tag.index')}}">{{__('Tag')}}</a></li>
            <li class="breadcrumb-item active">@if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif </li>
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
          <h3 class="card-title">{{__('Tag')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</h3>
        </div>

        <form action="@if(@$text=='Edit') {{route('tag.update',@$tags->id)}} @else {{route('tag.store')}} @endif" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-8">

              <div class="card-body">
                <div class="form-group">
                  <label for="name">{{__('Tag')}} {{__('Name')}}:*</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" placeholder="Enter Tag Name" value="{{@$tags->name}}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">{{__('Tag')}} {{__('Description')}}:</label>
                  <textarea class=" ckeditor form-control" id="my-editor" name="description"> {{@$tags->description}} </textarea>
                </div>



              </div>

            </div>


            <div class="col-md-4">

              <div class="card-body">


                <div class="form-group col-lg-6">
                  <label>{{__('Publish Status')}}: </label>
                  <select class="form-control select2" style="width: 100%;" id="status" name="status">
                    <option selected="selected" value="yes" @if(@$tags->status=='yes') selected @endif>{{__('Yes')}}</option>
                    <option value="no" @if(@$tags->status=='no')) selected @endif >{{__('No')}}</option>
                  </select>
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