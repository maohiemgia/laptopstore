<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subCategories = SubCategory::select('id', 'name', 'category_id')->get();
        if (preg_match("/api/", $request->url())) {
            return $subCategories;
        }
        return view('admin.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory, Request $request, $id)
    {
        $subCategories = SubCategory::where('category_id', $id)->select('id', 'name')->withTrashed()->get();
        if (preg_match("/api/", $request->url())) {
            return $subCategories;
        }
        // return view('admin.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory, $id)
    {
        $subcategory = SubCategory::withTrashed()->find($id);

        return view('admin.category.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, SubCategory $subCategory, $id)
    {
        $category = SubCategory::withTrashed()->find($id);
        $category->update($request->all());
        $message = 'Cập nhật danh mục con thành công.';

        return redirect('/categories')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory, $id)
    {
        $category = SubCategory::find($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Xóa danh mục con thành công.');
    }

    public function restore($id)
    {
        $category = SubCategory::withTrashed()->find($id);
        $category->restore();

        return redirect('/categories')->with('success', 'Khôi phục danh mục con thành công');
    }
}
