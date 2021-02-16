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
                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">{{__('Role and Permission')}}</a></li>
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
                    <h3 class="card-title"> {{__('Role and Permission')}} @if(App::getLocale()=='en' || session()->get('locale')=='en') {{ $text }} @else {{getvariable($text)}} @endif</h3>
                </div>

                <form action="@if(@$text=='Edit') {{route('role.update',$role->id)}} @else {{route('role.store')}} @endif" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group" style="width: max-content;">
                            <label for="name">{{__('Role')}} {{__('Name')}}:*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Role Name" value="{{@$role->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="name">{{__('Permissions')}}</label><br>

                            <input type="checkbox" id="select-all">
                            <label for="select-all"> Select All</label><br>


                            <div class="row">
                                @foreach($permission as $key=>$value)

                                <div class="col-lg-3">
                                    <div>
                                        @if($key%4 == 0)
                                        <strong class="badge badge-success" style="font-size: medium;">Manage {{ucfirst(explode('-',$value->name)[1])}}:</strong>
                                        @else
                                        <strong class="">&nbsp;</strong>
                                        @endif
                                    </div>
                                    <div style="padding:10px;">
                                        <input type="checkbox" id="permission_id" name="permission_id[]" value="{{@$value->id}}" @if(in_array ( $value->id , $arrya)) checked @endif >
                                        <label style="font-family: initial;"> {{@$value->name }}</label><br>

                                    </div>

                                </div>
                                @endforeach



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


<script>
    $(document).ready(function() {

        $('#select-all').click(function(event) {
            if (this.checked) {

                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>


@endsection