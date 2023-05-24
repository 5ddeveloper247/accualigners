<?php

namespace App\Http\Controllers\Web\Admin\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Shipping\ShippingEditRequest;
use App\Http\Requests\Web\Admin\Shipping\ShippingStoreRequest;
use App\Http\Requests\Web\Admin\Shipping\ShippingUpdateRequest;
use App\Models\ShippingCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingCompanyController extends Controller
{
    public function index(Request $request)
    {
        try{

            $shipping_companies = ShippingCompany::select('*');
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $shipping_companies = $shipping_companies->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter);
                });
            }

            $shipping_companies = $shipping_companies->paginate(15);

            return view('originator.container.shipping-company.shipping-company-view', compact('shipping_companies'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
            return view('originator.container.shipping-company.shipping-company-form');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(ShippingStoreRequest $request)
    {
        try{
            
            ShippingCompany::create($request->only(['name']));
            return redirect()->back()->with(['successMessage' => 'Shipping company created successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        
    }

    public function edit(ShippingEditRequest $request, $id)
    {
        try{
            $edit_values = ShippingCompany::find($id);
            
            return view('originator.container.shipping-company.shipping-company-form', compact('edit_values'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(ShippingUpdateRequest $request, $id)
    {
        try{
            
            $ShippingCompany = ShippingCompany::find($id);
            $ShippingCompany->update($request->only(['name']));

            return redirect()->back()->with(['successMessage' => 'Shipping company updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function destroy(ShippingEditRequest $request,$id)
    {
        try{
            $ShippingCompany = ShippingCompany::find($id);
            $ShippingCompany->forceDelete();

            return successJsonResponse_h('Shipping company deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
