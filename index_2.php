<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>{{config('app.name','LSAPP')}}</title>


</head>
<body>
@include('include/navbar')
<div class="container">
    @include('include/messages')
    @yield('content')

</div>

{{--ovoa e kopirano od laravel ckeditor--}}
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>

</body>
</html>
