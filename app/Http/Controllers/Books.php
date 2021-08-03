<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Books extends Controller
{
    public function getBookData()
    {
        return \App\Models\Books::join('books_metas','books_metas.isbn','=', 'books.isbn')->get();
    }

    public function getAuthors()
    {
        return \App\Models\Books::all()->pluck('authors')->unique();
    }

    public function getCount(Request $request)
    {
        return \App\Models\Books::where('authors','=' ,$request->input('authorName'))->groupBy('authors')->selectRaw('sum(books_count) as count')->get();
    }

}
