<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostalCode;
use Auth;
use Illuminate\Support\Carbon;

class PostalCodeController extends Controller
{
    public function PostalCodeAll(){
        $postalCodes = PostalCode::latest()->get();
        return view('backend.postalCode.postalCode_all',compact('postalCodes'));
    }
    public function PostalCodeAdd(){
        return view('backend.postalCode.postalCode_add');
    }
    public function PostalCodeStore(Request $request){
        try{
        PostalCode::insert([
            'postalCode' => $request->postalCode,
            'location' => $request->location,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Postal Code Inserted Successfully.',
            'alert-type' => 'success'
        );
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Postal Code Inserted Insuccessfully.',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('postalCode.all')->with($notification);
    }
    public function PostalCodeEdit($id){
        try{
            $postalCode = PostalCode::findOrFail($id);
            return view('backend.postalCode.postalCode_edit', compact('postalCode'));
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Postal Code Does Not Exist.',
                'alert-type' => 'error'
            );
            return redirect()->route('postalCode.all')->with($notification);
        }
    }
    public function PostalCodeUpdate(Request $request){
        $postalCode_id = $request->id;
        try{
            $tr = PostalCode::findOrFail($postalCode_id);
            $tr->postalCode = $request->postalCode;
            $tr->location = $request->location;
            $tr->updated_by = Auth::user()->id;
            $tr->updated_at = Carbon::now();
            $tr->save();
        $notification = array(
            'message' => 'Postal Code Updated Successfully.',
            'alert-type' => 'success'
        );
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Postal Code Updated Insuccessfully.',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('postalCode.all')->with($notification);
    }
    public function PostalCodeDelete($id){
        try{
            PostalCode::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Postal Code Deleted Successfully.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e){
            $notification = array (
                'message' => 'Postal Code Deleted Insuccessfully.',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }
}
