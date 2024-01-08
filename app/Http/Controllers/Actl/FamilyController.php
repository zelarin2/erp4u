<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;

use Auth;
use Illuminate\Support\Carbon;

class FamilyController extends Controller
{
    public function FamilyAll(){
        $families = Family::latest()->get();
        return view('backend.family.family_all', compact('families'));
    }

    public function FamilyAdd(){
        return view('backend.Family.family_add');
    }

    public function FamilyStore(Request $request){
        try{
            Family::insert([
                'family' => $request->family,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Family Inserted Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Family Inserted Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('family.all')->with($notification);
    }

    public function FamilyEdit($id){
        $family = Family::findOrFail($id);
        return view('backend.family.family_edit', compact('family'));
    }

    public function FamilyUpdate(Request $request){
        $family_id = $request->id;
        try{
            $tr = Family::findOrFail($family_id);
            $tr->family = $request->family;
            $tr->updated_by = Auth::user()->id;
            $tr->updated_at = Carbon::now();
            $tr->save();

            $notification = array(
                'message' => 'Family Updated Successfully.',
                'alert-type' => 'success',
            );
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Family Updated Insuccessfully.',
                'alert-type' => 'error',
            );
        }
        return redirect()->route('family.all')->with($notification);
    }
    public function FamilyDelete($id){
        try{
            Family::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Family Deleted Successfully.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Family Deleted Insuccessfully.',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('family.all')->with($notification);
    }
}
