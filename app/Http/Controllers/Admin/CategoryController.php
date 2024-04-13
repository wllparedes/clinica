<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request): Collection
    {

        if ($request->ajax()) {
            return Category::select('id', 'name')->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->get();
        }

        abort(403, 'Access denied');
    }

    public function getSubCategories(Request $request, Category $category): Collection
    {

        if ($request->ajax()) {
            return $category->subCategories()->select('id', 'name')->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->get();
        }

        abort(403, 'Access denied');
    }
}
