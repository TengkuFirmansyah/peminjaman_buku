<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    function index(){
        $book = Books::select('*', DB::raw('(SELECT COUNT(*) FROM borrowing WHERE borrowing.book_id = books.id AND borrowing.status = 1) as stock_in_use'))
             ->get();

        return response()->json([
            'message' => 'Success!',
            'data' => $book,
        ], 200);
    }
}
