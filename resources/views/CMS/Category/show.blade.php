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
                        <li class="breadcrumb-item"><a href="">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Menu Categories')}}</li>
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
                            <h3 class="card-title">{{__('Categories List')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="padding:4px;">

                            <!-- Start Searching -->
                            <div class="row" style="padding:4px;">
                                <div class="p-1 col-lg-2">
                                    <div class="btn-group">
                                        <a href="{{route('catrgories.index')}}" class="btn btn-primary btn-flat btn-sm">
                                            <i class="fas fa-sync-alt fa-sm"></i> {{__('Refresh')}}
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 col-lg-7">
                                    <form action="{{url('catrgories/search')}}" method="get">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <input class="form-control" placeholder="{{__('Search by Title')}}" id="keyword" name="keyword" type="text">
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-4">
                                                <button class="btn btn-primary btn-flat"><i class="fa fa fa-search"></i>
                                                    {{__('Filter')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @canany('add-Menu_Categories')
                                <div class="p-1 col-lg-3">
                                    <div class="card-tools">
                                        <a href="{{route('catrgories.create')}}" class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> {{__('Add New Category')}}</a>
                                    </div>
                                </div>
                                @endcanany
                            </div>

                            <!-- End Searching -->


                            <!-- for data view -->
                            <div id="table_data">
                                @include('Error/flash_message')
                                @include('CMS/Category/data')
                            </div>


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

<script type="text/javascript">
    $(document).ready(function() {

        $("#table_data").on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            // console.log(page);
            $.ajax({

                url: '?page=' + page,

                type: "get",

                datatype: "page",
                success: function(data) {

                    $('#table_data').html(data);
                }

            });


        });




    });
</script>

@endsection