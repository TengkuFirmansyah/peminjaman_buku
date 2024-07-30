<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrowing;
use App\Models\Members;
use App\Models\Pinalty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    function borrow(Request $request){
        $member = Members::where('code', $request['code_member'])->first();
        if(!$member) {
            return response()->json([
                'message' => 'Member tidak ditemukan!',
                'data' => null,
            ], 404);
        }
        $book = Books::where('code', $request['code_book'])->first();
        if(!$book) {
            return response()->json([
                'message' => 'Book tidak ditemukan!',
                'data' => null,
            ], 404);
        }

        $validasi = Borrowing::where('member_id', $member->id)
                            ->where('book_id', $book->id)
                            ->where('status', 1)
                            ->first();
        if($validasi) {
            return response()->json([
                'message' => 'Status peminjaman masih aktif!',
                'data' => null,
            ], 401);
        }
        
        $pinalty = Pinalty::where('member_id', $member->id)
                            ->where('book_id', $book->id)
                            ->where('end_date', '>', date('Y-m-d'))
                            ->first();
        if($pinalty) {
            return response()->json([
                'message' => 'Status member masih dalam pinalty!',
                'data' => null,
            ], 401);
        }

        $stock = Borrowing::where('book_id', $book->id)
                            ->where('status', 1)
                            ->count();

        if($stock >= $book->stock) {
            return response()->json([
                'message' => 'Stock Buku Habis!',
                'data' => null,
            ], 401);
        }

        $save = New Borrowing();
        $save->member_id = $member->id;
        $save->book_id = $book->id;
        $save->start_date = date('Y-m-d');
        $save->end_date = Carbon::today()->addDays(7)->format('Y-m-d');
        $save->status = 1;
        $save->save();

        return response()->json([
            'message' => 'Success!',
            'data' => $save,
        ], 200);
    }

    function return(Request $request){
        $member = Members::where('code', $request['code_member'])->first();
        if(!$member) {
            return response()->json([
                'message' => 'Member tidak ditemukan!',
                'data' => null,
            ], 404);
        }
        $book = Books::where('code', $request['code_book'])->first();
        if(!$book) {
            return response()->json([
                'message' => 'Book tidak ditemukan!',
                'data' => null,
            ], 404);
        }

        $validasi = Borrowing::where('member_id', $member->id)
                            ->where('book_id', $book->id)
                            ->where('status', 1)
                            ->first();
        if(!$validasi) {
            return response()->json([
                'message' => 'Status peminjaman tidak ditemukan!',
                'data' => null,
            ], 401);
        }
        
        if($validasi->end_date < Carbon::today()->format('Y-m-d')){
            $pinalty = new Pinalty();
            $pinalty->member_id = $member->id;
            $pinalty->book_id = $book->id;
            $pinalty->start_date = date('Y-m-d');
            $pinalty->end_date = Carbon::today()->addDays(3)->format('Y-m-d');
            $pinalty->save();

            $save = Borrowing::find($validasi->id);
            $save->status = 0;
            $save->save();
            
            return response()->json([
                'message' => 'Success dengan pinalty!',
                'data' => $save,
            ], 200);
        } else {
            $save = Borrowing::find($validasi->id);
            $save->status = 0;
            $save->save();
            return response()->json([
                'message' => 'Success!',
                'data' => $save,
            ], 200);

        }

    }
}
