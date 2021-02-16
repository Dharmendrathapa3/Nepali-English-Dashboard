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

                        <li class="breadcrumb-item active">Change Password</li>
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
                    <h3 class="card-title">Change Password</h3>
                </div>

                <form action="{{route('user.changepassword',$user->id)}}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-8">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Full Name :*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" value="{{@$user->name}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password :*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cpassword">Conform Password :*</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Conform">
                                </div>

                            </div>

                        </div>




                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>

        </div>



</div>


@endsection