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
            <thead>
                <tr>
                    <td>Header</td>
                    <td>Message</td>
                    <td>Finished</td>
                    <td>Archived Date</td>
                </tr>
            </thead>
            <tbody>
            @if(!empty($notes))
                @foreach($notes as $note)
                    <tr>
                        <td>{{$note->header_id}}</td>
                        <td>{{$note->message}}</td>
                        <td>@if($note->note_isFinished === 1) true @else false @endif</td>
                        <td>{{$note->archived_At}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="crickets" colspan="4">There are nothing here but crickets</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="pagination">
            <span class="view">Total number of notes: {{$count->notes}}</span>
            @if($prev != 0)
                <div class="prev" onclick="document.location.href = '/archives/{{$prev}}'">prev</div>
            @endif
            @if($next != 1)
                <div class="next" @if($page == 1) style="margin-left: auto;" @endif
                     onclick="document.location.href = '/archives/{{$next}}'">
                    next
                </div>
            @endif
        </div>
    </div>
<x-small-setting/>

    <script src="{{asset('/js/UI/collections.js')}}"></script>

</body>
</html>
