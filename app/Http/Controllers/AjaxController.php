<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    // public function fetchSubCat(Request $request)
    // {
    //     $subcate = DB::table('sub-categories')
    //     ->where('category_id', $request->catId)
    //     ->get();

    //     if (count($subcate) > 0) {
    //         return response()->json($subcate);
    //     }else{
    //         $error = ['message' => 'No Record Found'];
    //         return response()->json($error);
    //     }
    // }
    public function fetchSubCat(Request $request)
    {
        $subcategories = DB::table('sub_categories')
            ->where('category_id', $request->catId)
            ->get();

        return response()->json($subcategories);
    }

    public function FetchProductPrice(Request $request)
    {
        $product = DB::table('products')
            ->where('id', $request->productId)
            ->limit(1)
            ->get();

        if (count($product) > 0) {
            return response()->json($product);
        }else{
            $error = ['message' => 'No Record Found'];
            return response()->json($error);
        }
    }

    // public function SubadmintIdCheck(Request $request)
    // {
    //     $request->validate([
    //         'subadmin_id' => ['required'],
    //     ]);

    //     $student = DB::table('users')
    //     ->where('student_id', $request->subadmin_id)
    //     ->get();

    //     if (count($student) > 0) {
    //         return response()->json($student);
    //     }else{
    //         $error = ['message' => 'No Record Found'];
    //         return response()->json($error);
    //     }
    // }
}
