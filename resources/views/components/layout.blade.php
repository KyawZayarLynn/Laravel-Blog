<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Creative coder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="home">
    <x-navbar></x-navbar>
    @if (session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{session()->get('message')}}
    </div>
    @endif

    {{$slot}}

    <x-foot></x-foot>
    <script src="https://cdn.tiny.cloud/1/7oqrfurktyp3ueuv6e73at9yi8757fncggf2l9o9iiiqvxqz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>