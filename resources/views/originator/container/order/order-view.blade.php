@extends('originator.root.index')

@section('title', "Order")


@section('content')

@php

$requiredSections = [
'Header' => 'originator.components.side-nav',
'Footer' => 'originator.components.footer'
];

$componentsJsCss = [
'adminPanel.general',
'adminPanel.datatable',
'adminPanel.sweetalert',
];
$setting = setting_h();
$default_currency = $setting->currency;
$slug = auth()->user()->role->slug;

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route($slug.'.dashbord')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <section id="column-visibility">
                <div class="row">


                    <div class="col-12 col-md-6 float-right mb-1">
                        <div class="aeshaz-filter">
                            <form action="{{url(Request()->path())}}" id="filter-form" method="get">

                                <div class="row mt-2 mt-md-0">
                                    <div class="col-12 col-md-6">
                                        @if(Request()->has('product')) <input type="hidden" name="product"
                                            value="{{Request()->product}}" /> @endif
                                        <input type="text" id="filter-field" name="filter"
                                            class="form-control form-control-sm" placeholder="Search"
                                            aria-controls="DataTables_Table_7"
                                            value="{{ Request()->has('filter') ? Request()->filter : ''}}">
                                    </div>
                                    <div class="col-12 col-md-6 mt-2 mt-md-0 text-center text-md-left">
                                        <button type="submit" class="btn btn-md btn-primary white ml-1"> Search</button>
                                        <a href="{{Request()->has('filter') ? url(Request()->path()) : 'JavaScript:void(0);'}}"
                                            class="btn btn-md btn-outline-primary primary ml-1"> Clear</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        {{-- <a href="{{url(Request()->path().'/create')}}"
                            class="btn btn-md btn-primary float-right white"><i class="ft-plus"></i>Add New</a> --}}
                    </div>
                    <div class="col-12 btn-group btn-group-md mb-1">
                        <a href="{{url(Request()->path()).'?product=impression-kit'}}"
                            class="btn {{Request()->has('product') && Request()->product=='impression-kit' ? 'btn-primary' : 'btn-secondary'}}">Impression
                            Kit</a>

                        <a href="{{url(Request()->path()).'?product=aligner'}}"
                            class="btn {{Request()->has('product') && Request()->product=='aligner' ? 'btn-primary' : 'btn-secondary'}}">Aligner</a>
                    </div>

                    <div class="col-12 float-right mb-1">

                        {{-- <table class="table table-striped table-bordered responsive ideaecom-datatable-pag "> --}}
                            <table class="table table-bordered border-top text-nowrap responsive" id="modal_dataTabe">
                                <thead>
                                    <tr>
                                        <th>Case ID</th>
                                        <th>Order ID</th>
                                        <th>Dentist Name</th>
                                        <th>Name</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Payment Type</th>
                                        <th>Total</th>
                                        <th>Shipping Charges</th>
                                        <th class="RolePermissionAction">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($orders as $order)
                                    <tr data-aeshaz-select-id="{{$order->id}}">
                                        <td>{{$order->case_id}}</td>
                                        <td class="select-td">#{{$order->id.' '.ucfirst(strtolower($order->product)) }}
                                        </td>
                                        <td>{{$order->doctor_name}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{date('M d,Y', $order->created_date)}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->payment_name}}</td>
                                        <td>{{$order->total_amount . ' '. $default_currency}}</td>
                                        <td>{{$order->shipping_charges}} {{$default_currency}}</td>
                                        
                                         <td class="align-middle">
                                                <div class="btn-group align-top">
                                                    <a href="{{ $order->order_url }}"   target="_blank" class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Courier Link" >Courier Link</a>
                                                    <a href="{{url(Request()->path().'/'.$order->id.'/edit')}}" class="btn btn-sm btn-info RolePermissionUpdate" data-toggle="tooltip" data-original-title="View Details" >View Details</a>
                                                    <a class="btn btn-sm btn-danger delete-confirm-alert RolePermissionDelete" href="javascript:void(0)" data-id="{{$order->id}}"  data-toggle="tooltip" data-original-title="Delete Item" >Delete</a>
                                                </div>
                                            </td>
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{ $orders->appends(Request()->input())->links() }}
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>


@stop