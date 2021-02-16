<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url('/')}}" class="nav-link">{{__('Home')}}</a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">


    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>



    <!-- User Account: style can be found in dropdown.less -->
    <li class="nav-item dropdown">
      <a class="nav-link pl-0" data-toggle="dropdown" href="#" aria-expanded="false">
        <span>{{Auth::user()->name}} <i class="fas fa-angle-down fa-xs pl-1"></i></span>
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="left: inherit; right: 0px;">
        <a href="#" class="dropdown-item pl-3 href=" "="">
                            <i class=" fas fa-user pr-1"></i> Profile</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item pl-3" type="button"> <i class="fas fa-cog pr-1"></i>Settings</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item pl-3" href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off pr-1"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>





    <!-- language Changer -->

    <li class="nav-item dropdown">
      <p style="margin: 10px;">{{__('Chage Language:')}}</p>
      @if(session()->get('locale') == "np")
    <li class="nav-item">
      <a id="en" href="{{route('setLanguage','en')}}" class="nav-link"><img src="{{asset('extra/English.png')}}" style="margin: -20px; width:30px; height:30px"></a>

    </li>
    @endif


    @if(session()->get('locale') == "en" || app()->getLocale()=='en')
    <li class="nav-item">
      <a id="np" href="{{route('setLanguage','np')}}" class="nav-link"><img src="{{asset('extra/Nepali.png')}}" style="margin: -20px; width:30px; height:30px; "></a>
    </li>
    @endif
    </li>
  </ul>
</nav>
<!-- /.navbar -->