<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
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
        return view('admin.product.index', compact('products'));
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
        // dd($request->validate());
        // if($request->validate()){
        //     
        //     $product->save();
        // };

        // return redirect('/products')->with('msg','Thêm mới sản phẩm thành công');

        //     $rules = [
        //         'name' => 'required|min:3',
        //         'sub_category_id' => 'required',
        //         'image' => 'required||image|mimes:jpg,png,jpeg,gif,svg|max:10000',
        //         'description' => 'required',
        //     ];
        //     $validate = Validator::make($request->all(), $rules);
        // if($validate->fails()){
        //     $errors = $validate->errors();
        //     return view('admin.product.create', compact('errors'));
        // }else{
        //     $product = new Product();
        //     $product->name = $request->name;
        //     $product->sub_category_id = $request->sub_category_id;
        //     $product->description = $request->description;
        //     $product->image = $request->file('image')->store('updateImage');
        //     $result = $product->save();
        //     if($result){
        //         return redirect('/products');
        //     }else{
        //         return('Đã có lỗi xảy ra');
        //     }
        // } 


        $product = $request->all();
        if (!is_null($request->image)) {
            $imageUpload = $request->file('image');
            $imageName = time() . '.' . $imageUpload->extension();

            // move image to public/images
            $request->image->move(public_path('images'), $imageName);
            $product['image'] = "images/" . $imageName;
        }

        Product::create($product);


        return redirect('/products')->with('success', "Tạo mới sản phẩm thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Product::find($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
