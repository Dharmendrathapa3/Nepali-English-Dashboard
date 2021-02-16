  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ @Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item menu-open">
            <a href="/" class="nav-link active">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>{{__('Dashboard')}}</p>
            </a>
          </li>


          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-pencil"></i>
              <p>
                {{__('CMS Page')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('catrgories.index')}}" class="nav-link {{ request()->is('catrgories*') ? 'active' : '' }}">
                  <i class="fa fa-sitemap nav-icon"></i>
                  <p>{{__('Menu Categories')}}</p>
                </a>
              </li>


              <li class="nav-item menu-open">
                <a href="" class="nav-link {{ request()->is('product*') ? 'active' : '' }} {{ request()->is('ProductCategory*') ? 'active' : '' }}">
                  <i class="fa fa-database  nav-icon" aria-hidden="true"></i>
                  <p>
                    {{__('Products')}}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="{{route('ProductCategory.index')}}" class="nav-link {{ request()->is('ProductCategory*') ? 'active' : '' }}">
                      <i class="fa fa-sitemap   nav-icon" aria-hidden="true"></i>
                      <p>{{__('Product Categories')}}</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link {{ request()->is('product*') ? 'active' : '' }}">
                      <i class="fa fa-database  nav-icon" aria-hidden="true"></i>
                      <p>{{__('Product')}}</p>
                    </a>
                  </li>


                </ul>
              </li>

              <li class="nav-item">
                <a href="{{route('content.index')}}" class="nav-link {{ request()->is('content*') ? 'active' : '' }}">
                  <i class="fa fa-folder-open nav-icon"></i>
                  <p>{{__('Content')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tag.index')}}" class="nav-link {{ request()->is('tag*') ? 'active' : '' }}">
                  <i class="fa fa-tags nav-icon"></i>
                  <p>{{__('Tags')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('testimonial.index')}}" class="nav-link {{ request()->is('testimonial*') ? 'active' : '' }}">
                  <i class="fa fa-user nav-icon"></i>
                  <p>{{__('Testimonials')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('slider.index')}}" class="nav-link {{ request()->is('slider*') ? 'active' : '' }}">
                  <i class="fa fa-sliders nav-icon" aria-hidden="true"></i>
                  <p>{{__('Slider')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('gallery.index')}}" class="nav-link {{ request()->is('gallery*') ? 'active' : '' }}">
                  <i class="fa fa-picture-o nav-icon" aria-hidden="true"></i>
                  <p>{{__('Gallery')}}</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                {{__('User Managment')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                  <i class="fas fa-user-shield nav-icon"></i>
                  <p>{{__('Add Role and Permission')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>{{__('Users')}}</p>
                </a>
              </li>


              @role('Super Admin')
              <li class="nav-item">
                <a href="{{route('user.trash.index')}}" class="nav-link {{ request()->is('user/trash*') ? 'active' : '' }}">
                  <i class=" fa fa-trash nav-icon"></i>
                  <p>{{__('Trash Users')}}</p>
                </a>
              </li>
              @endrole


            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


