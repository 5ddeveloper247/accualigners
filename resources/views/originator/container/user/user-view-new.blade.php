<style>
    body{
        display:none;
     }
</style>
@php
$title = 'Users';
@endphp
@extends('originator.root.dashboard_side_bar')
@section('title', "User")


@section('content')

@php

        $requiredSections = [
            'Header' => 'originator.components.side-nav',
            'Footer' => 'originator.components.footer'
        ];

        $componentsJsCss = [
            'adminPanel.general',
            'adminPanel.validation',
            'adminPanel.select2',
            'adminPanel.file-input-button',
            'adminPanel.input-mask',
        ];

        $viewRoute = route('admin.user.index');

        $edit_id = false;
        $form_action = route('admin.user.store');

        if(Request()->route('user')){
            $edit_id = Request()->route('user');
            $form_action = route('admin.user.update', $edit_id);
        }
    @endphp
    <div class="mobile-menu-overlay"></div>
    <!-- saadullah -->
    <div class="main-container">
        <div class="m-3">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-5 mb-30 ">
                            <div class="carx2 input">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">
                                <input type="text" name="filter" class="form-control" placeholder="Search..." value="{{Request()->has('filter') ? Request()->get('filter') : ''}}">
                                <div class="searchicons">
                                    <button type="submit" style="background: none;border:none;"><i class="bi bi-search" style="margin-right:12px;"></i></button>|
                                    <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}">
                                        <i class="bi bi-sliders"></i>
                                    </a>
                                </div>

                            </form>
                            </div>
                        </div>
                        <div class="col-xl-4  fourdo">


                        </div>
                        <!-- <mujtaba></mujtaba> -->
                        <div class="col-xl-3 mb-30 threedo bgcolorbordertxt">
                            <a class="btn bgcolor text-white casebtn addcase float-right" style="margin-left:7%;" onclick="editFunction()">New User <i class="bi bi-plus-circle"></i></a>

                            <a class="btn btn bg border border-dark  btn-xl color  border-radius-8 bgcolorborder   float-right  delete" style="font-size:22px; float:right">Delete<i class="bi bi-trash3"></i></a>

                            <a class="ete checkboxbandka cursor cleardo float-right" style="font-size:22px;display: none;">Clear<i class="bi bi-eraser-fill"></i></a>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabdata">
                                <div class=" table-responsive">
                                 <table class="table tablerow" id="example">
                                        <thead>
                                            <th  class=" checkboxbandka " style="display: none;">
                                                <input type="checkbox" id="btnCheckAll" ></th>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Role</th>
                                            <th></th>

                                        </thead>
                                        <tbody class="tablerow">
                                        @php($a = 1)
                                        @foreach($users as $user)
                                            <tr data-aeshaz-select-id="{{$user->id}}">
                                                <td  class=" checkboxbandka" style="display: none;">
                                                <input type="checkbox" id="a{{$a++}}" value="{{$user->id}}"></td>
                                                <td>{{$user->id}}</td>
                                                <td>{{ucwords($user->name)}}</td>
                                                <td>{{ucfirst($user->email)}}</td>
                                                <td>{{isset($user->role) ? ucwords($user->role->name) : 'N/A'}}</td>
                                                <td><a  class="btn_edit" onclick="editFunction({{$user->id}})"><i class="bi bi-pencil-square"></i></a></td>
                                                <!-- <td><img src="{{asset('vendors/images/dots.png')}}"></td> -->
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $users->appends(Request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>
    </div>

</body>

</html>
<div class="pop1  scrolldo" style="display:none">
<form class="form-horizontal" method="post" id="frmuser" action="" enctype="multipart/form-data" novalidate>
{{csrf_field()}}
    <div class="row m-0">
        <div class="col-md-7">
        </div>
        <div class="col-md-5 bg-white popadd pb-5">
            <div class="page6box py-3 p-2">
            </div>
            <div class="row px-4 mb-5 ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11 bold m-auto">
                            <h5 class="textcolor">Add New Users</h5>
                            <p class="greytext">Complete the information related to users</p>
                        </div>
                        <div class="col-md-1">
                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka();"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 px-4 brdall py-4">
                    <div class="row  ">
                           <h5 class="textcolor px-2">User's Detail</h5>
                    </div>
                    <div class="row m-0  py-4 mt-3" style="border:1px dashed #e3e3e3;border-radius: 8px;">
                        <div class="col-md-3 bold ">

                            <img src="{{asset('vendors/images/gallery.png')}}" id="output" style="width:80px;height: 80px;border-radius:50%;">

                        </div>
                        <div class="col-md-6 bold ">
                                  <h6 class="textcolor pt-3" style="font-size: 14px;">Upload Profile Picture</h6>
                            <span style="font-size: 12px;">Select a file to upload</span>

                        </div>
                        <div class="col-md-3 px-4 bold pt-4">
                            <a class="textcolor add_files_btn" style="cursor: pointer;">Browse</a>
                            <input type="file" id="picture" name="picture" class="fileInput" accept="image/*" value="" hidden>

                        </div>

                    </div>

                     <div class="row  pt-4">
                         <div class="col-md-6 bold ">
                            <span>Full Name*</span>
                            <input type="text" name="ElementId" id="ElementId" hidden/>
                            <input type="text" name="name" id="txtname" class="form-control" placeholder="Enter Here">
                         </div>
                     <div class="col-md-6 mb-4 bold ">
                         <span>Role*</span>
                             <select class="form-select form-control" name="role_id" id="txt_roll_id">
                                 <option selected value="first_index">Select </option>
                                     @foreach ($roles as $role)
                                          <option value="{{$role->id}}" {{ isset($edit_values) ? (($edit_values->role_id == $role->id) ?  'selected' : '') : ((old('role_id') == $role->id) ? 'selected' : '') }}>{{ ucwords($role->name) }}</option>
                                     @endforeach
                            </select>
                        </div>
                              <div class="col-md-12 mb-4 bold ">
                            <span>Email*</span>
                            <input type="email" name="email" id="txtemail" class="form-control" placeholder="Enter Here">
                            </div>
                        <div class="col-md-6 bold ">
                            <span>Password*</span>
                            <input type="password" name="password" @if( !$edit_id ) required data-validation-required-message="Password is required" @endif id="txtpass" class="form-control" placeholder="Enter Here">
                        </div>      <div class="col-md-6  bold ">
                            <span>Confirm Password*</span>
                            <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Enter Here">
                        </div>
                    </div>


                </div>
                    </div>
             <div class="row mt-3 ">
                        <div class="col-md-6 col">
                        </div>
                        <div class="col-md-6 col ">
                                 <button type="submit" class="btn bgcolor text-white mx-2 float-right ">Submit</button>
                            <a class="btn bg border border-radius-8 btn btn-xl color  mb-5 bgcolorborder float-right mx-2" style="font-size:22px;" onclick="bndka();">Cancel</a>
                           </div>
                    </div>
        </div>
    </div>
</form>
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
                            <!--                            <i class="fa-solid bandeka cursor fa-xmark " onclick="bndka1();"></i>-->
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
<style>
    table{
        width:100% !important;
     }
</style>
<!-- js -->
<script src="{{asset('vendors/scripts/core.js')}} "></script>
<script src="{{asset('vendors/scripts/script.min.js')}} "></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    var img_asset = "{{asset('vendors/images/')}}";
    var base_url = "{{url('admin/')}}";
    var records = "{{$a}}";

        function bndka() {
            $('.pop1').fadeOut('slow');
        }
        // $('.addcase').click(function() {
        //     $('.pop1').removeClass('d-none');
        // });

        function bndka1() {
            $('.pop2').addClass('d-none');
        }
        // $('.delete').click(function() {

        //     $('.pop2').removeClass('d-none');
        // });

        $(document).ready(function() {
            $("#example").DataTable();
        });


    $('.delete').click(function() {
        $(".checkboxbandka").delay(200).fadeIn();
        $('.checkboxbandka').removeClass('d-none');
        $('.threedo').removeClass('col-xl-3');
        $('.threedo').addClass('col-xl-4');
        $('.fourdo').removeClass('col-xl-4');
        $('.fourdo').addClass('col-xl-3');
        $('.onedo').removeClass('col-xl-5');
        $('.onedo').addClass('col-xl-4');
        var recordId = [];
        var a = 0;
            for(i=1;i<records;i++)
            {
                if($("#a"+i).is(':checked')==true)
                {
                recordId[a] = $("#a"+i).val();
                a++;
                }
            }
        if(recordId.length != 0)
        {
         $(".pop2").removeClass("d-none");
        }
    });
      $('.cleardo').click(function() {

         for(i=1;i<records;i++)
				{
					$("#a"+i).prop('checked', false);
				}
                $('#btnCheckAll').prop('checked',false);
         $('.checkboxbandka').addClass('d-none');
            $('.threedo').removeClass('col-xl-4');
               $('.threedo').addClass('col-xl-3');
        $('.fourdo').removeClass('col-xl-3');
        $('.fourdo').addClass('col-xl-4');
        $('.onedo').removeClass('col-xl-4');
        $('.onedo').addClass('col-xl-5');

    });
</script>
<script src="{{asset('vendors/scripts/user_ajax.js')}}"></script>
