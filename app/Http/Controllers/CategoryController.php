<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function deletedCategory()
    {
        $deletedCategories = Category::onlyTrashed()->get();
        return view('categories.deletedList', [
            'deletedCategories' => $deletedCategories
        ]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('/categories')->with('success', 'Category Has Been Restored Succesfully!');
    }
}
