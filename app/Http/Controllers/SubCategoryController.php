<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subCategories = SubCategory::select('id', 'name')->get();
        if(preg_match("/api/",$request->url())){
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
        $subCategories = SubCategory::where('category_id', $id)->select('id', 'name')->get();
        if(preg_match("/api/",$request->url())){
            return $subCategories;
        }
        return view('admin.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
