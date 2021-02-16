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
                        <li class="breadcrumb-item active">{{__('Contents')}}</li>
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
                            <h3 class="card-title">{{__('Content Lists')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="padding: 4px;">
                            <!-- Start Searching -->
                            <div class="row" style="padding:4px;">
                                <div class="p-1 col-lg-2">
                                    <div class="btn-group">
                                        <a href="{{route('content.index')}}" class="btn btn-primary btn-flat btn-sm">
                                            <i class="fas fa-sync-alt fa-sm"></i> {{__('Refresh')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 col-lg-7">
                                    <form action="{{url('content/search')}}" method="get">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <input class="form-control" placeholder="{{__('Search by Title')}}" name="keyword" type="text">
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-4">
                                                <button class="btn btn-primary btn-flat"><i class="fa fa fa-search"></i>
                                                    {{__('Filter')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @canany('add-Content')
                                <div class="p-1 col-lg-3">
                                    <div class="card-tools">
                                        <a href="{{route('content.create')}}" class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> {{__('Add New Content')}}</a>
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
                                        <th> {{__('Title')}}</th>
                                        <th> {{__('Sub Title')}}</th>
                                        <th> {{__('Description')}}</th>
                                        <th> {{__('Short Description')}}</th>
                                        <th>{{__('Show On')}}</th>
                                        <th>{{__('Publish Status')}}</th>

                                        <th> {{__('Feature Image')}}</th>
                                        <th> {{__('Parallex Image')}}</th>
                                        <th> {{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($content as $contents)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$contents->title}}</td>
                                        <td>{{$contents->subtitle}}</td>
                                        <td>{!! $contents->description !!}</td>
                                        <td>{!! $contents->short_description !!}</td>
                                        <td>{{$contents->show_on}}</td>
                                        <td>{{$contents->status}}</td>

                                        <td>
                                            <img src="{{ asset( $contents->feature_img ) }}" style="object-fit:scale-down; width: 100px; height:50px;">
                                        </td>

                                        <td>
                                            <img src="{{ asset( $contents->parallex_img ) }}" style="object-fit:scale-down; width: 100px; height:50px;">
                                        </td>

                                        <td>

                                            @canany('update-Content','delete-Content')
                                            <a href="{{route('content.edit',$contents->id)}}" class="btn btn-primary"> <i class="fas fa-edit"></i> {{__('Edit')}} </a>
                                            <form id="delete-{{$contents->id}}" action="{{route('content.destroy',$contents->id)}}" method="GET" style="display: none;">
                                            @csrf
                                            </form>
                                            <a onclick="Delete('{{$contents->id}}');" href="" class="btn btn-danger" style="width: max-content;"> <i class="fa fa-trash"></i> {{__('Delete')}} </a>
                                            @endcanany
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>{{__('S.N')}}</th>
                                        <th> {{__('Title')}}</th>
                                        <th> {{__('Sub Title')}}</th>
                                        <th> {{__('Description')}}</th>
                                        <th> {{__('Short Description')}}</th>
                                        <th>{{__('Show On')}}</th>
                                        <th>{{__('Publish Status')}}</th>

                                        <th> {{__('Feature Image')}}</th>
                                        <th> {{__('Parallex Image')}}</th>
                                        <th> {{__('Action')}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            {{$content->links()}}
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