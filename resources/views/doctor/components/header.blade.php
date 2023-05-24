<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="{{url('/')}}"><img class="brand-logo" alt="IdeaEcom Logo" src="{{storageUrl_h(trans('siteConfig.setting.logo'))}}">
                        {{--<h3 class="brand-text">{{trans('siteConfig.setting.name')}}</h3>--}}
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>

                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hello,<span class="user-name text-bold-700">{{originatorSession_h('first_name')}}</span></span><span class="avatar avatar-online"><img src="{{storageUrl_h(originatorSession_h('picture'))}}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{url('user-profile')}}"><i class="ft-user"></i> User Profile</a>
                            <a class="dropdown-item" href="{{url('logout')}}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>

                    {{--notifications--}}
                    @if(Request()->has('notificationCol'))
                        <li class=" dropdown-notification nav-item">
                            <a class="nav-link nav-link-label dropdown-toggle notification-click" href="javascript:void(0)" data-toggle="dropdown" data-id="{{originatorSession_h('user_id')}}">
                                <i class="ficon ft-bell"></i>
                                @if(collect(Request()->input('notificationCol'))->isNotEmpty())<span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow notification-count" style="top: 7px; right: 23px;">{{collect(Request()->input('notificationCol'))->count()}}</span>@endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notification</span></h6>
                                {{-- @if(collect(Request()->input('notificationCol'))->isNotEmpty())<span class="notification-tag badge badge-default badge-danger float-right m-0">{{collect(Request()->input('notificationCol'))->count()}} New</span> @endif--}}
                                </li>
                                <li class="scrollable-container media-list w-100 notification-list mt-1">

                                    @if(collect(Request()->input('notificationCol'))->isNotEmpty())
                                        @foreach(Request()->input('notificationCol') as $notification)
                                            <a href="{{$notification['link']}}" class="read-notification">
                                                <div class="media">
                                                    <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="{{storageUrl_h($notification['image'])}}" alt="avatar"></span></div>
                                                    <div class="media-body">
                                                        {{--<h6 class="media-heading">Margaret Govan</h6>--}}
                                                        <p class="notification-text font-small-3 text-muted">{!! $notification['text'] !!}</p><small>
                                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{$notification['created_at']}}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="mt-3 text-center">Empty Notification</p>
                                    @endif
                                </li>
                                <li class="dropdown-menu-footer">
                                    <a class="dropdown-item text-muted text-center" href="javascript:void(0)">Show all notifications</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    {{--notifications--}}

                </ul>
            </div>
        </div>
    </div>
</nav>
