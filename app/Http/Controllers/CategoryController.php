<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function CategoryList(Request $request){
        $user_id = $request->header('userID');
        return Category::where('id', $user_id)->get();
    }
    function CategoryCreate(Request $request){
        // dd($request->all());
        $user_id = $request->header('userID');
        return Category::create([
            'name'=> $request->input('name'),
            'user_id'=>$user_id 
        ]);
    
    }
    function CategoryDelete(Request $request){
        $user_id = $request->header('userID');
        $category_id = $request->input('id');
        return Category::where('id', $category_id)->where('user_id', $user_id)->delete();
        
    }
    function CategoryById(Request $request){
        $user_id = $request->header('userID');
        $category_id = $request->input('id');
        return Category::where('id', $category_id)->where('user_id', $user_id)->first();
    }
    function CategoryUpdate(Request $request){

        $user_id = $request->header('userID');
        $category_id = $request->input('id');
        return Category::where('id', $category_id)->where('user_id', $user_id)->update([
            'name'=> $request->input('name')
        ]);
    }
}
