<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // print_r(Category::find(2)->subcategories[0]->products->count());

        // $categories = Category::select('id', 'name')
        // ->withCount(['subcategories as subcat_count' => function ($query) {
        //     $query->withCount('products as prod_count');
        // }])
        // ->get();

        $categories = DB::table('categories as c')->select('c.id', 'c.name', 'c.deleted_at')->selectSub(function ($query) {
            $query->from('sub_categories as sc')->whereColumn('sc.category_id', 'c.id')->selectRaw('count(sc.id)');
        }, 'subcat_count')->selectSub(function ($query) {
            $query->from('products as p')->leftJoin('sub_categories as sc', 'sc.id', '=', 'p.sub_category_id')->whereColumn('sc.category_id', 'c.id')->selectRaw('ifnull(count(p.sub_category_id), 0)');
        }, 'prod_count')->orderByDesc('subcat_count')->orderByDesc('prod_count')
            ->get();

        $subcategories = SubCategory::all();

        if (preg_match("/api/", $request->url())) {
            // query to not soft delete records
            $categories = Category::orderBy('name')->get();

            return $categories;
        }

        return view('admin.category.index', compact('categories', 'subcategories'));
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

        if (isset($request->category_id)) {
            SubCategory::create($request->all());
            $message = 'Tạo mới danh mục con thành công.';
        } else {
            Category::create($request->all());
            $message = 'Tạo mới danh mục thành công.';
        }
        return redirect('/categories')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::find($category->id)->subcategories()->withTrashed()->get();

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return redirect('/categories')->with('success', 'Danh mục đã bị xóa không thể chỉnh sửa');
        }

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        $message = 'Cập nhật danh mục thành công';

        return redirect('/categories')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        
        return redirect('/categories')->with('success', 'Xóa danh mục thành công');
    }
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();

        return redirect('/categories')->with('success', 'Khôi phục danh mục thành công');
    }
}
