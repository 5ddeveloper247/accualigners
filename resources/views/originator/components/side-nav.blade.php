@php
$login_user = Request()->user();
$role = auth()->user()->role;
$slug = $role->slug;
@endphp
<!-- fixed-top-->
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row position-relative p-2">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index-2.html"><img class="brand-logo"
                            alt="modern admin logo" src="{{ storageUrl_h(trans('siteConfig.setting.logo')) }}">
                    </a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content  p-1">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if (Request()->path() == $slug) active @endif ">
                <a href="{{ url($slug . '/') }}"><i class="la la-th-large"></i>Dashboard</a>
            </li>
            @if ($role->slug === 'admin')
            {{-- <li class=" nav-item @if (Request()->path() == $slug . '/patient') active @endif "><a
                    href="{{url($slug.'/patient')}}"><i class="la la-user-plus"></i>Patients</a></li>
            --}}
            <li class=" nav-item @if (Request()->path() == $slug . '/case') active @endif "><a
                    href="{{ url($slug . '/case') }}"><i class="la la-medkit"></i>Cases</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/roles') active @endif "><a
                    href="{{ url($slug . '/roles') }}"><i class="la la-users"></i>Roles</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/appointment') active @endif "><a
                    href="{{ url($slug . '/appointment') }}"><i class="la la-calendar-o"></i>Appointments</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/order') active @endif "><a
                    href="{{ url($slug . '/order') }}"><i class="la la-suitcase"></i>Orders</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/clinic') active @endif "><a
                    href="{{ url($slug . '/clinic') }}"><i class="la la-stethoscope"></i>Clinic</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/doctor') active @endif "><a
                    href="{{ url($slug . '/doctor') }}"><i class="la la-user-plus"></i>Doctors</a></li>
            {{-- <li class=" nav-item @if (Request()->path() == $slug . '/shipping') active @endif "><a
                    href="{{url($slug.'/shipping')}}"><i class="la la-truck"></i>Shipping</a></li> --}}
            {{-- <li class=" nav-item @if (Request()->path() == $slug . '/tool') active @endif "><a
                    href="{{url($slug.'/tool')}}"><i class="la la-plus-circle"></i>Tools</a></li> --}}
            <li class=" nav-item @if (Request()->path() == $slug . '/user') active @endif "><a
                    href="{{ url($slug . '/user') }}"><i class="la la-user"></i>Users</a></li>
            <li class=" nav-item @if (Request()->path() == $slug . '/slider') active @endif "><a
                    href="{{ url($slug . '/slider') }}"><i class="la la-image"></i>Sliders</a></li>
            {{-- <li class=" nav-item @if (Request()->path() == $slug . '/payment') active @endif "><a
                    href="{{url($slug.'/payment')}}"><i class="la la-bar-chart"></i>Payments</a></li> --}}
        </ul>
        <hr />
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if (Request()->path() == $slug . '/setting') active @endif "><a
                    href="{{ url($slug . '/setting') }}"><i class="la la-gear"></i>Settings</a></li>
        </ul>

        @elseif($role->slug === 'lab-technician')
        <li class=" nav-item @if (Request()->path() == $slug . '/order') active @endif "><a
                href="{{ url($slug . '/order') }}"><i class="la la-suitcase"></i>Orders</a></li>
        @else
        <li class=" nav-item @if (Request()->path() == $slug . '/doctor') active @endif "><a
                href="{{ url($slug . '/doctor') }}"><i class="la la-user-plus"></i>Doctors</a></li>
        <li class=" nav-item @if (Request()->path() == $slug . '/clinic') active @endif "><a
                href="{{ url($slug . '/clinic') }}"><i class="la la-stethoscope"></i>Clinic</a></li>

        <li class=" nav-item @if (Request()->path() == $slug . '/slider') active @endif "><a
                href="{{ url($slug . '/slider') }}"><i class="la la-image"></i>Sliders</a></li>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if (Request()->path() == $slug . '/setting') active @endif "><a
                    href="{{ url($slug . '/setting') }}"><i class="la la-gear"></i>Settings</a></li>
        </ul>
        @endif
    </div>
</div>

<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-bottom navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header navbar-footer">
            <!--<img class="media-object rounded-circle width-50" src="{{ $login_user->picture }}" alt="User picture">-->
            <a href="{{ route('logout') }}" class="logout-btn btn btn-outline-info btn-round float-left white" title="Logout"><i
                    class="la la-power-off"></i></a>
        </div>
    </div>
</nav>