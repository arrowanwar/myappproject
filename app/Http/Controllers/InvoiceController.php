<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    function InvoiceCreate(Request $request){
    
        DB::beginTransaction();
        try{

            $user_id = $request->header('userID');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');
            
            $invoice = Invoice::create([
                'user_id'=> $user_id,
                'total'=> $total,
                'discount'=> $discount,
                'vat'=> $vat,
                'payable'=> $payable,
                'customer_id'=> $customer_id
                ]);

            $invoice_id = $invoice->id;
            $products = $request->input('products');


            DB::commit();
            return 1;

        }
        catch(Exception $e){
            DB::rollBack();
            return 0;

        }
    }
}

/*

    function InvoiceCreate(Request $request){
    
        DB::beginTransaction();
        try{



            DB::commit();
            return 1;

        }
        catch(Exception $e){
            DB::rollBack();
            return 0;

        }
    }





*/
