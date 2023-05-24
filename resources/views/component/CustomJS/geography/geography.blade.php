@php

if(isset($required_country) && $required_country === false){
    $required_country = false;
}else{
    $required_country = true;
}
if(isset($required_division) && $required_division === false){
    $required_division = false;
}else{
    $required_division = true;
}
if(isset($required_city) && $required_city === false){
    $required_city = false;
}else{
    $required_city = true;
}
if(isset($required_postcode) && $required_postcode === false){
    $required_postcode = false;
}else{
    $required_postcode = true;
}
if(isset($required_area) && $required_area === false){
    $required_area = false;
}else{
    $required_area = true;
}
if(isset($required_address) && $required_address === false){
    $required_address = false;
}else{
    $required_address = true;
}

@endphp


@if(!isset($show_country) || (isset($show_country) && $show_country === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('country_id')) echo 'error'; ?>">
    <label>Country
        @if($required_country)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Country" id="country_id"
                @if(isset($multiple_countries) && $multiple_countries === true && isset($show_division) && $show_division === false)
                    name="country_id[]" multiple
                @else
                    name="country_id"
                @endif
                @if($required_country)
                    required data-validation-required-message="Please select any one"
                @endif
        >
            <option></option>
            @isset($countries)
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}"
                            @if(old('country_id') && !empty(old('country_id')) && old('country_id') == $country['id'] ) selected @endif >
                        {{ $country['name'] }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-geography-btn" type="button"
                    data-title="Add Country" data-add-for="country">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('country_id'))
            <div class="help-block text-danger country_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('country_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
@endif

@if(!isset($show_division) || (isset($show_division) && $show_division === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('division_id')) echo 'error'; ?>">
    <label>Division
        @if($required_division)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Division" id="division_id"
                @if(isset($multiple_divisions) && $multiple_divisions === true && isset($show_city) && $show_city === false)
                    name="division_id[]" multiple
                @else
                    name="division_id"
                @endif
                @if($required_division)
                    required data-validation-required-message="Please select any one"
                @endif
        >
            <option></option>
            @isset($divisions)
                @foreach($divisions as $division)
                    <option value="{{ $division['id'] }}"
                            @if(old('division_id') && !empty(old('division_id')) && old('division_id') == $division['id'] ) selected @endif >
                        {{ $division['name'] }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-geography-btn" type="button"
                    data-title="Add Division" data-add-for="division">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('division_id'))
            <div class="help-block text-danger division_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('division_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
@endif

@if(!isset($show_city) || (isset($show_city) && $show_city === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('city_id')) echo 'error'; ?>">
    <label>City
        @if($required_city)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select City" id="city_id"
                @if(isset($multiple_cities) && $multiple_cities === true && isset($show_postcode) && $show_postcode === false)
                    name="city_id[]" multiple
                @else
                    name="city_id"
                @endif
                @if($required_city)
                    required data-validation-required-message="Please select any one"
                @endif
        >
            <option></option>
            @isset($cities)
                @foreach($cities as $city)
                    <option value="{{ $city['id'] }}"
                            @if(old('city_id') && !empty(old('city_id')) && old('city_id') == $city['id'] ) selected @endif >
                        {{ $city['name'] }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-geography-btn" type="button"
                    data-title="Add City" data-add-for="city">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('city_id'))
            <div class="help-block text-danger city_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('city_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
@endif

@if(!isset($show_postcode) || (isset($show_postcode) && $show_postcode === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('postcode_id')) echo 'error'; ?>">
    <label>Postcode
        @if($required_postcode)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Postcode" id="postcode_id"
                @if(isset($multiple_postcodes) && $multiple_postcodes === true && isset($show_area) && $show_area === false)
                    name="postcode_id[]" multiple
                @else
                    name="postcode_id"
                @endif
                @if($required_postcode)
                    required data-validation-required-message="Please select any one"
                @endif
        >
            <option></option>
            @isset($postcodes)
                @foreach($postcodes as $postcode)
                    <option value="{{ $postcode['id'] }}"
                            @if(old('postcode_id') && !empty(old('postcode_id')) && old('postcode_id') == $postcode['id'] ) selected @endif >
                        {{ empty($postcode['locality']) ? $postcode['postcode'] : $postcode['postcode'].' ('.$postcode['locality'].')' }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-geography-btn" type="button"
                    data-title="Add Postcode" data-add-for="postcode">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('postcode_id'))
            <div class="help-block text-danger postcode_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('postcode_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
@endif

@if(!isset($show_area) || (isset($show_area) && $show_area === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('area_id')) echo 'error'; ?>">
    <label>Area
        @if($required_area)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Area" id="area_id"
                @if(isset($multiple_areas) && $multiple_areas === true/* && isset($show_address) && $show_address === false*/)
                    name="city_id[]" multiple
                @else
                    name="city_id"
                @endif
                @if($required_area)
                    required data-validation-required-message="Please select any one"
                @endif
        >
            <option></option>
            @isset($areas)
                @foreach($areas as $area)
                    <option value="{{ $area['id'] }}"
                            @if(old('area_id') && !empty(old('area_id')) && old('area_id') == $area['id'] ) selected @endif >
                        {{ $area['name'] }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-geography-btn" type="button"
                    data-title="Add Area" data-add-for="area">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('area_id'))
            <div class="help-block text-danger area_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('area_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
@endif

@if(!isset($show_address) || (isset($show_address) && $show_address === true))
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('address')) echo 'error'; ?>">
    <label>Address
        @if($required_address)
            <span class="required">*</span>
        @endif
    </label>
    <div class="controls">
        <input type="text" name="address" class="form-control "
               @if($required_address)
                required data-validation-required-message="Address is required"
               @endif
               value="{{ old('address') }}">
        @if($errors->has('address'))
            <div class="help-block text-danger address-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('address')}}</li>
                </ul>
            </div> @endif
    </div>

</div>
@endif
