
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if( Request()->path() ==  '/') active @endif ">
                <a class=" nav-link" href="{{url('/')}}"><i class="la la-home"></i>
                    <span>Home</span>
                </a>
            </li>

            @if(checkNavPermission([1,13]))
                <li class="dropdown nav-item @if(checkActiveNav([1,2,3,4,6,7,8,9,10,11,12])) active @endif " data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-cog"></i>
                        <span>Originator Catalogue</span>
                    </a>
                    <ul class="dropdown-menu">
                        @if(checkNavPermission([1]))
                            <li class=" @if(checkActiveNav([1,2,3,4,12])) active @endif " data-menu="">
                                <a class="dropdown-item" href="{{url('user-type')}}" data-toggle="dropdown">Users</a>
                            </li>
                        @endif
                        @if(checkNavPermission([7]))
                            <li class=" @if(checkActiveNav([6,7,8,9,10,11])) active @endif " data-menu="">
                                <a class="dropdown-item" href="{{url('country')}}" data-toggle="dropdown">Geography</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(checkNavPermission([5]))
                <li class="nav-item @if(checkActiveNav([5])) active @endif ">
                    <a class=" nav-link" href="{{url('category')}}"><i class="la la-sitemap"></i>
                        <span>Categories</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
