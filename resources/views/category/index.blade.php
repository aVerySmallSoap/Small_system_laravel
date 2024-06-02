<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="x-csrf-token" content="{{csrf_token()}}">
    <meta name="category" content="{{$category}}">
    <link rel="stylesheet" href="{{asset('/css/app/category.css')}}">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/components/veil.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <title>Category</title>
</head>
<body>

    <x-navigation/>
    <div class="category-container">
        <div class="action">
            <button onclick="document.location.href = '/category/archive/{{$category}}'">Archive Category</button>
            <button id="btn-add">Add list</button>
        </div>
        @foreach($lists as $list)
            <div class="card-container" onclick="document.location.href = '/note/{{$list['header_id']}}'">
                <span class="header">{{$list['title']}}</span>
                <div class="action">
                    <div class="archive" data-note="{{$list['header_id']}}">Archive</div>
                </div>
            </div>
        @endforeach
    </div>

    <x-small-setting/>

    <script src="{{asset('/js/UI/category.js')}}"></script>
    <script src="{{asset('/js/UI/collections.js')}}"></script>
</body>
</html>
