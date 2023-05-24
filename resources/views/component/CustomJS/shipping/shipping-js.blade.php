
{{--Modal Shipping Company--}}
<div class="modal fade text-left show" id="add-shipping-company" tabindex="-1" role="dialog" aria-labelledby="shipping-company"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="geography-data">Add Shipping Company</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="shipping-company-form" novalidate>
                <div class="modal-body">
                    <div class="row">

                        {{csrf_field()}}

                        <input type="hidden" name="brand_information_id" id="brand_information_id" value="{{isset($brand_information_id) ? $brand_information_id : null}}">

                        <div class="form-group col-12">
                            <label>Name: <span class="required">*</span> </label>
                            <div class="controls">
                                <input type="text" name="name" id="name" class="form-control"
                                    required data-validation-required-message="Name is required">
                            </div>
                        </div>


                        <div class="col-12 ">

                            <h4 class="form-section">Logo</h4>

                            <div class="row">
                                <label class="ml-auto mr-auto p-1 img-lable">
                                    <img src="{{storageUrl_h(old('logo'))}}" data-default="{{storageUrl_h(old('logo'))}}" class="rounded-circle height-150 width-150 ml-auto mr-auto mt-1 fileInputShow" alt="Card image">
                                    @if($errors->has('logo'))
                                        <div class="help-block text-danger logo-shopwoo-error">
                                            <ul role="alert">
                                                <li>{{$errors->first('logo')}}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <input type="file" id="logo" name="logo" class="fileInput" required accept="image/*">
                                </label>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary" id="add-shipping-company-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Modal Shipping Company Service--}}
