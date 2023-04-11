<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->with('user')->get();
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

        // The incoming request is valid then...
        // Retrieve the validated input data...
        // $validated = $request->validated();
        $order = new Order;
        $order->customer_name = $request->input('customer_name');
        $order->customer_email = $request->input('customer_email');
        $order->customer_address = $request->input('customer_address');
        $order->customer_phone_number = $request->input('customer_phone_number');
        $order->shipping_fee = $request->input('shipping_fee');
        $order->payment_type = $request->input('payment_type');
        $order->total_cost = $request->input('total_cost');
        $order->note = $request->input('note');

        $order->save();

        $order_details = [];
        foreach ($productOptions as $p) {
            $order_detail = [
                'order_id' => $order->id,
                'product_option_id' => $p['id'],
                'product_detail' => $p['product_name'] . $p['cpu'] . $p['gpu'] . $p['ram'] . $p['memory'],
                'quantity' =>  $p['cartquantity'],
                'price' =>  $p['price'] - $p['discount_value'],
            ];
            array_push($order_details, $order_detail);
        }

        foreach ($order_details as $ord) {
            OrderDetail::create($ord);
        }

        session()->flush();

        return redirect('/order-result/' . $order->id);
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
