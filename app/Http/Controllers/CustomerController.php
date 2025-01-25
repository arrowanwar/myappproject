<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function CustomerList(Request $request){
        $user_id = $request->header('userID');
        return Customer::where('id', $user_id)->get();
    }
    function CustomerCreate(Request $request){
        // dd($request->all());
        $user_id = $request->header('userID');
        return Customer::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'mobile'=> $request->input('mobile'),
            'user_id'=>$user_id 
        ]);
    
    }
    function CustomerDelete(Request $request){
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->delete();
        
    }
    function CustomerById(Request $request){
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->first();
    }
    function CustomerUpdate(Request $request){

        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        return Customer::where('id', $customer_id)->where('user_id', $user_id)->update([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'mobile'=> $request->input('mobile'),
        ]);
    }
}
