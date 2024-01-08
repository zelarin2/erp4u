<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;
use Image;

use Auth;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function ProductAll(){
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }
    public function ProductAdd(){
        $families = Family::all();
        $unitMeasures = UnitMeasure::all();
        $taxRates = TaxRate::all();
        return view('backend.product.product_add', compact('families','unitMeasures','taxRates'));
    }
    public function ProductStore(Request $request){
        $imageFile = $request->file('profile_image');
        $transformName = hexdec(uniqid()).".".$imageFile->getClientOriginalExtension();
        Image::make($imageFile)->resize(200,200)->save('upload/product/'.$transformName);
        $save_url = 'upload/product/'.$transformName;
        try{
            Product::insert([
                'code' => $request->code,
                'description' => $request->description,
                'family' => $request->product_family,
                'unit' => $request->product_unit,
                'taxRateCode' => $request->taxRateCode_Product,
                'image' => $save_url,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Inserted Successfully.',
                'alert-type' => 'success',
            );
            return redirect()->route('product.all')->with($notification);
        } catch(\Exception $e) {
            $notification = array(
                'message' => 'Product Inserted Insuccessfully.',
                'alert-type' => 'error',
            );
            unlink($save_url);
            return redirect()->route('product.all')->with($notification);
        }
    }
    public function ProductEdit($id){
        $families = Family::all();
        $unitMeasures = UnitMeasure::all();
        $taxRates = TaxRate::all();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('families', 'unitMeasures', 'taxRates','product'));
    }
    public function ProductUpdate(Request $request){
        $product_id = $request->id;

        $product = Product::findOrFail($product_id);
        $img = $product->image;

        if ( $request->file('profile_image')){
            $wimagem = $request->image;
            $image = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;
        }
        try{
            if($request->file('profile_image')){
                Product::FindOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'image' => $save_url,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);
                unlink($img);
                $notification = array(
                    'message'=>'Product Updated Successfully.',
                    'alert-type'=>'success',
                );
                return redirect()->route('product.all')->with($notification);
            } else {
                Product::FindOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message'=>'Product Updated Successfully.',
                    'alert-type'=>'success',
                );
                return redirect()->route('product.all')->with($notification);
            }
        } catch (\Exception $e){
            $notification = array(
                'message'=>'Product Updated Insuccessfully.',
                'alert-type'=>'error',
            );
            return redirect()->route('product.all')->with($notification);
        }
    }
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        $img = $product->image;

        try{
            Product::findOrFail($id)->delete();
            unlink($img);
            $notification = array(
                'message'=>'Product Deleted Successfully.',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e){
            $notification = array(
                'message'=>'Product Deleted Insuccessfully.',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);    
        }
    }
}

