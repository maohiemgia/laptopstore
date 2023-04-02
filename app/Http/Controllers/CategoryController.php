<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $categories = DB::table('categories as c')
        //     ->leftJoin('sub_categories as sc', 'c.id', '=', 'sc.category_id')
        //     // ->leftJoin('products as p', 'sc.id', '=', 'p.sub_category_id')
        //     // ->select('c.id', 'c.name', DB::raw('count(p.sub_category_id) as product_by_category'))
        //     // ->groupBy('c.id', 'c.name', 'p.sub_category_id')
        //     // ->orderByDesc('product_by_category')
        //     ->get();
        // dd(Category::with('sub')->find(2)->sub);
        $categories = DB::table('categories as c')->select('c.id', 'c.name')->selectSub(function ($query) {
            $query->from('sub_categories as sc')->whereColumn('sc.category_id', 'c.id')->selectRaw('count(sc.id)');
        }, 'subcat_count')->selectSub(function ($query) {
            $query->from('products as p')->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.sub_category_id')->whereColumn('sc.category_id', 'c.id')->selectRaw('ifnull(count(p.sub_category_id), 0)');
        }, 'prod_count')->orderByDesc('subcat_count')->orderByDesc('prod_count')->get();
        if(preg_match("/api/",$request->url())){
            return $categories;
        }
        // return view('admin.category.index', ['categories' => $categories]);
        
        return view('admin.category.index', ['categories' => $categories]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // The incoming request is valid then...

        // Retrieve the validated input data...
        $validated = $request->validated();


        // Create and save the new category by category instance...
        $category = new Category();
        $category->name = $validated['name'];
        $category->save();

        return redirect('/categories')->with('success', 'Tạo mới danh mục thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::with('sub')->find($category);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // // Soft delete a category by id
        // $category = Category::find($id);
        // $category->delete();

        // // Soft delete multiple categories by a condition
        // Category::where('name', 'like', '%test%')->delete();
    }

    public function softDelete($id)
    {
        // Find the category by id or fail with 404 error
        $category = Category::findOrFail($id);

        // Soft delete the category and return a response
        if ($category->delete()) {
            return response()->json(['message' => 'Xóa mềm cho danh mục thành công.']);
        } else {
            return response()->json(['message' => 'Xóa mềm cho danh mục thất bại.'], 500);
        }
    }
}
