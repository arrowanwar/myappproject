<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
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

            $invoiceId = $invoice->id;
            $products = $request->input('products');
            foreach($products as $eachProduct){
                InvoiceProduct::create([
                    'invoiceId'=> $invoiceId,
                    'user_id' => $user_id,
                    'product_id' => $eachProduct['product_id'],
                    'qty'=>$eachProduct['qty'],
                    'sale_price'=>$eachProduct['sale_price'],

                ]); 
            }

            DB::commit();
            return 1;

        }
        catch(Exception $e){
            DB::rollBack();
            return 0;

        }
    }
    function InvoiceSelect(Request $request){
        $user_id = $request->header('id');
        return Invoice::where('user_id', $user_id)->with('customer')->get();
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
