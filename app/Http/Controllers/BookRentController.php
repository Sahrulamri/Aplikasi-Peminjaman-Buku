<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('bookRent', [
            'users' => $users,
            'books' => $books
        ]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDays(3)->toDateString();

        $book = Book::findOrfail($request->book_id)->only('status');

        if ($book['status'] != 'in stock') {
            Session::flash('message', 'Cannot Rent This Book, Because The Book is Not Available');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/bookRent');
        } else {

            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('message', 'Cannot Rent, User Has Reach The Limit Of Rent Books Actually');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/bookRent');
            } else {
                try {
                    DB::beginTransaction();
                    // prosess insert to rent_logs table
                    RentLogs::create($request->all());
                    // procces update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', 'The Book Has Been Success For Rent');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/bookRent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }

    public function returnBook()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('bookReturn', [
            'users' => $users,
            'books' => $books
        ]);
    }

    public function storeBook(Request $request)
    {
        // user & buku yang dipilih untuk direturn benar, maka berhasil return book
        // user & buku yang dipilih untuk diireturn salah, maka muncul error message
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();
        if ($countData > 0) {
            try {
                DB::beginTransaction();
                // prosess insert to rent_logs table
                $rentData->actual_return_date = Carbon::now()->toDateString();
                // procces update book table
                $book = Book::findOrFail($request->book_id);
                $book->status = 'in stock';
                $rentData->save();
                $book->save();
                DB::commit();

                Session::flash('message', 'The Book Has Been Returned Successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect('/bookReturn');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
            // $rentData->actual_return_date = Carbon::now()->toDateString();
            // $rentData->save();

            // Session::flash('message', 'The Book Has Been Returned Successfully!');
            // Session::flash('alert-class', 'alert-success');
            // return redirect('/bookReturn');
        } else {
            Session::flash('message', 'The Book Has Failed To Returned, Proccesss Have a Error!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/bookReturn');
        }
    }
}
