<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="x-csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('/css/verification.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a category</title>
</head>
<body>

    <div class="container">
        <form id="form-category">
            <span>Add a category</span>
            <div class="form-row">
                <label for="category">Category</label>
                <input type="text" name="category" id="category">
            </div>
            <div class="form-row">
                <button type="submit">Add</button>
            </div>
        </form>
    </div>

    <script src="{{asset('/js/category.js')}}"></script>

</body>
</html>
