<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->get();
        if (preg_match("/api/", $request->url())) {
            return $products;
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('admin.product.create', compact('errors'));
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->sub_category_id = $request->sub_category_id;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            if (!is_null($request->image)) {
                $imageUpload = $request->file('image');
                $imageName = time() . '.' . $imageUpload->extension();

                // move image to public/images
                $request->image->move(public_path('images'), $imageName);
                $product->image = "images/" . $imageName;
            }
            // $product->image = $request->file('image')->store('updateImage');
            $result = $product->save();
            if ($result) {
                return redirect('/products')->with('success', "Tạo mới sản phẩm thành công");
            } else {
                return ('Đã có lỗi xảy ra');
            }
        }


        // $product = $request->all();
        // if (!is_null($request->image)) {
        //     $imageUpload = $request->file('image');
        //     $imageName = time() . '.' . $imageUpload->extension();

        //     // move image to public/images
        //     $request->image->move(public_path('images'), $imageName);
        //     $product['image'] = "images/" . $imageName;
        // }

        // Product::create($product);


        // return redirect('/products')->with('success', "Tạo mới sản phẩm thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $product = Product::find($request->product);
        if (preg_match("/api/", $request->url())) {
            return $product;
        }
        return view('admin.product.update');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $product = Product::find($request->product);
        if (preg_match("/api/", $request->url())) {
            return $product;
        }
        return view('admin.product.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'sub_category_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return view('admin.product.update', compact('errors'));
        } else {
            $product = Product::find($request->id);
            $product->name = $request->name;
            $product->sub_category_id = $request->sub_category_id;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            if (isset($request->image)) {
                $product->image = $request->file('image')->store('updateImage');
            }
            $result = $product->save();
            if ($result) {
                return redirect('/products')->with('success', "Cập nhật sản phẩm thành công");
            } else {
                return ('Đã có lỗi xảy ra');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            $product->delete();
            return redirect('/products')->with('success', "Xóa sản phẩm thành công");
        } else {
            return redirect('/products')->with('success', "Đã có lỗi xảy ra");
        }
    }
}
