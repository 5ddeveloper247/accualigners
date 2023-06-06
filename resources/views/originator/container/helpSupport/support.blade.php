
<style>

    body{
        display: none;
    }
    @media(max-width:500px){
    .dall img{
        display: none;
    }
    .dall .item a {
    position: absolute;
    bottom: -10px;
    right: 10px;
}
    .dall{

    POSITION: RELATIVE;
    TOP: -95px;
    right: 13px;

    }
}
.sendnoti a{
    transition: all 0.4s ease-in-out;
}
.sendnoti a:hover {
    background: #00205C;
    color: white !important;
    cursor: pointer;
}
#cincern_msg{
  height: 450px;
  overflow-y: scroll;
  overflow-x: hidden;
}
#admin_msg{
    background-color: #00205C !important;
    color: white !important;
    border-radius: 8px 0px 8px 8px;
}
#doctor_msg{
    background-color: #f5f6f8 !important;
    color: #00205C !important;
    border-radius: 8px 0px 8px 8px;
}
#btnSend{
    bottom: -29px;
    right: 2px;
    display: inline-block;
    position: absolute;
}
.goback{
    background: #00205c;
    border: 2px solid #00205c;
    font-size: 12px;
    width: 80px;
    height: 30px;
    border-radius: 10px;
    font-weight: bold;
    color: white;
    line-height: 25px;
    text-align: center;
}
</style>

@php
$title = 'Support';
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($currentUrl, PHP_URL_PATH);
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Support")

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <div class="mobile-menu-overlay"></div>
    <!-- saadullah -->
    <div class="main-container">
        <div class="m-3">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="row ">

                        <div class="col-xl-4 borderright">
                            <div class="row">
                                <div class="col-md-12 borderbottom">
                                    <img src="{{asset('vendors/images/logo.png')}}" width="30">
                                    <span>Help & Support Service</span>
                                    <div class="sendnoti">
                                        <a class="d-block text-center py-3 cursor mt-3" onclick="sendNotification()">Send Notification</a>
                                        <form action="search_case" method="POST">
                                        @csrf
                                            <input type="text" class="form-control my-3 " name="case_id" id="txtsearch" placeholder="Search by Case ID e.g 141">
                                            <button type="submit" style="border: none;"><i class="bi bi-search" style="margin-right:12px;margin-bottom:5px;"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @foreach($case as $case_item)
                            @isset($case_item->lastConcern->message)
                            <div class="row m-1 mb-2" style="cursor:pointer" onclick="showMessage('{{$case_item->id}}')">
                                <div class="col-md-12  py-2 bground">
                                    <div class="row">
                                        <div class="col-md-2 p-0 ">

                                            <img src="{{$case_item->doctor->picture ?? asset('storage/images/no-image.png')}}" width="70" class="mx-2">
                                        </div>
                                        <div class="col-md-7">
                                            <h5 style="font-size: 12px;" class="mt-2 name"> {{$case_item->doctor->name ?? 'Deleted Doctor'}} <br> Case_ID:{{$case_item->id}}</h5>
                                            <span style="font-size: 11px;"> {{$case_item->lastConcern->message}} </span>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                          <p style="font-size: 11px;">
                                          @php
                                            $ip = request()->ip();
                                            $api_key = "4eb0722e7f464951aef4c772283952fb"; // replace with your actual API key
                                            $api_url = "https://api.ipgeolocation.io/timezone?apiKey={$api_key}&ip={$ip}";
                                            $api_response = json_decode(file_get_contents($api_url), true);
                                            $user_timezone = new DateTimeZone($api_response['timezone']);

                                            $created_at = new DateTime($case_item->lastConcern->created_at, new DateTimeZone('UTC'));
                                            $created_at->setTimezone($user_timezone);
                                @endphp

                                {{ $created_at->format('H:i A') }}
                                          </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset
                            @endforeach
                           @if($path != '/admin/support')
                            <a href="/admin/support" type="button" class="goback"> <- Go Back</a>
                          @endif

                        </div>
                        <div class="col-xl-8 ">
                            <div class="row">
                                <div class="col-md-12 borderbottom pb-3">
                                    <img src="{{asset('vendors/images/logo.png')}}" width="30">
                                    <span style="font-weight: bold;font-size:20px;">Help & Support Service</span>

                                </div>
                            </div>
                            <div id="cincern_msg">

                            </div>
                            <div class="row mt-3  mainclass m-2" style="top:0 !important; margin-bottom: 12px !important;">

                                <div class="col-md-12 dall  ">
                                    <input type="" class="form-control" placeholder="Type Something..." id="admin_response" readonly>
                                    <div class="item" style="right:0 !important;">

                                        <!-- <img src="images/i1.png">
                                        <img src="images/i2.png">
                                        <img src="images/i3.png">
                                        <img src="images/Emoji-smile.png"> -->
                                        <button type="button" data-id="" id="btnSend" class="bgcolor text-white py-2 px-4 mt-5" onclick="sendMessage(this)" disabled>Send</button>
                                </div>


                                </div>
                           </div>
                        </div>



                    <!-- js -->
                    <script src="{{asset('vendors/scripts/core.js')}} "></script>
                    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
                    <script>
                        function bndka() {
                            $('.pop1').addClass('d-none');
                        }
                        $('.addcase').click(function() {
                            $('.pop1').removeClass('d-none');
                        });

                        function bndka1() {
                            $('.pop2').addClass('d-none');
                        }
                        $('.delete').click(function() {

                            $('.pop2').removeClass('d-none');
                        });

                        $(document).ready(function() {
                            $("#example").DataTable();
                        });

                    </script>

