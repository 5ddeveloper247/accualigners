<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{trans('siteConfig.setting.name')}}">
    <meta name="keywords" content="admin, {{trans('siteConfig.setting.name')}}">
    <meta name="author" content="Aeshaz.com">
    <title>@yield('title') | {{trans('siteConfig.setting.name')}}</title>
    <link rel="apple-touch-icon" href="{{asset(trans('siteConfig.setting.favIcon'))}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(trans('siteConfig.setting.favIcon'))}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    {{--CSS Files--}}
    @include('component.css')

    {{--
    <link rel="stylesheet" type="text/css" href="{{asset(trans('siteConfig.path.adminPanel').'/css/originator.css')}}">
    --}}
    {{--CSS Files End--}}
    
   <style>
        #column-visibility nav {
            margin-top: 20px;
        }
        a.logout-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
    </style>

</head>

<body
    class="{{ isset($bodyClasses) && !empty($bodyClasses) ? $bodyClasses : 'vertical-layout vertical-menu 2-columns fixed-navbar menu-expanded pace-done'}}"
    data-open="click" data-menu="vertical-menu"
    data-col="{{ isset($dataCol) && !empty($dataCol) ? $dataCol : '2-columns' }}">
    <style>
                @media(max-width:768px){
            .header-navbar{
                width:100% !important;
            }
            .nav.navbar-nav{
                padding:0 !important;
            }
            .header-navbar .navbar-header{
                height:6rem;
            }
            .main-menu.menu-fixed {
    top: 6rem;
    height: calc(100% - 12rem);
}
        }
    </style>

    {{--Header--}}
    @if(isset($requiredSections['Header'])) @include($requiredSections['Header']) @endif
    {{--Header End--}}

    {{--Nav--}}
    @if(isset($requiredSections['Nav'])) @include($requiredSections['Nav']) @endif
    {{--Nav End--}}

    {{--Content--}}
    @yield('content')
    {{--Content End--}}

    {{--Footer--}}
    {{-- @if(isset($requiredSections['Footer'])) @include($requiredSections['Footer']) @endif --}}
    {{--Footer End--}}

    {{--JS Files--}}
    @include('component.js')
    {{--JS Files End--}}

    {{--extra individual JS start--}}
    @yield('extra-script')
    {{--extra individual JS end--}}
    <script>
        //Details display datatable
    $('#modal_dataTabe').addClass('table-responsive');
    $('#modal_dataTabe').removeClass('responsive');
    $('#modal_dataTabe').DataTable({
        info: false,
        searching: false,
        paging: false,
    });
    
    // $('#modal_dataTabe').DataTable({
    //     // scrollX: true,
    //     responsive: {
    //         details: false
    //     },
    //     paging: false,
    //     info: false,
    // });
    

// 	$('#modal_dataTabe').DataTable( {
// 		responsive: true,
//         searching: false,
//         paging: false,
//         info: false,
//         order: [[0, 'desc']],
// 		responsive: {
// 			details: {
// 				display: $.fn.dataTable.Responsive.display.modal( {
// 					header: function ( row ) {
// 						var data = row.data();
// 						return 'Details'
// 					}
// 				} ),
// 				renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
// 					tableClass: 'table border mb-0'
// 				} )
// 			}
// 		}
// 	} );
    </script>

</body>

</html>