<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->category || $request->title) {
            $books = Book::where('title', 'like', '%' . $request->title . '%')
                ->orWhereHas('categories', function ($res) use ($request) {
                    $res->where('categories.id', $request->category);
                })->paginate(12)->withQueryString();
        } else {
            $books = Book::paginate(12)->withQueryString();
        }

        return view('bookList', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}
