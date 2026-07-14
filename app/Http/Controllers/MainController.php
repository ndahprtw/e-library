<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home() {
        $data = Book::with('category')->paginate(12);
        $kategori = Category::orderBy('nama_kategori')->get();
        return view('welcome', compact('data', 'kategori'));
    }

}
