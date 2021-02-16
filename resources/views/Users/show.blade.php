@extends('app')

@section('head-section')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

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
                        <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Users')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('User Lists')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="padding:4px;">


                            <!-- Start Searching -->
                            <div class="row" style="padding:4px;">
                                <div class="p-1 col-lg-2">
                                    <div class="btn-group">
                                        <a href="{{route('user.index')}}" class="btn btn-primary btn-flat btn-sm">
                                            <i class="fas fa-sync-alt fa-sm"></i> {{__('Refresh')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 col-lg-7">
                                    <form action="{{url('users/search')}}" method="get">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <input class="form-control" placeholder="{{__('Search by Name')}}" name="keyword" type="text">
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-4">
                                                <button class="btn btn-primary btn-flat"><i class="fa fa fa-search"></i>
                                                    {{__('Filter')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @canany('add-Users')
                                <div class="p-1 col-lg-3">
                                    <div class="card-tools">
                                        <a href="{{route('user.create')}}" class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> {{__('Add New User')}}</a>
                                    </div>
                                </div>
                                @endcanany
                            </div>

                            <!-- End Searching -->
                            @include('Error/flash_message')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{__('S.N')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Email')}}</th>
                                        <th>{{__('User Role')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $users)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$users->name}}</td>
                                        <td>{{$users->email}}</td>

                                        <td>{{ $users->getRoleNames()[0] }}</td>


                                        <td>
                                            @canany('update-Users','delete-Users')
                                            <a href="{{route('user.edit',$users->id)}}" class="btn btn-primary" style="width: max-content;"> <i class="fas fa-edit"></i> {{__('Edit')}} </a>

                                            <form id="delete-{{$users->id}}" action="{{route('user.destroy',$users->id)}}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <a onclick="Delete('{{$users->id}}');" href="" class="btn btn-danger" style="width: max-content;"> <i class="fa fa-trash"></i> {{__('Delete')}} </a>
                                            <a href="{{route('user.changepasswordform',$users->id)}}" class="btn btn-success" style="width: max-content;"> <i class="fa fa-exchange"></i> {{__('Change Password')}} </a>
                                            @endcanany
                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>{{__('S.N')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Email')}}</th>
                                        <th>{{__('User Role')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{$user->links()}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('footer-section')

@include('layouts/DeleteItem')

@endsection