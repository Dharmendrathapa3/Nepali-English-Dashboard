<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


<head>
  @include('layouts/head')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('layouts/navbar')
    @include('layouts/sidebar')



    @section('main-content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">{{__('Dashboard')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>  @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($menucategories)}} @else  {{getUnicodeNumber(count($menucategories))}}  @endif</h3>

                  <b>
                    <p>{{__('Menu Categories')}}</p>
                  </b>
                </div>
                <div class="icon">
                  <i class="fas fa-sitemap"></i>
                </div>
                <a href="{{route('catrgories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($product)}} @else  {{getUnicodeNumber(count($product))}}  @endif </h3>

                  <b>
                    <p>{{__('Products')}}</p>
                  </b>
                </div>
                <div class="icon">
                  <i class="fa fa-database"></i>
                </div>
                <a href="{{route('product.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($content)}} @else  {{getUnicodeNumber(count($content))}}  @endif  </h3>

                  <strong>
                    <p>{{__('Content')}}</p>
                  </strong>
                </div>
                <div class="icon">
                  <i class="fa fa-folder-open"></i>
                </div>
                <a href="{{route('content.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>  @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($tag)}} @else  {{getUnicodeNumber(count($tag))}}  @endif  </h3>

                  <strong>
                    <p>{{__('Tags')}}</p>
                  </strong>
                </div>
                <div class="icon">
                  <i class="fa fa-tags"></i>
                </div>
                <a href="{{route('tag.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($testimonial)}} @else  {{getUnicodeNumber(count($testimonial))}}  @endif  </h3>

                  <strong>
                    <p>{{__('Testimonials')}} </p>
                  </strong>

                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="{{route('testimonial.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{count($slider)}} @else  {{getUnicodeNumber(count($slider))}}  @endif  </h3>

                  <strong>
                    <p>{{__('Slider')}}</p>
                  </strong>
                </div>
                <div class="icon">
                  <i class="fa fa-sliders"></i>
                </div>
                <a href="{{route('slider.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{ count($gallery) }} @else  {{getUnicodeNumber(count($gallery))}}  @endif  </h3>

                  <strong>
                    <p>{{__('Gallery')}}</p>
                  </strong>
                </div>
                <div class="icon">
                  <i class="fa fa-picture-o"></i>
                </div>
                <a href="{{route('gallery.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3> @if( App::getLocale()=='en' || session()->get('locale')=='en' ) {{ count($users) }} @else  {{getUnicodeNumber( count($users) )}}  @endif  </h3>

                  <strong>
                    <p>{{__('Users')}}</p>
                  </strong>
                </div>
                <div class="icon">
                  <i class=" fa fa-user-circle"></i>
                </div>
                <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>
          <!-- /.row -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @show




    @include('layouts/footer')
  </div>

</body>

</html>