<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    
    function ProductList(Request $request){
        $user_id = $request->header('userID');
        return Product::where('id', $user_id)->get();
    }
    function CreateProduct(Request $request){
        // dd($request->all());
        $user_id = $request->header('userID');
        return Product::create([
            'name'=> $request->input('name'),
            'price'=> $request->input('price'),
            'unit'=> $request->input('unit'),
            'category_id' => $request->input('category_id'),
            'user_id'=>$user_id 
        ]);
    
    }
    function DeleteProduct(Request $request){
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Product::where('id', $customer_id)->where('user_id', $user_id)->delete();
        
    }
    function ProductById(Request $request){
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Product::where('id', $customer_id)->where('user_id', $user_id)->first();
    }
    function UpdateProduct(Request $request){

        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Product::where('id', $customer_id)->where('user_id', $user_id)->update([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'mobile'=> $request->input('mobile'),
        ]);
    }
}
