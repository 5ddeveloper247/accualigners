


{{--Modal--}}
<div class="modal fade text-left add-geography" tabindex="-1" role="dialog" aria-labelledby="sku-data"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="geography-data"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--<form class="form-horizontal" id="sku-update-form" novalidate>--}}
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_for" id="id_for">

                    <div class="form-group col-12">
                        <label>Name: <span class="required">*</span> </label>
                        <div class="controls">
                            <input type="text" name="id_for_name" id="id_for_name" class="form-control"
                                   required data-validation-required-message="Name is required">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id="add-geography-save">Save</button>
            </div>
            {{--</form>--}}
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){

        $("body").on("click", "#add-geography-save", function () {

            var id = $('#id').val();
            var id_for = $('#id_for').val();
            var name = $('#id_for_name').val();

            var data = {
                _token: '{{csrf_token()}}',
                id: id,
                id_for: id_for,
                name: name,
                user_id: '{{session_h("user_id")}}',
            };

            $.ajax({
                url: '{{url("addGeography")}}',
                type:"POST",
                dataType : 'json',
                data: data,
                success:function(responseCollection){
                    toastr.success('Added successfully', "Success!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});

                    var id = responseCollection['data']['id'];

                    var options = $('#'+id_for+'_id').prop('options');
                    options[options.length] = new Option(name, id, true, true);

                    $('.add-geography').modal('hide');
                    $.unblockUI();
                },error:function(e){
                    var responseCollection = e.responseJSON;
                    toastr.error(responseCollection['errorMessage'], "Error!", {positionClass: "toast-bottom-left", containerId: "toast-bottom-left"});
                    $.unblockUI();
                }
            });
        });

        $("body").on("click", ".add-geography-btn", function () {

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

            var add_for = $(this).data('add-for');
            var title = $(this).data('title');
            $('#geography-data').html(title);

            var id = '';
            var error = '';

            if(add_for == 'country'){
                id = 1;
            }else if(add_for == 'division'){
                var country_id = $('#country_id').val();
                if(country_id != ''){
                    id = country_id;
                }else{
                    var error = 'Select country first';
                }
            }else if(add_for == 'city'){
                var division_id = $('#division_id').val();
                if(division_id != ''){
                    id = division_id;
                }else{
                    var error = 'Select division first';
                }
            }else if(add_for == 'postcode'){
                var city_id = $('#city_id').val();
                if(city_id != ''){
                    id = city_id;
                }else{
                    var error = 'Select city first';
                }
            }else if(add_for == 'area'){
                var postcode_id = $('#postcode_id').val();
                if(postcode_id != ''){
                    id = postcode_id;
                }else{
                    var error = 'Select postcode first';
                }
            }

            if (id != ''){
                $('#id_for_name').val('');
                $('.add-geography').modal('show');
                $('#id').val(id);
                $('#id_for').val(add_for);
            }else{
                toastr.error(error,"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
            }


            body.unblock();
        });

        @if(!isset($show_division) || (isset($show_division) && $show_division === true))
            $('#country_id').on('change',function () {
            var country_id = $(this).val();

            var CitySelect = $('#city_id');
            $('option', CitySelect).remove();
            CitySelect.append('<option></option>');

            var PostCodeSelect = $('#postcode_id');
            $('option', PostCodeSelect).remove();
            PostCodeSelect.append('<option></option>');

            var AreaSelect = $('#area_id');
            $('option', AreaSelect).remove();
            AreaSelect.append('<option></option>');

            var data = {
                _token: '{{csrf_token()}}',
                country_id: country_id
            }

            var DivisionSelect = $('#division_id');
            if(DivisionSelect.prop) {
                var options = DivisionSelect.prop('options');
            }
            else {
                var options = DivisionSelect.attr('options');
            }
            $('option', DivisionSelect).remove();
            DivisionSelect.append('<option></option>');

            if(country_id != ''){
                DivisionSelect.prop("disabled", "disabled");
                $.ajax({
                    url:'{{url('division/getAllDivisionsByCountry')}}',
                    type: "POST",
                    dataType: 'json',
                    data:data,
                    success:function(responseCollection){
                        if(responseCollection['data'].length > 0){
                            $.each(responseCollection['data'], function (key, value) {
                                options[options.length] = new Option(value['name'], value['id']);
                            });
                        }
                        DivisionSelect.removeAttr("disabled");
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
        @endif

        @if(!isset($show_city) || (isset($show_city) && $show_city === true))
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
        @endif

        @if(!isset($show_postcode) || (isset($show_postcode) && $show_postcode === true))
            $('#city_id').on('change',function () {
            var city_id = $(this).val();

            var AreaSelect = $('#area_id');
            $('option', AreaSelect).remove();
            AreaSelect.append('<option></option>');

            var data = {
                _token: '{{csrf_token()}}',
                city_id: city_id
            }

            var PostCodeSelect = $('#postcode_id');
            if(PostCodeSelect.prop) {
                var options = PostCodeSelect.prop('options');
            }
            else {
                var options = PostCodeSelect.attr('options');
            }

            $('option', PostCodeSelect).remove();
            PostCodeSelect.append('<option></option>');

            if(city_id != '' ){
                PostCodeSelect.prop("disabled", "disabled");
                $.ajax({
                    url:'{{url('postcode/getAllPostcodesByCity')}}',
                    type: "POST",
                    dataType: 'json',
                    data:data,
                    success:function(responseCollection){
                        if(responseCollection['data'].length > 0){
                            $.each(responseCollection['data'], function (key, value) {
                                var val = (value['locality'] == '' || value['locality'] == null) ? value['postcode'] : value['postcode']+' ('+value['locality']+')';
                                options[options.length] = new Option(val, value['id']);
                            });
                        }
                        PostCodeSelect.removeAttr("disabled");
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
        @endif

        @if(!isset($show_area) || (isset($show_area) && $show_area === true))
            $('#postcode_id').on('change',function () {
            var postcode_id = $(this).val();

            var data = {
                _token: '{{csrf_token()}}',
                postcode_id: postcode_id
            }

            var AreaSelect = $('#area_id');
            if(AreaSelect.prop) {
                var options = AreaSelect.prop('options');
            }
            else {
                var options = AreaSelect.attr('options');
            }

            $('option', AreaSelect).remove();
            AreaSelect.append('<option></option>');

            if(postcode_id != ''){
                AreaSelect.prop("disabled", "disabled");
                $.ajax({
                    url:'{{url('area/getAllAreasByPostcode')}}',
                    type: "POST",
                    dataType: 'json',
                    data:data,
                    success:function(responseCollection){
                        if(responseCollection['data'].length > 0){
                            $.each(responseCollection['data'], function (key, value) {
                                options[options.length] = new Option(value['name'], value['id']);
                            });
                        }
                        AreaSelect.removeAttr("disabled");
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
        @endif

    });

</script>
