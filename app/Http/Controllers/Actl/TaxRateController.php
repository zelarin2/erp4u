<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxRate;

use Auth;
use Illuminate\Support\Carbon;
class TaxRateController extends Controller
{
    public function TaxRateAll(){
        $taxRates = TaxRate::latest()->get();
        return view('backend.taxRate.taxRate_all', compact('taxRates'));
    }

    public function TaxRateAdd(){
        return view('backend.taxRate.taxRate_add');
    }
    public function TaxRateStore(Request $request){
        try{
            TaxRate::insert([
                'taxRateCode' => $request-> taxRateCode,
                'descriptionTaxRate' => $request-> descriptionTaxRate,
                'taxRate' => $request-> taxRate,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Tax Rate Inserted Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Tax Rate Inserted Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('taxRate.all')->with($notification);
    }
    public function TaxRateEdit($id){
        $taxRate = TaxRate::findOrFail($id);
        return view('backend.taxRate.taxRate_edit',compact('taxRate'));
    }
    public function TaxRateUpdate(Request $request){
        $taxRate_id = $request->id;
        TaxRate::findOrFail($taxRate_id)->update([
            'taxRateCode' => $request-> taxRateCode,
            'descriptionTaxRate' => $request-> descriptionTaxRate,
            'taxRate' => $request-> taxRate,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Tax Rate Updated Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->route('taxRate.all')->with($notification);
    }
    public function TaxRateDelete($id){

        TaxRate::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Family Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
