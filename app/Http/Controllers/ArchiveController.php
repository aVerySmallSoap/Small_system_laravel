<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    function fetch(int $page){
        $limit = 10;
        $offset = $limit * ($page - 1);
        $notes = DB::select('call paginate_archive(?,?)', [$limit, $offset]);
        $prev = ($page == 1) ? 0: $page-1;
        $next = (count($notes) < 10) ? 1: $page+1;
        return view('archives', [
            'notes' => $notes,
            'page' => $page,
            'next' => $next,
            'prev' => $prev,
            'count' => DB::select('select * from number_of_archived')[0]
        ]);
    }
}
