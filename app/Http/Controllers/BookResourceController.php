<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BookResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books', [
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:books',
            'image' => 'image|file|max:5120',

        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);

        return redirect('/books')->with('success', 'New Book Has Been Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('books.edit', [
            'categories' => $categories,
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {


        // Validasi data permintaan
        $validatedData = $request->validate([

            'book_code' => 'required|unique:books,book_code,' . $book->id,
            'title' => 'required',
            'slug' => 'required|unique:books,slug,' . $book->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // if ($request->slug != $book->slug) {
        //     $request['slug'] = 'required|unique:books';
        // }

        // Periksa apakah file gambar baru diunggah
        if ($request->file('image')) {
            // Hapus gambar lama jika ada
            if ($book->cover) {
                Storage::delete('cover/' . $book->cover);
            }

            // Unggah gambar baru
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $validatedData['cover'] = $newName; // Perbarui field cover dalam data yang divalidasi
        }

        // Perbarui buku dengan data yang divalidasi
        $book->update($validatedData);

        // Sinkronkan kategori jika diberikan dalam permintaan
        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('/books')->with('success', 'Book Has Been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('/books')->with('success', 'Book Has Been Deleted Successfully!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Book::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
