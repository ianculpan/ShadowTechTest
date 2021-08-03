<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Books Test</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<div id="app">
    <div class="h-screen float-left w-1/6 bg-gray-400">
        <ul>
            <router-link class="p-2" to = "/">Search&nbsp;Books</router-link>
            <router-link class="p-2" to = "/authorcount">Author&nbsp;Count</router-link>
        </ul>
    </div>
    <div class="bg-gray-200 flex w-5/6">
        <router-view></router-view>
    </div>
    <hr>
</div>
<script src="/js/app.js"></script>
</body>
</html>
