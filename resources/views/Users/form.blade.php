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
                        <li class="breadcrumb-item"><a href="{{route('tag.index')}}">{{__('User')}}</a></li>
                        <li class="breadcrumb-item active"> @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</li>
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
                                                                  <!-- for variable language change use getvariable helper file -->
                    <h3 class="card-title">{{__('User')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif </h3>
                </div>

                <form action="@if(@$text=='Edit') {{route('user.update',$user->id)}} @else {{route('user.store')}} @endif" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-8">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Full')}} {{__('Name')}} :*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{__('Full')}} {{__('Name')}}" value="{{@$user->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">{{__('Email')}} :*</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror " id="email" name="email" placeholder="{{__('Email')}}" value="{{@$user->email}}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                @if($text == 'Add')

                                <div class="form-group">
                                    <label for="password">{{__('Password')}} :*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{__('Password')}}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cpassword">{{__('Conform')}} {{__('Password')}} :*</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="{{__('Conform')}} {{__('Password')}}">
                                </div>

                                <div class="form-group" style="width: max-content;">
                                    <label>{{__('Role')}}</label>
                                    <select class="form-control select2 @error('role_id') is-invalid @enderror" style="width: 100%;" name="role_id">
                                        <option selected="selected" disabled>{{__('Choose Role')}}</option>
                                        @foreach($role as $roles)
                                        <option value="{{$roles->id}}">{{$roles->name}}</option>

                                        @endforeach

                                    </select>

                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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