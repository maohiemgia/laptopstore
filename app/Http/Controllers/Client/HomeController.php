<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
          $headerbanners = Banner::where('location', '=', 1)->get();
          $footerbanners = Banner::where('location', '=', 2)->get();
          $newproducts = Product::with('productoptions')->orderBy('created_at', 'desc')->take(8)->get();
          $featureproducts = ProductOption::with('product')->orderBy('price', 'desc')->take(4)->get();

          return view('client.home', compact('headerbanners', 'footerbanners', 'newproducts', 'featureproducts'));
     }

     public function products()
     {
          $newproducts = Product::with([
               'productoptions' =>
               function ($query) {
                    $query->orderBy('discount_value', 'desc');
               }
          ])->orderBy('created_at', 'desc')->paginate(9);

          $featureproducts = ProductOption::with('product')->orderBy('price', 'desc')->take(4)->get();

          return view('client.product.index', compact('newproducts', 'featureproducts'));
     }

     public function productdetail($id, Request $request)
     {
          $product = Product::with([
               'productoptions' =>
               function ($query) {
                    $query->orderBy('discount_value', 'desc');
               },
               'productgalleries' =>
               function ($query) {
                    $query->orderBy('id', 'asc');
               }
          ])->find($id);

          $productcate = SubCategory::with('category')->where('id', '=', $product->sub_category_id)->first();

          if (preg_match("/api/", $request->url())) {
               $product = Product::with([
                    'productoptions' =>
                    function ($query) {
                         $query->orderBy('price', 'desc');
                    }
               ])->find($id);
               return $product;
          }

          return view('client.product.show', compact('product', 'productcate'));
     }
     public function checkout()
     {
          return view('client.checkout.index');
     }
     public function orderresult($id)
     {
          $order = Order::with('orderdetails')->find($id);

          return view('client.checkout.result', compact('order'));
     }
}
