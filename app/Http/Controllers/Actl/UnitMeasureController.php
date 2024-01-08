<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitMeasure;

use Auth;
use Illuminate\Support\Carbon;

class UnitMeasureController extends Controller
{
    public function UnitMeasureAll(){
        $unitMeasures = UnitMeasure::latest()->get();
        return view ('backend.unitMeasure.unitMeasure_all', compact('unitMeasures'));
    }
    
    public function UnitMeasureAdd(){
        return view ('backend.unitMeasure.unitMeasure_add');
    }
    public function UnitMeasureStore(Request $request){
        try{
            UnitMeasure::insert([
                'unit' => $request->unit,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Unit Measure Inserted Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Unit Measure Inserted Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('unitMeasure.all')->with($notification);
    }
    public function UnitMeasureEdit($id) {
        $unitMeasure = UnitMeasure::findOrFail($id);
        return view('backend.unitMeasure.unitMeasure_edit', compact('unitMeasure'));
    }
    public function UnitMeasureUpdate(Request $request){
        $unitMeasure_id = $request->id;
        try{
         UnitMeasure::findOrFail($unitMeasure_id)->update([
            'unit' => $request->unit,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
         ]);
            $notification = array(
                'message' => 'Unit Updated Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Unit Updated Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('unitMeasure.all')->with($notification);
    }
    public function UnitMeasureDelete($id){
        try{
            UnitMeasure::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Unit Deleted Successfully.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Unit Deleted Insuccessfully.',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }
}