<div class="modal fade text-left show" id="add-shipping-company-service" tabindex="-1" role="dialog" aria-labelledby="shipping-company-service"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="geography-data">Add Shipping Company Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="shipping-company-service-form" novalidate>
                <div class="modal-body">
                    <div class="row">

                        {{csrf_field()}}

                        <input type="hidden" name="brand_information_id" id="brand_information_id" value="{{isset($brand_information_id) ? $brand_information_id : null}}">
                        <input type="hidden" name="shipping_company_id" id="service_shipping_company_id" value="">

                        <div class="form-group col-12">
                            <label>Name: <span class="required">*</span> </label>
                            <div class="controls">
                                <input type="text" name="name" id="service_name" class="form-control"
                                    required data-validation-required-message="Name is required">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>Description:</label>
                            <div class="controls">
                                <input type="text" name="service_description" id="service_description" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>Service By: <span class="required">*</span> </label>
                            <div class="controls">
                            <select class="form-control"
                                    data-placeholder="Select Service By" id="service_by" name="service_by"
                                    required
                                    data-validation-required-message="Please select any one">
                                <option value="AIR">AIR</option>
                                <option value="ROAD">ROAD</option>
                                <option value="SEA">SEA</option>
                                
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group col-12">
                            <label>Service Type: <span class="required">*</span> </label>
                            <div class="controls">
                            <select class="form-control"
                                    data-placeholder="Select Service Type" id="service_type" name="service_type"
                                    required
                                    data-validation-required-message="Please select any one">
                                <option value="DOMESTIC">DOMESTIC</option>
                                <option value="INTERNATIONAL">INTERNATIONAL</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>Same Day Delivery: <span class="required">*</span> </label>
                            <div class="controls">
                            <select class="form-control"
                                    data-placeholder="Select Same Day Delivery" id="same_day_delivery" name="same_day_delivery"
                                    required
                                    data-validation-required-message="Please select any one">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary" id="add-shipping-company-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#shipping-company-form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type:'POST',
                url: `{{url("addShippingCompany")}}`,
                data: formData,
                contentType: false,
                processData: false,
                success:function(responseCollection){
                    toastr.success('Added successfully', "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});

                    var id = responseCollection['data']['id'];
                    var name = responseCollection['data']['name'];

                    var options = $('#shipping_company_id').prop('options');
                    options[options.length] = new Option(name, id, true, true);


                    var ShippingCompanyServiceSelect = $('#shipping_company_service_id');
                    $('option', ShippingCompanyServiceSelect).remove();
                    ShippingCompanyServiceSelect.append('<option></option>');

                    $('#add-shipping-company').modal('hide');
                    $.unblockUI();
                },error:function(e){
                    $.unblockUI();
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['errorMessage'], "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                }
            });
        });

        $("body").on("click", ".add-shipping-company-btn", function () {

            var body = $("body");
            body.block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div> Please Wait',
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });

            $('#name').val('');
            $('#logo').val('');
            $('.fileInputShow').attr('src', "{{storageUrl_h(old('logo'))}}");
            $('#add-shipping-company').modal('show');
            

            body.unblock();
        });

        $('#shipping-company-service-form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type:'POST',
                url: `{{url("addShippingCompany/service")}}`,
                data: formData,
                contentType: false,
                processData: false,
                success:function(responseCollection){
                    toastr.success('Added successfully', "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});

                    var id = responseCollection['data']['id'];
                    var name = responseCollection['data']['name'];

                    var options = $('#shipping_company_service_id').prop('options');
                    options[options.length] = new Option(name, id, true, true);

                    $('#add-shipping-company-service').modal('hide');
                    $.unblockUI();
                },error:function(e){
                    $.unblockUI();
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['errorMessage'], "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                }
            });
        });

        $("body").on("click", ".add-shipping-company-service-btn", function () {

            var body = $("body");
            body.block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div> Please Wait',
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });

            var shipping_company_id = $('#shipping_company_id').val();

            if(shipping_company_id != ''){
                $('#service_name').val('');
                $('#service_description').val('');
                $('#service_shipping_company_id').val(shipping_company_id);
                $('#add-shipping-company-service').modal('show');
            }else{
                toastr.error('Please select shipping company first', "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
            }

            body.unblock();
        });





        $('#shipping_company_id').on('change',function () {
            var shipping_company_id = $(this).val();

            var data = {
                _token: '{{csrf_token()}}',
                shipping_company_id: shipping_company_id
            }

            var ShippingCompanyServiceSelect = $('#shipping_company_service_id');
            if(ShippingCompanyServiceSelect.prop) {
                var options = ShippingCompanyServiceSelect.prop('options');
            }
            else {
                var options = ShippingCompanyServiceSelect.attr('options');
            }
            $('option', ShippingCompanyServiceSelect).remove();
            ShippingCompanyServiceSelect.append('<option></option>');

            if(shipping_company_id != ''){
                ShippingCompanyServiceSelect.prop("disabled", "disabled");
                $.ajax({
                    url:"{{url('getShippingCompany/service')}}",
                    type: "POST",
                    dataType: 'json',
                    data:data,
                    success:function(responseCollection){
                        if(responseCollection['data'].length > 0){
                            $.each(responseCollection['data'], function (key, value) {
                                options[options.length] = new Option(value['name'], value['id']);
                            });
                        }
                        ShippingCompanyServiceSelect.removeAttr("disabled");
                    },
                    error:function (e) {
                        var responseCollection = e.responseJSON;
                        if(responseCollection['error']){
                            toastr.error(responseCollection['errorMessage'],"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                        }
                    }
                });

            }

        });

        $('#division_id').on('change',function () {
            var division_id = $(this).val();

            var PostCodeSelect = $('#postcode_id');
            $('option', PostCodeSelect).remove();
            PostCodeSelect.append('<option></option>');

            var AreaSelect = $('#area_id');
            $('option', AreaSelect).remove();
            AreaSelect.append('<option></option>');

            var data = {
                _token: '{{csrf_token()}}',
                division_id: division_id
            }

            var citySelect = $('#city_id');
            if(citySelect.prop) {
                var options = citySelect.prop('options');
            }
            else {
                var options = citySelect.attr('options');
            }
            $('option', citySelect).remove();
            citySelect.append('<option></option>');

            if(division_id != ''){
                citySelect.prop("disabled", "disabled");
                $.ajax({
                    url:'{{url('city/getAllCitiesByDivision')}}',
                    type: "POST",
                    dataType: 'json',
                    data:data,
                    success:function(responseCollection){
                        if(responseCollection['data'].length > 0){
                            $.each(responseCollection['data'], function (key, value) {
                                options[options.length] = new Option(value['name'], value['id']);
                            });
                        }
                        citySelect.removeAttr("disabled");
                    },
                    error:function (e) {
                        var responseCollection = e.responseJSON;
                        if(responseCollection['error']){
                            toastr.error(responseCollection['errorMessage'],"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                        }
                    }
                });

            }

        });

    });

</script>
