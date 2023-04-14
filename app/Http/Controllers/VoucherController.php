<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $voucher = Voucher::orderBy('id', 'desc')->get();
        $id = $request->id;
        if (preg_match("/api/", $request->url())) {
            return $voucher;
        }
        return view('admin.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'value' => 'required|numeric',
            'require_money' => 'required|numeric',
            'date_expired' => 'required',
            'quantity' => 'required|numeric',
            'status' => 'required'
        ]);
    if($validate->fails()){
        $errors = $validate->errors();
        return redirect()->back()->withErrors($errors);
    }else{
        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->value = $request->value;
        $voucher->require_money = $request->require_money;
        $voucher->quantity = $request->quantity;
        $voucher->date_expired = $request->date_expired;
        $voucher->description = $request->description;
        $voucher->status = $request->status;
        $result = $voucher->save();
        if($result){
            return redirect('/vouchers')->with('success', "Tạo mới mã giảm gias thành công");
        }else{
            return redirect('/vouchers')->with('success', 'Đã có lỗi xảy ra');
        }
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $option = Voucher::find($request->voucher);
        return $option;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.voucher.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'value' => 'required|numeric',
            'require_money' => 'required|numeric',
            'quantity' => 'required|numeric',
            'status' => 'required'
        ]);
    if($validate->fails()){
        $errors = $validate->errors();
        return redirect()->back()->withErrors($errors);
    }else{
        $voucher = Voucher::find($request->id);
        $voucher->name = $request->name;
        $voucher->value = $request->value;
        $voucher->require_money = $request->require_money;
        $voucher->quantity = $request->quantity;
        if($request->date_expired){
            $voucher->date_expired = $request->date_expired;
        }
        $voucher->description = $request->description;
        $voucher->status = $request->status;
        $result = $voucher->save();
        if($result){
            return redirect('/vouchers')->with('success', "Cập nhật mã giảm giá thành công");
        }else{
            return redirect('/vouchers')->with('success', 'Đã có lỗi xảy ra');
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $voucher = Voucher::find($request->id);
        $id = $voucher->product_id;
        if($voucher){
            $voucher->delete();
            return redirect('/vouchers')->with('success', "Xóa mã giảm giá thành công");
        }else{
            return redirect('/vouchers')->with('success', "Đã có lỗi xảy ra");
        }
    }
}
