<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="x-csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app/note.css')}}">
    <title>To-do App</title>
</head>
<body>

<div class="todo-container">
    <div class="wrapper">
        <input id="list-header" class="text-edit" type="text" data-id="{{$title['header_id']}}" value="{{$title['title']}}">
        <ul class="todo-list">
            @foreach($notes as $note)
                <li>
                    <input type="checkbox" value="{{$note->note_sequence}}">
                    <input
                        type="text" class="text-edit" value="{{$note->message}}"
                        data-parent="{{$title['header_id']}}" data-sequence="{{$note->note_sequence}}">
                </li>
            @endforeach
        </ul>
        <div class="action-container">
            <form class="action-row">
                <input id="message" type="text" name="content" placeholder="type your thoughts...">
                <button type="submit" id="btn-add">Add note</button>
            </form>
            <div class="action-row">
                <select name="" id="">
                </select>
                <button id="btn-delete" data-id="{{$title['header_id']}}">Archive</button>
            </div>
        </div>
    </div>
</div>

<x-small-setting/>

<script src="{{asset('/js/UI/header-edit.js')}}"></script>
<script src="{{asset('/js/UI/note-edit.js')}}"></script>
<script src="{{asset('/js/UI/note-add.js')}}"></script>
<script src="{{asset('/js/UI/note-archive.js')}}"></script>

</body>
</html>
