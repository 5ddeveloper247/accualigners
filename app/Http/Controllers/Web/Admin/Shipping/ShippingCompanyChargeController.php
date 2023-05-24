<?php

namespace App\Http\Controllers\Web\Admin\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Shipping\Charge\ShippingCompanyChargeEditRequest;
use App\Http\Requests\Web\Admin\Shipping\Charge\ShippingCompanyChargeStoreRequest;
use App\Http\Requests\Web\Admin\Shipping\Charge\ShippingCompanyChargeUpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\ShippingCompanyCharge;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;

class ShippingCompanyChargeController extends Controller
{
    public function index(Request $request)
    {
        try{

            $shipping_company_charges = ShippingCompanyCharge::select('shipping_company_charges.*', 'shipping_companies.name')
            ->join('shipping_companies', 'shipping_companies.id', 'shipping_company_charges.shipping_company_id')
            ->where('shipping_company_id', $request->route('shipping'));

            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $shipping_company_charges = $shipping_company_charges->where(function ($query) use($filter){
                    $query->where('shipping_companies.name', 'like', "%".$filter."%");
                });
            }

            $shipping_company_charges = $shipping_company_charges->groupBy('shipping_company_charges.id')->paginate(15);

            return view('originator.container.shipping-company.charge.shipping-company-charge-view', compact('shipping_company_charges'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
            $countries = Country::orderBy('name')->get();

            return view('originator.container.shipping-company.charge.shipping-company-charge-form', compact('countries'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(ShippingCompanyChargeStoreRequest $request)
    {
        try{
            $inputs = $request->only(['country_id', 'state_id', 'city_id', 'amount', 'duration_text']);
            
            $inputs['shipping_company_id'] = $request->route('shipping');

            $ShippingCompanyCharge = ShippingCompanyCharge::where('shipping_company_id', $inputs['shipping_company_id'])->where('country_id', $request->country_id);
            
            if(!empty($request->state_id)){
                $ShippingCompanyCharge = $ShippingCompanyCharge->where('state_id', $request->state_id);
            }else{
                $ShippingCompanyCharge = $ShippingCompanyCharge->whereNull('state_id');
            }

            if(!empty($request->city_id)){
                $ShippingCompanyCharge = $ShippingCompanyCharge->where('city_id', $request->city_id);
            }else{
                $ShippingCompanyCharge = $ShippingCompanyCharge->whereNull('city_id');
            }

            $ShippingCompanyCharge = $ShippingCompanyCharge->exists();

            if($ShippingCompanyCharge)
                return redirect()->back()->withInput()->with(['errorMessage' => 'Already exists']);

            ShippingCompanyCharge::create($inputs);
            return redirect()->back()->with(['successMessage' => 'Created successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        
    }

    public function edit(ShippingCompanyChargeEditRequest $request)
    {
        try{
            $edit_values = ShippingCompanyCharge::where('id', $request->route('charge'))->first();
            $countries = Country::all();
            $states = State::where('country_id', $edit_values->country_id)->get();
            $cities = empty($edit_values->state_id) ? [] : City::where('state_id', $edit_values->state_id)->get();
            return view('originator.container.shipping-company.charge.shipping-company-charge-form', compact('edit_values', 'countries', 'states', 'cities'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(ShippingCompanyChargeUpdateRequest $request, $id)
    {
        try{
            $inputs = $request->only(['country_id', 'state_id', 'city_id', 'amount', 'duration_text']);
            
            $inputs['shipping_company_id'] = $request->route('shipping');

            $ShippingCompanyCharge = ShippingCompanyCharge::where('id', '!=', $request->route('charge'))->where('shipping_company_id', $inputs['shipping_company_id'])->where('country_id', $request->country_id);
            
            if(!empty($request->state_id)){
                $ShippingCompanyCharge = $ShippingCompanyCharge->where('state_id', $request->state_id);
            }else{
                $ShippingCompanyCharge = $ShippingCompanyCharge->whereNull('state_id');
            }

            if(!empty($request->city_id)){
                $ShippingCompanyCharge = $ShippingCompanyCharge->where('city_id', $request->city_id);
            }else{
                $ShippingCompanyCharge = $ShippingCompanyCharge->whereNull('city_id');
            }

            $ShippingCompanyCharge = $ShippingCompanyCharge->exists();

            if($ShippingCompanyCharge)
                return redirect()->back()->withInput()->with(['errorMessage' => 'Already exists']);

            $shipping_company_charges = ShippingCompanyCharge::find($request->route('charge'));
            $shipping_company_charges->update($inputs);

            return redirect()->back()->with(['successMessage' => 'Created successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function destroy(ShippingCompanyChargeEditRequest $request,$id)
    {
        try{
            $shipping_company_charge = ShippingCompanyCharge::find($request->route('charge'));
            $shipping_company_charge->forceDelete();

            return successJsonResponse_h('Deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
