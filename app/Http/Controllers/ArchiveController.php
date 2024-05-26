<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    function fetch(){
        $notes = DB::select('select * from archived_notes_view');
        return view('archives', ['notes' => $notes]);
    }
}