</body>

</html>
<div class="pop1 d-none scrolldo">
    <div class="row m-0">
        <div class="col-md-7">
        </div>
        <div class="col-md-5 bg-white popadd" style="height: 650px;">
            <div class="page6box py-3 p-2">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11 bold m-auto">
                            <h5 class="textcolor">Add New Slider</h5>
                            <p class="greytext">Complete the information related to the slider</p>
                        </div>
                        <div class="col-md-1">
                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka();"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                        <h5 class="textcolor px-2">Slider's Detail</h5>
                    </div>
                    <div class="row m-0  py-4 mt-3" style="border:1px dashed #e3e3e3;border-radius: 8px;">
                        <div class="col-md-3 bold ">

                            <img src="images/gallery.png" style="width:80px;height: 80px;">

                        </div>
                        <div class="col-md-6 bold ">
                            <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile Picture</h6>
                            <span style="font-size: 12px;">Select a file or drag and drop here</span>

                        </div>
                        <div class="col-md-3 px-4 bold pt-4">
                            <a href="" class="textcolor">Browse</a>

                        </div>

                    </div>

                    <div class="row  pt-4">
                        <div class="col-md-12 bold ">
                            <span>Sort order*</span>
                            <input type="" name="" class="form-control" placeholder="Enter Here">
                        </div>

                    </div>


                </div>
            </div>
            <div class="row mt-3 ">
                <div class="col-md-6 col">
                </div>
                <div class="col-md-6 col ">
                    <a class="btn bgcolor text-white casebtn float-right ">Submit</a>
                    <a class="btn bgcolorborder float-right mx-3" style="font-size:22px;" onclick="bndka();">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pop2 d-none">
    <div class="row ">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 bg-white popadd deleteform">
            <div class="page6box py-3 ">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row borderbottom">
                        <div class="col-md-11 p-0 aresure  bold m-auto">
                            <h5 class="t text-dark ">
                                Are you sure you wanted to delete the case!
                            </h5>
                            <p class="mt-3">Once you delete this the data will be permanently removed</p>
                        </div>
                        <div class="col-md-1">
                            <!--<i class="fa-solid bandeka cursor fa-xmark " onclick="bndka1();"></i>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 delebtn">
                    <a class="btn  text-white casebtn float-right deletebtn">Delete</a>
                    <a class="btn cancelbtn  text-white  float-right" onclick="bndka1();">Cancel</a>

                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var base_url="{{ url('admin') }}";
    var date = new Date('2022-03-28T15:00:00Z');
    var div_concern = $('#cincern_msg');
</script>
<script src="{{asset('vendors/scripts/support_ajax.js')}} "></script>
