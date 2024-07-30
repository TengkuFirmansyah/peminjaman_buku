<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    function index(){
        $data = Members::select('*', DB::raw('(SELECT COUNT(*) FROM borrowing WHERE borrowing.member_id = members.id AND borrowing.status = 1) as borrowed'))
             ->get();

        return response()->json([
            'message' => 'Success!',
            'data' => $data,
        ], 200);
    }
}
