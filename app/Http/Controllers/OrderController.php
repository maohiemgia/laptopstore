<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductOption;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->with('user')->paginate(5);
        if (preg_match("/api/", $request->url())) {
            return $orders;
        }
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // nhận dữ liệu giỏ hàng từ cookie
        $productOptionsCookie = $_COOKIE['productOptions'];
        $productOptions = json_decode($productOptionsCookie, true);
        // Validate the voucher code
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_phone_number' => 'required|string|max:20',
            'shipping_fee' => 'numeric',
            'total_cost' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'discount_value' => 'nullable|numeric'
        ], [
            'customer_name.required' => 'Tên khách hàng không được để trống.',
            'customer_email.required' => 'Email khách hàng không được để trống.',
            'customer_email.email' => 'Email khách hàng không hợp lệ.',
            'customer_address.required' => 'Địa chỉ khách hàng không được để trống.',
            'customer_phone_number.required' => 'Số điện thoại khách hàng không được để trống.',
            'shipping_fee.numeric' => 'Phí vận chuyển phải là số.',
            'total_cost.required' => 'Tổng giá trị đơn hàng không được để trống.',
            'total_cost.numeric' => 'Tổng giá trị đơn hàng phải là số.',
            'total_cost.min' => 'Tổng giá trị đơn hàng không được nhỏ hơn 0.',
            'discount_value.numeric' => 'Giá trị giảm giá phải là số.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order = new Order;
        $order->customer_name = $request->input('customer_name');
        $order->customer_email = $request->input('customer_email');
        $order->customer_address = $request->input('customer_address');
        $order->customer_phone_number = $request->input('customer_phone_number');
        $order->shipping_fee = $request->input('shipping_fee');
        $order->payment_type = $request->input('payment_type');
        $order->total_cost = $request->input('total_cost') + $request->input('shipping_fee') - $request->input('discount_value');
        $order->note = $request->input('note');
        $order->discount_value = $request->input('discount_value');

        $order->save();
        
        $order_details = [];
        foreach ($productOptions as $p) {
            $order_detail = [
                'order_id' => $order->id,
                'product_option_id' => $p['id'],
                'product_detail' => "Tùy chọn: " . $p['optionindex'] . "(" . $p['product_name'] . $p['cpu'] . $p['gpu'] . $p['ram'] . $p['memory'] . ")",
                'quantity' =>  $p['cartquantity'],
                'price' =>  $p['price'] - $p['discount_value'],
            ];
            array_push($order_details, $order_detail);
        }

        // save product detail to order detail then 
        // product option quantity minus the quantity product has save in order detail
        foreach ($order_details as $ord) {
            $createOrderDetail = OrderDetail::create($ord);

            // minus product option quantity
            $option = ProductOption::find($createOrderDetail->product_option_id);
            $option->quantity -= $createOrderDetail->quantity;
            $option->save();
        }

        // handle voucher
        if (session()->has('voucher')) {
            $voucher = session()->get('voucher');

            $getVoucher = Voucher::find($voucher);
            $getVoucher->quantity--;
            $getVoucher->count_use++;
            $getVoucher->save();

            session()->forget('voucher');
        }

        setcookie('productOptions', '', time() - 3600);
        session()->flush();
        session(['checkResult' => $request->input('customer_email')]);

        $order = Order::with('orderdetails')->find($order->id);

        $orderdata = $order->toArray();

        Mail::to($order->customer_email)->send(new OrderConfirmation($orderdata));

        return redirect('/order-result/' . $order->id)->with('success', 'Email chứa thông tin đơn hàng đã được gửi tới Mail của bạn!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $order = Order::with('detail')->where('id', $request->order)->get();
        if (preg_match("/api/", $request->url())) {
            return $order;
        }
        return view('admin.order.update');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.order.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validate = Validator::make($request->all(), [
            'status' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return redirect()->back()->withErrors($errors);
        } else {
            $option = Order::find($request->id);
            $option->status = $request->status;
            $result = $option->save();
            if ($result) {
                return redirect('/orders')->with('success', "Cập nhật trạng thái đơn hàng thành công thành công");
            } else {
                return redirect('/orders')->with('success', 'Đã có lỗi xảy ra');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
