<?php

namespace App\Http\Controllers\Web\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Setting\SettingRequest;
use App\Models\Setting;
use App\Models\Currency;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index_old(){

         try{
            $edit_values = Setting::first();
            return view('originator.container.setting.setting-form', compact('edit_values'));
         }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
         }

    }

 public function index(){

         try{
            $setting = Setting::all();
            $currency=Currency::all();
//             dd($currency);
            return view('originator.container.setting.setting-form-new', compact('setting','currency'));
         }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
         }

    }

    public function get_currency(){
        $currency=Currency::all();
        // dd($currency);
        // $html=array();
            // $html=0;
            $html="";
        foreach($currency as $c){
            $html.='<option class="option" value="'.$c->id.'">'.$c->name.'</option>';
        }
        return $html;
    }
     public function add_currency(Request $request){
            // dd($request->all());
             $currency=Currency::where('name','=',strtoupper($request->currency))->get();
         if($currency!=null){
                 $currency=new Currency;
                 $currency->name=strtoupper($request->currency);
             if($currency->save()){
                    return response()->json(['message'=>'success','id'=> $currency->id]);
              }else{
                     return response()->json(['message'=>'error']);
                }
            }else{
                return response()->json(['messsage'=> 'error2']);
            }
     }

     public function add_additional(Request $request){
         // if(isset($request->currency))
         $check=Setting::where('currency_id','=', $request->currency_id)->first();
         $currency=Currency::where('id','=',$request->currency_id)->first();
         $name=$currency->name;
        if($check == null){
             $currency=Setting::create([ $request->check => $request->value,'currency' => $name, 'currency_id' => $request->currency_id]);
        }else{
        //    $currency=Setting::where('currency_id',$request->currency_id)->update([$request->check => $request->value,'currency' => $name]);
           $currency=Setting::where('currency_id','=',$request->currency_id)->first();
           if($request->check=='digital_scan'){
             $currency->digital_scan=$request->value;
           }else if($request->check == 'international_courier_charges'){
             $currency->international_courier_charges=$request->value;
           }else if ($request->check=='aligner_kit_price'){
             $currency->aligner_kit_price=$request->value;
           }else if($request->check=='complete_treatment_plan'){
             $currency->complete_treatment_plan=$request->value;
           }
             $currency->currency=$name;
             $currency=$currency->save();
        }
        if($currency){
            return response()->json(['message' =>'success','name'=>$name,'id',$request->currency_id]);
        }else{
            return response()->json(['message'=>'error']);
        }
     }

     public function delete(Request $request){
     if($request->check == 'currency'){
                 $currency=Currency::where('id','=',$request->id)->first();
         if($currency->forceDelete()){
                 $setting=Setting::where('currency_id','=',$request->id)->first();
                 if($setting !=null){
                     $setting->forceDelete();
                     return response()->json(['message' => 'success']);
                 }else{
                     return response()->json(['message' => 'success']);
                 }
             }else{
                return response()->json(['message' => 'error']);
             }

         }else {
                $setting=Setting::where('currency_id','=',$request->id)->first();
         if($request->check == 'digital'){
            $setting->update(['digital_scan' => null]);
             }else if($request->check == 'international'){
                $setting->update(['international_courier_charges' => null]);
             }else if($request->check == 'aligners'){
                $setting->update(['aligner_kit_price' => null]);
             }else if($request->check == 'treatment'){
                $setting->update(['complete_treatment_plan' => null]);
             }
         if($setting){
                return response()->json(['message' => 'success']);
             }else{
                return response()->json(['message' => 'error']);
             }
         }
     }

  public function store(SettingRequest $request)
    {
        // international_courier_charges
        // digital_scan
        try{
            $inputs = $request->only([
                'currency',
                'impression_kit_price',
                'aligner_kit_price',
                'case_fee',
                'complete_treatment_plan'
            ]);

            $inputs['home_impression_kit_enabled'] = $request->has('home_impression_kit_enabled') ? 1 : 0;
            $inputs['home_appointment_enabled'] = $request->has('home_appointment_enabled') ? 1 : 0;
            $inputs['home_i_am_candiate_enabled'] = $request->has('home_i_am_candiate_enabled') ? 1 : 0;

            $user = Setting::find(1);
            $user->update($inputs);

            return redirect()->back()->with(['successMessage' => 'Updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
