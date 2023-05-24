@php
  $doctor_prifix = trans('siteConfig.subDomain.web.doctor');
  $login_user = Request()->user();
  
@endphp
<!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row position-relative p-2">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index-2.html"><img class="brand-logo" alt="modern admin logo" src="{{storageUrl_h(trans('siteConfig.setting.logo'))}}"></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <p class="bg-white font-size-large text-center">Hello <strong>{{ auth()->user()->name }}</strong></p>
      <div class="main-menu-content  p-1">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item @if( Request()->path() ==  $doctor_prifix) active @endif "><a href="{{url($doctor_prifix.'/')}}"><i class="la la-th-large"></i>Dashboard</a></li> 
          <li class=" nav-item @if( Request()->path() ==  $doctor_prifix.'/case') active @endif "><a href="{{url($doctor_prifix.'/case')}}"><i class="la la-medkit"></i>Cases</a></li>
          <li class=" nav-item @if( Request()->path() ==  $doctor_prifix.'/account-details') active @endif "><a href="{{url($doctor_prifix.'/account-details/'.$login_user->id)}}"><i class="la la-user"></i>My Profile</a></li>
          <li class=" nav-item @if( Request()->path() ==  $doctor_prifix.'/accualigner-agreements') active @endif "><a href="{{url($doctor_prifix.'/accualigner-agreements')}}"><i class="la la-medkit"></i>Accualigners Agreement</a></li>
          <li class=" nav-item @if( Request()->path() ==  $doctor_prifix.'/downloads') active @endif "><a href="{{url($doctor_prifix.'/downloads')}}"><i class="la la-download"></i>Downloads</a></li>
        </ul>
        {{-- <hr/>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

          <li class=" nav-item"><a href="{{url(trans('siteConfig.subDomain.web.doctor').'/')}}"><i class="la la-gear"></i>Settings</a></li>
          
        </ul> --}}

      </div>
    </div>

    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-bottom navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header navbar-footer">
          <img class="media-object rounded-circle width-50" src="{{$login_user->picture}}" alt="User picture">
          <a href="{{route("logout")}}" class="logout-btn btn btn-outline-info btn-round float-right white" title="Logout"><i class="la la-power-off"></i></a>
        </div>
      </div>
    </nav>
    
    