@php
$currentUrl = url()->current().'/';
$baseUrl = dirname($currentUrl);
@endphp
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>AccuAligners </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    body{
        background-image: url({{$baseUrl}}/vendors/images/leftmouth.jpeg);
    background-size: cover;
    /* height: calc(100vh - 70px); */
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .mainbackground {
        height: 655px;
    }

    .maincard {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid #FFFFFF;
        box-shadow: 0px 15px 80px rgba(0, 32, 92, 0.1);
        backdrop-filter: blur(30px);
        border-radius: 24px;
    }

</style>
@php
    $requiredSections = [

    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.login-register',
        'adminPanel.validation',
        'adminPanel.switchery-checkbox',
    ];

    $emailError = null;
    if ($errors->has('email')) {
        $emailError = $errors->first('email');
    }

    $passwordError = null;
    if ($errors->has('password')) {
        $passwordError = $errors->first('password');
    }

    $bodyClasses = "vertical-layout vertical-menu 1-column menu-expanded blank-page blank-page pace-done";
    $dataCol = '1-column';

@endphp
<body>
    <div class="mainbackground">
    <form class="form-horizontal form-simple" method="post" action="{{ url('login') }}">
    {{csrf_field()}}
        <div class="row m-0">
            <div class="col-md-7">
            </div>
            <div class="col-md-4 mt-5 pt-5 ">
                <div class=" control mt-">
                    <div class="row maincard py-4 bg-suss">
                         <div class="col-md-2">
                         </div>
                         <div class="col-md-10 paragra">
                            <img src="{{asset('vendors/images/loginlogo.png')}}" width="40">
                             
                             <span style="font-size: 30px;">
                                AccuAligners
                             </span>
                             <p>Clear <span style="font-weight: bold;">Solutions!</span></p>
                         </div>

                         <div class="col-md-12 text-center welcome">
                            <h4 class="mt-4">Welcome Back</h4>
                            <p> Please Enter your Login Details</p>
                            <!-- <span style="font-size: 13px;margin-left: 5%;color: red;" id="">hello</span> -->
                         </div>
                         @if ($errors->any())
                         <div class="col-md-12 hide_error" style="text-align:center;">
                         @foreach ($errors->all() as $error)
                         <div class="alert alert-danger hide_error">{{ $error }}</div>
                         @endforeach
                         </div>
                         @endif
                         <div class="col-md-11 m-auto welcome">
                            Email 
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                         </div>
                         <div class="col-md-11 pt-3 m-auto textlogin">
                            Password 
                            <input type="password" name="password" class="form-control" placeholder="*********" required>
                            <a href="{{ url('password/reset') }}" class="float-right mt-1" style="text-decoration:none;color: rgb(0, 32, 92);font-weight: 500;">Forget Password?</a>
                         </div>
                         <div class="col-md-11 pt-3 m-auto textlogin">
                            <button class="bgcolor d-block text-white text-center py-2" style="font-size: 20px;font-weight: 500;background: rgb(0, 32, 92);width: 100%;border: none;letter-spacing: 1px;border-radius: 5px;">Login</button>
                         </form>
                         </div>
                         <div class="col-md-11 pt-3 m-auto  text-center">
                            <a class="  " style="font-size: 14px;font-weight:300;">New to <span style="font-weight: bold;font-size:14px;color: #6a6a6a;">AccuAligners</span> </a> <a href="{{route('signup')}}" class="  px-2" style="text-decoration: underline; font-size: 14px;font-weight:bold;color:#00205C;"> Create a new account </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script>  
             var div = document.querySelector('.hide_error');

             div.style.transition = "opacity 1s";
        setTimeout(function() {
             div.style.opacity = "0";
}, 5000); //
setTimeout(function() {
    div.style.display = 'none';
},5500);

</script>

</html>
