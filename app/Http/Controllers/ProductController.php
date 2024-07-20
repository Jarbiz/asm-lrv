<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function products(Request $request){
        $allCategories = Category::allCategories(5)->get();

        if($request->category_id){
            $allProducts = Product::where('category_id', $request->category_id)->orderBy('id', 'DESC')->paginate(9);
        }else{
            $allProducts = Product::allProducts(9)->paginate(9);
        }
       
        return view('products', compact('allProducts','allCategories'));
    }
    public function search(Request $request){
        $allCategories = Category::allCategories(5)->get();

        $kyw = $request->input('query');
            $allProducts = Product::where('title','LIKE',"%$kyw%")->orWhere('description','LIKE', "%$kyw%")->orderBy('id', 'DESC')->paginate(9);

        return view('products', compact('allProducts','allCategories'));
    }
    public function detail($id) {
        $product_one = DB::table('products')->where('id', $id)->first();
        
        // Ensure $product_one exists before querying related products
        if ($product_one) {
            $splq = Product::where('category_id', $product_one->category_id)->where('id', '<>', $id)->get();
        } else {
            $splq = collect();
        }
        // dd($product_one, $splq);
        return view('productdetail', ['product_one' => $product_one, 'splq' => $splq]);
    }
    
}
