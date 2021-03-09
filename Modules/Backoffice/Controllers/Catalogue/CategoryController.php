<?php

namespace Corvus\Backoffice\Controllers\Catalogue;

use Illuminate\Http\Request;
use Corvus\Core\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use DB;

use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function products(Category $category)
    {
        return view('admin.categories.products', compact('category'));
    }

    public function data(Category $category)
    {
        $products = DB::table('products')
            ->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'product_categories.category_id')
            ->where('categories.id', $category->id)
            ->select( [
                'products.id as pid',
                'products.sku as product_sku',
                'products.name as product_name'
            ]);

        return datatables()->of($products)->toJson();
    }

    public function create()
    {
        return view('admin.categories.create_edit');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->taxonomy_id = $request->taxonomy_id;
        $category->slug = strtoupper (Str::slug($request->name, '_'));
        if ($category->save()) {
            return redirect(route('admin.categories.edit', $category->id))->withFlashSuccess(trans('labels.categories.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.categories.create'))->withFlashDanger('error', $error)->withInput();
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create_edit', compact('category'));
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->taxonomy_id = $request->taxonomy_id;
        $category->breadcrumb = $request->breadcrumb;

        if ($category->save()) {
            return redirect(route('admin.categories.edit', $category->id))->withFlashSuccess(trans('labels.categories.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.categories.edit'))->withFlashDanger($error)->withInput();
    }

    public function delete(Category $category)
    {
        return view('admin.categories.delete', compact('category'));
    }

    public function destroy(Category $group)
    {
        $group->delete();
        return redirect(route('admin.categories.index'))->withFlashSuccess(trans('labels.categories.deleted'));
    }
}
