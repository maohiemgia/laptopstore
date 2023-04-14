<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\SubCategory;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
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
          $bestseller = Product::select('products.id', 'products.name', 'products.image', 'product_options.price', DB::raw('COUNT(order_details.product_option_id) as total_sales'))
          ->join('product_options', 'products.id', '=', 'product_options.product_id')
          ->join('order_details', 'product_options.id', '=', 'order_details.product_option_id')
          ->whereNull('products.deleted_at')
          ->groupBy('products.id', 'products.name', 'products.image', 'product_options.price')
          ->orderByDesc('total_sales')
          ->get();

          return view('client.home', compact('headerbanners', 'footerbanners', 'newproducts', 'featureproducts', 'bestseller'));
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

          $featureproducts = ProductOption::with('product')
               ->orderBy('price', 'desc')
               ->take(4)
               ->get();

          $categories = Category::with(['subcategories' => function ($query) {
               $query->withCount('products as sub_products_count')
                    ->orderByDesc('sub_products_count');
          }])
               ->withCount(['subcategories', 'products'])
               ->orderByDesc('products_count')
               ->get();

          $bestseller = Product::select('products.id', 'products.name', 'products.image', 'product_options.price', DB::raw('COUNT(order_details.product_option_id) as total_sales'))
               ->join('product_options', 'products.id', '=', 'product_options.product_id')
               ->join('order_details', 'product_options.id', '=', 'order_details.product_option_id')
               ->whereNull('products.deleted_at')
               ->groupBy('products.id', 'products.name', 'products.image', 'product_options.price')
               ->orderByDesc('total_sales')
               ->get();

          return view('client.product.index', compact('newproducts', 'featureproducts', 'categories', 'bestseller'));
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
               'name' => [
                    'required',
                    'exists:vouchers,name',
                    function ($attribute, $value, $fail) use ($vouchers) {
                         $voucher = $vouchers->where('name', $value)->first();
                         if ($voucher && $voucher->quantity <= 0) {
                              $fail('Số lượng của mã giảm giá đã hết!');
                         }
                    }
               ],
          ], [
               'name.required' => 'Mã giảm giá không tồn tại!',
               'name.exists' => 'Mã giảm giá không tồn tại!',
          ]);

          if ($validator->fails()) {
               // Redirect back with error message
               return redirect()->back()->withErrors($validator->errors())->withInput();
          }

          $voucher_match = Voucher::where('name', $voucher_code)->first();
          // Apply the voucher code
          $voucher_return = [
               'name' => $voucher_match->name,
               'value' => $voucher_match->value,
          ];
          // create a session have voucher id to decres voucher quantity after order saved
          session()->put('voucher', $voucher_match->id);

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
               return redirect()->back()->withErrors($validator)->withInput();
          }

          session(['checkResult' => $request->input('customer_email')]);

          $order = Order::with('orderdetails')->find($request->input('order_id'));

          $orderdata = $order->toArray();

          Mail::to($order->customer_email)->send(new OrderConfirmation($orderdata));

          return redirect('/order-result/' . $order->id)->with('success', 'Email chứa thông tin đơn hàng đã được gửi tới Mail của bạn!');
     }

     public function contact()
     {

          return view('client.contact.index');
     }

     public function searchproduct(Request $request)
     {
          $query = $request->input('query');

          $newproducts = Product::select('products.*')
               ->leftJoin('product_options', 'product_options.product_id', '=', 'products.id')
               ->where('products.name', 'like', "%$query%")
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

          $featureproducts = ProductOption::with('product')
               ->orderBy('price', 'desc')
               ->take(4)
               ->get();

          $categories = Category::with(['subcategories' => function ($query) {
               $query->withCount('products as sub_products_count')
                    ->orderByDesc('sub_products_count');
          }])
               ->withCount(['subcategories', 'products'])
               ->orderByDesc('products_count')
               ->get();

          $bestseller = Product::select('products.id', 'products.name', 'products.image', 'product_options.price', DB::raw('COUNT(order_details.product_option_id) as total_sales'))
               ->join('product_options', 'products.id', '=', 'product_options.product_id')
               ->join('order_details', 'product_options.id', '=', 'order_details.product_option_id')
               ->whereNull('products.deleted_at')
               ->groupBy('products.id', 'products.name', 'products.image', 'product_options.price')
               ->orderByDesc('total_sales')
               ->get();

          return view('client.product.index', compact('newproducts', 'featureproducts', 'categories', 'bestseller'));
     }

     public function filter(Request $request)
     {
          $query = Product::select('products.*')
               ->leftJoin('product_options', 'product_options.product_id', '=', 'products.id');

          // Filter by category and subcategory IDs
          if ($request->has('category_ids')) {
               $query->whereIn('category_id', $request->input('category_ids'));
          }

          if ($request->has('subcategory_ids')) {
               $query->whereIn('sub_category_id', $request->input('subcategory_ids'));
          }

          // Add order by price
          if ($request->has('price_order')) {
               $order = $request->input('price_order') == 'asc' ? 'asc' : 'desc';
               $query->orderBy('product_options.price', $order);
          } else {
               // Preserve existing order
               $query->orderByDesc('product_options.discount_value')
                    ->orderByDesc('product_options.price');
          }

          $newproducts = $query->groupBy(
               'products.id',
               'name',
               'image',
               'description',
               'sub_category_id',
               'category_id',
               'created_at',
               'updated_at',
               'deleted_at'
          )->paginate(9);

          // Append category and subcategory IDs to pagination links
          if ($request->has('category_ids')) {
               $newproducts->appends(['category_ids' => $request->input('category_ids')]);
          }

          if ($request->has('subcategory_ids')) {
               $newproducts->appends(['subcategory_ids' => $request->input('subcategory_ids')]);
          }

          if ($request->has('price_order')) {
               $newproducts->appends(['price_order' => $order]);
          }

          $featureproducts = ProductOption::with('product')
               ->orderBy('price', 'desc')
               ->take(4)
               ->get();

          $categories = Category::with(['subcategories' => function ($query) {
               $query->withCount('products as sub_products_count')
                    ->orderByDesc('sub_products_count');
          }])
               ->withCount(['subcategories', 'products'])
               ->orderByDesc('products_count')
               ->get();

          $bestseller = Product::select('products.id', 'products.name', 'products.image', 'product_options.price', DB::raw('COUNT(order_details.product_option_id) as total_sales'))
               ->join('product_options', 'products.id', '=', 'product_options.product_id')
               ->join('order_details', 'product_options.id', '=', 'order_details.product_option_id')
               ->whereNull('products.deleted_at')
               ->groupBy('products.id', 'products.name', 'products.image', 'product_options.price')
               ->orderByDesc('total_sales')
               ->get();

          return view('client.product.index', compact('newproducts', 'featureproducts', 'categories', 'bestseller'));
     }
}
