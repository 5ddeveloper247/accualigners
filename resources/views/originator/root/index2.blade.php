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
       <!-- Basic Page Info -->
       <meta charset="utf-8">
    <title>@yield('title') | {{trans('siteConfig.setting.name')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('/vendors/styles/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendors/styles/icon-font.min.css')}}">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="{{asset('/vendors/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://phplaravel-895396-3106860.cloudwaysapps.com/link/files/app-assets/vendors/css/extensions/toastr.css"/>
 
    <style>
    .mainbackground {
        background-image: url("{{asset('/vendors/images/mouth.jpeg')}}");
        background-size: cover;
        min-height: 860px;
    }

    .maincard {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid #FFFFFF;
        box-shadow: 0px 15px 80px rgba(0, 32, 92, 0.1);
        backdrop-filter: blur(30px);
        border-radius: 24px;
    }
 ::placeholder{
    font-size: 12px;
    color: #4B5563;
}

</style>

</head>

<body>


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