
<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('shipping_company_id')) echo 'error'; ?>">
    <label>Shipping Company <span class="required">*</span></label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Shipping Company" id="shipping_company_id" name="shipping_company_id"
                required
                data-validation-required-message="Please select any one">
            <option></option>
            @isset($shipping_companies)
                @foreach($shipping_companies as $shipping_company)
                    <option value="{{ $shipping_company['id'] }}"
                            @if(old('shipping_company_id') && !empty(old('shipping_company_id')) && old('shipping_company_id') == $shipping_company['id'] ) selected @endif >
                        {{ $shipping_company['name'] }}
                    </option>
                @endforeach
            @endisset
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-shipping-company-btn" type="button"
                    data-title="Add Shipping Company">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('shipping_company_id'))
            <div class="help-block text-danger shipping_company_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('shipping_company_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>

<div class="form-group @if(isset($colSize) && !empty($colSize)) {{$colSize}} @else col-xl-4 col-lg-4 col-md-4 col-sm-12 @endif <?php if ($errors->has('shipping_company_id')) echo 'error'; ?>">
    <label>Shipping Company Service <span class="required">*</span></label>
    <div class="controls input-group">
        <select class="select2 form-control"
                data-placeholder="Select Shipping Company Service" id="shipping_company_service_id" name="shipping_company_service_id"
                required
                data-validation-required-message="Please select any one">
            <option></option>
            @isset($shipping_company_services)
                @foreach($shipping_company_services as $shipping_company_service)
                    <option value="{{ $shipping_company_service['id'] }}"
                            @if(old('shipping_company_service_id') && !empty(old('shipping_company_service_id')) && old('shipping_company_service_id') == $shipping_company_service['id'] ) selected @endif >
                        {{ $shipping_company_service['name'] }}
                    </option>
                @endforeach
            @endisset

        </select>
        <div class="input-group-append">
            <button class="btn btn-primary add-shipping-company-service-btn" type="button"
                    data-title="Add Shipping Company Service">
                <i class="la la-plus"></i>
            </button>
        </div>
        @if($errors->has('shipping_company_service_id'))
            <div class="help-block text-danger shipping_company_service_id-shopwoo-error">
                <ul role="alert">
                    <li>{{$errors->first('shipping_company_service_id')}}</li>
                </ul>
            </div> @endif
    </div>
</div>
