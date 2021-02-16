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
                        <li class="breadcrumb-item active">{{__('Testimonials')}}</li>
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
                            <h3 class="card-title">{{__('Testimonial Lists')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="padding: 4px;">
                            <!-- Start Searching -->
                            <div class="row" style="padding:4px;">
                                <div class="p-1 col-lg-2">
                                    <div class="btn-group">
                                        <a href="{{route('testimonial.index')}}" class="btn btn-primary btn-flat btn-sm">
                                            <i class="fas fa-sync-alt fa-sm"></i> {{__('Refresh')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 col-lg-7">
                                    <form action="{{url('testimonial/search')}}" method="get">
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
                                @canany('add-Testimonial')
                                <div class="p-1 col-lg-3">
                                    <div class="card-tools">
                                        <a href="{{route('testimonial.create')}}" class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> {{__('Add New Testimonial')}}</a>
                                    </div>
                                </div>
                                @endcanany
                            </div>

                            <!-- End Searching -->
                            @include('Error/flash_message')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> {{__('S.N')}}</th>
                                        <th> {{__('Name')}}</th>
                                        <th> {{__('Description')}}</th>
                                        <th> {{__('Position')}}</th>
                                        <th>{{__('Publish Status')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimoniales as $testimonial)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td> {{$testimonial->name}} </td>
                                        <td>{!! $testimonial->description !!}</td>
                                        <td> {{$testimonial->position}}</td>
                                        <td>{{$testimonial->status}}</td>
                                        <td>
                                            @if(isset($testimonial->image))
                                            <img src="{{ asset( $testimonial->image ) }}" style="object-fit:scale-down; width: 100px; height:50px;">
                                            @endif
                                        </td>
                                        <td>
                                            @canany('update-Testimonial','delete-Testimonial')
                                            <a href="{{route('testimonial.edit',$testimonial->id)}}" class="btn btn-primary"> <i class="fas fa-edit"></i> {{__('Edit')}} </a>
                                            <form id="delete-{{$testimonial->id}}" action="{{route('testimonial.destroy',$testimonial->id)}}" method="GET" style="display: none;">
                                                @csrf
                                            </form>
                                            <a onclick="Delete('{{$testimonial->id}}');" href="" class="btn btn-danger" style="width: max-content;"> <i class="fa fa-trash"></i> {{__('Delete')}} </a>
                                            @endcanany
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th> {{__('S.N')}}</th>
                                        <th> {{__('Name')}}</th>
                                        <th> {{__('Description')}}</th>
                                        <th> {{__('Position')}}</th>
                                        <th>{{__('Publish Status')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{$testimoniales->links()}}
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