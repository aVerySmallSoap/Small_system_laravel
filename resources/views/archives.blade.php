<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app/archives.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Archives</title>
</head>
<body>

    <div class="table-container">
        <table id="table-archive">
            <tbody>
            <tr>
                <th>Header</th>
                <th>Message</th>
                <th>Finished</th>
                <th>Archived Date</th>
            </tr>
            @foreach($notes as $note)
                <tr>
                    <td>{{$note->header_id}}</td>
                    <td>{{$note->message}}</td>
                    <td>@if($note->note_isFinished === 1) true @else false @endif</td>
                    <td>{{$note->archived_At}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<x-small-setting/>

    <script src="{{asset('/js/UI/collections.js')}}"></script>

</body>
</html>
