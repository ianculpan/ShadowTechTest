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
        <p class="items-center m-1 p-2 rounded-md bg-gray-200">Menu</p>
        <ul class="min-w-full">
            <li class="min-w-full mt-3 mb-3">
                <router-link class="flex-auto min-w-full items-center m-1 p-2 rounded-md bg-gray-200" active-class="font-bold"
                             to="/" exact>Search&nbsp;Books
                </router-link>
            </li>
            <li class="min-w-full mt-3 mb-3">
                <router-link class="min-w-full items-center m-1 p-2 rounded-md bg-gray-200" active-class="font-bold"
                             to="/authorcount">Author&nbsp;Count
                </router-link>
            </li>
        </ul>
    </div>
    <div class="pl-2 bg-gray-200 flex w-5/6">
        <router-view></router-view>
    </div>
    <hr>
</div>
<script src="/js/app.js"></script>
</body>
</html>
