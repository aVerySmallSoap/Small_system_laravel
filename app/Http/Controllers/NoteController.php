<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Header;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'category_id' => $request['category'],
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
        Note::where('header_id', $request['id'])->delete();
        Header::where('header_id', $request['id'])->delete();
        return response()->json(['status' => 'success']);
    }

    function clear(Request $request){
        Note::where('header_id', $request['id'])->delete();
        return response()->json(['status' => 'success']);
    }

    function collection(){
        $id = Auth::user()['id'];
        return view('collection', [
            'notes' => Header::where('user_id', $id)->get()
        ]);
    }

    function tick(Request $request){
        Note::where('header_id', $request['parent'])
            ->where('note_sequence', $request['input'])
            ->update([
                'note_isFinished' => $request['value']
            ]);
    }

    function addCat(){
        return view('category.add');
    }

    function insertCat(Request $request){
        Category::create([
            'user_id' => Auth::user()['id'],
            'category_name' => $request['category']
        ]);
        $returning = Category::where('user_id', Auth::user()['id'])->where('category_name', $request['category'])->get();
        return response()->json(['status' => 'success', 'id' => $returning]);
    }

    function helperCat(){
        $json = Category::where('user_id', Auth::user()['id'])->get();
        return response()->json(['items' => $json]);
    }

    function fetchCat(int $id){
        return view('category.index', [
            'category' => $id,
            'lists' => Header::where('category_id', $id)->where('user_id', Auth::user()['id'])->get()
        ]);
    }

    function archiveCat(int $id){
        $headers = Header::where('category_id', $id)->get();
        foreach ($headers as $list){
            Note::where('header_id', $list['header_id'])->delete();
        }
        Header::where('category_id', $id)->delete();
        Category::destroy($id);
        return response()->redirectToIntended('/notes');
    }
}
