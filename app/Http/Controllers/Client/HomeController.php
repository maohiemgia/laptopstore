<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubCategory;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
          $newproducts = Product::select('products.*')
               ->leftJoin('product_options', 'product_options.product_id', '=', 'products.id')
               ->orderByDesc('product_options.discount_value')
               ->orderByDesc('product_options.price')
               ->groupBy(
                    'products.id',
                    'name',
                    'image',
                    'description',
                    'sub_category_id',
                    'category_id',
                    'created_at',
                    'updated_at',
                    'deleted_at'
               )
               ->paginate(9);

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

     public function checkvoucher(Request $request)
     {
          $vouchers = Voucher::all();
          $voucher_code = $request->name;

          // Validate the voucher code
          $validator = Validator::make(['name' => $voucher_code], [
               'name' => 'required|exists:vouchers,name',
          ], [
               'name.required' => 'Mã giảm giá không tồn tại!',
          ]);

          if ($validator->fails()) {
               // Redirect back with error message
               return redirect()->back()->withErrors($validator);
          }

          $voucher_match = Voucher::where('name', $voucher_code)->first();
          // Apply the voucher code
          $voucher_return = [
               'name' => $voucher_match->name,
               'value' => $voucher_match->value,
               'max_value' => $voucher_match->max_des_value
          ];

          return redirect()->back()->with(['success' => 'Dùng mã giảm giá thành công.', 'voucher_return' => $voucher_return]);
     }
     public function orderresult($id)
     {
          $order = Order::with('orderdetails')->find($id);

          if (!Session::has('checkResult') || session('checkResult') !=  $order->customer_email) {
               session()->flush(); // Flush all session data

               return redirect('/');
          }

          return view('client.checkout.result', compact('order'));
     }
     public function findorder()
     {
          return view('client.checkout.findresult');
     }
     public function matchorder(Request $request)
     {
          print_r($request->all());

          $validator = Validator::make($request->all(), [
               'order_id' => 'required|exists:orders,id',
               'customer_email' => 'required|exists:orders,customer_email',
          ], [
               'order_id.required' => 'Mã đơn hàng không được để trống.',
               'customer_email.required' => 'Email khách hàng không được để trống.',
               'order_id.exists' => 'Không tìm thấy đơn hàng khớp.',
               'customer_email.exists' => 'Không tìm thấy đơn hàng khớp.'
          ]);


          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator);
          }

          session(['checkResult' => $request->input('customer_email')]);

          return redirect('/order-result/' . $request->input('order_id'));

          die;
     }

     public function contact()
     {

          return view('client.contact.index');
     }
}
