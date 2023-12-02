<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function index()
    // {
    //     return view('books', [
    //         'books' => Book::all()
    //     ]);
    // }

    public function deletedBooks()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('books.deletedList', [
            'deletedBooks' => $deletedBooks
        ]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('/books')->with('success', 'The Book Has Been Restored Succesfully!');
    }
}
