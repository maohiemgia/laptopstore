<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
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
            'description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'image' => 'nullable|image|max:2048', // nullable and max size of 2MB
            'slide_image.*' => 'nullable|image|max:2048', // nullable and max size of 2MB for each slide image
            'slide_image' => 'max:8', // Maximum of 8 files for the slide_image input
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả',
            'name.min' => 'Tên sản phẩm phải có ít nhất :min ký tự',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'sub_category_id.required' => 'Vui lòng chọn danh mục con sản phẩm',
            'image.image' => 'Ảnh sản phẩm không đúng định dạng',
            'image.max' => 'Ảnh sản phẩm không được vượt quá kích thước :max KB',
            'slide_image.*.image' => 'Ảnh slide sản phẩm không đúng định dạng',
            'slide_image.*.max' => 'Kích thước của ảnh slide sản phẩm không được vượt quá :max KB',
            'slide_image.max' => 'Số lượng ảnh slide sản phẩm không được vượt quá :max',
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
            $result = $product->save();

            if ($request->hasFile('slide_image')) {
                $files = $request->file('slide_image');
                foreach ($files as $file) {
                    $filename = time() . '.' . $file->getClientOriginalName();
                    // move image to public/images
                    $file->move(public_path('images'), $filename);
                    $filepath = "images/" . $filename;

                    $gallery = new ProductGallery;
                    $gallery->product_id = $product->id;
                    $gallery->image = $filepath;
                    $gallery->save();
                }
            }

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
        $product = Product::with('category')->with('productoptions')->find($request->product);
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
