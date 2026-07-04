<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $data = Category::query()
            ->with('book')
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_kategori', 'like', "%{$request->search}%");
            })
            ->orderBy('nama_kategori')
            ->paginate(5);
        return view('pages.category.index', compact('data'));
    }

    public function create() {
        return view('pages.category.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|unique:categories'
        ]);

        Category::insert([
            'nama_kategori' => $request->nama_kategori
        ]);


        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }   

    public function show(Category $category) {
        $book = Book::with('category')->where('category_id', $category->id)->get();
        return view('pages.category.show', compact('category', 'book'));
    }

    public function edit(Category $category) {
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }           

    public function destroy($id) {
        $data = Category::findOrFail($id);
        $data->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
