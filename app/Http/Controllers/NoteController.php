<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NoteController extends Controller
{
    function note(int $id): View{
        $title = Header::findOrFail($id)->attributesToArray();
        $notes = DB::select('call getAttachedNotes(?)', array($id));
        return view('notes',
            [
                'title' => $title,
                'notes' => $notes
            ]
        );
    }

    function addHeader(Request $request){
        Header::create([
            'title' => $request['header'],
            'user_id' => $request->user()->attributesToArray()['id'],
            'created_At' => date_create('now', timezone_open('Asia/Manila'))
        ]);
        return response()->json(['status' => 'success']);
    }

    function editHeader(Request $request): void{
        Header::where('header_id', $request->input('id'))
            ->update([
                'title' => $request->input('content')
            ]);
    }

    function editNote(Request $request): void{
        Note::where('header_id', $request->input('header'))
            ->where('note_sequence', $request->input('sequence'))
            ->update([
                'message' => $request->input('content')
            ]);
    }

    function addNote(Request $request) {
        Note::create([
            'header_id' => $request['parent'],
            'user_id' => $request->user()->attributesToArray()['id'],
            'note_sequence' => $request['sequence'],
            'message' => $request['content'],
            'note_isFinished' => false
        ]);
        return response()->json([
            'sequence' => $request['sequence'],
            'parent' => $request['parent'],
            'content' => $request['content']]);
    }

    function archive(Request $request){
        if($request->getRequestUri() == '/list/archive'){
            Note::where('header_id', $request['id'])->delete();
            Header::where('header_id', $request['id'])->delete();
        }else{
            Note::where('header_id', $request['parent'])->delete();
        }
        return response()->json(['status' => 'success']);
    }

    function collection(){
        return view('collection', ['notes' => Header::all()]);
    }

    function tick(Request $request){
        Note::where('header_id', $request['parent'])
            ->where('note_sequence', $request['input'])
            ->update([
                'note_isFinished' => $request['value']
            ]);
    }
}
