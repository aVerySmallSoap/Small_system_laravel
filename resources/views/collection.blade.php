<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="x-csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app/collection.css')}}">
    <link rel="stylesheet" href="{{asset('/css/components/veil.css')}}">
    <title>Collection</title>
</head>
<body>

    <x-navigation/>
    <div class="collection-container">
        @foreach($notes as $note)
            <div class="card-container" onclick="document.location.href = '/note/{{$note['header_id']}}'">
                <span class="header">{{$note['title']}}</span>
                <div class="action">
                    <div class="archive" data-note="{{$note['header_id']}}">Archive</div>
                </div>
            </div>
        @endforeach
    </div>
    <x-small-setting/>

    <script src="{{asset('/js/UI/collections.js')}}"></script>

</body>
</html>
