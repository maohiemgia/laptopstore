<?php

namespace App\Http\Controllers;

use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $options = ProductOption::with('product')->orderBy('id', 'desc')->paginate(5);
        $id = $request->id;
        if (preg_match("/api/", $request->url())) {
            return $options;
        }
        return view('admin.option.index',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->id;
        return view('admin.option.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $validate = Validator::make($request->all(),[
            'cpu' => 'required',
            'gpu' => 'required',
            'ram' => 'required',
            'memory' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required',
            'battery' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'id' => 'required'
        ]);
    if($validate->fails()){
        $errors = $validate->errors();
        return redirect()->back()->withErrors($errors);
    }else{
        $option = new ProductOption();
        $option->cpu = $request->cpu;
        $option->gpu = $request->gpu;
        $option->ram = $request->ram;
        $option->memory = $request->memory;
        $option->quantity = $request->quantity;
        $option->price = $request->price;
        $option->status = $request->status;
        $option->battery = $request->battery;
        $option->size = $request->size;
        $option->weight = $request->weight;
        $option->product_id = $request->id;
        $result = $option->save();
        if($result){
            return redirect('/option?id='.$id)->with('success', "Tạo mới phiên bản thành công");
        }else{
            return redirect('/option?id='.$id)->with('success', 'Đã có lỗi xảy ra');
        }
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $option = ProductOption::with('product')->where('id', $request->option)->get();
        return $option;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $option = ProductOption::find($request->option);
        if (preg_match("/api/", $request->url())) {
            return $option;
        }
        return view('admin.option.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductOption $productOption)
    {
        $id = $request->id;
        $validate = Validator::make($request->all(),[
            'cpu' => 'required',
            'gpu' => 'required',
            'ram' => 'required',
            'memory' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required',
            'battery' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'id' => 'required'
        ]);
    if($validate->fails()){
        $errors = $validate->errors();
        return redirect()->back()->withErrors($errors);
    }else{
        $option = ProductOption::find($request->id);
        $option->cpu = $request->cpu;
        $option->gpu = $request->gpu;
        $option->ram = $request->ram;
        $option->memory = $request->memory;
        $option->quantity = $request->quantity;
        $option->price = $request->price;
        $option->status = $request->status;
        $option->battery = $request->battery;
        $option->size = $request->size;
        $option->weight = $request->weight;
        $option->product_id = $request->id;
        $result = $option->save();
        if($result){
            return redirect('/option?id='.$id)->with('success', "Cập nhật phiên bản thành công");
        }else{
            return redirect('/option?id='.$id)->with('success', 'Đã có lỗi xảy ra');
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $option = ProductOption::find($request->id);
        $id = $option->product_id;
        if($option){
            $option->delete();
            return redirect('/option?id='.$id)->with('success', "Xóa phiên bản thành công");
        }else{
            return redirect('/option?id='.$id)->with('success', "Đã có lỗi xảy ra");
        }
    }
}
