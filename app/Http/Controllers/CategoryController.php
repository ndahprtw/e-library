<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return [
            new Middleware('permission:view categories', only: ['index', 'show']),
            new Middleware('permission:create categories', only: ['create', 'store']),
            new Middleware('permission:edit categories', only: ['edit', 'update']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }

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

    public function show(Request $request, Category $category) {
        $book = Book::query()
                ->with('category')
                ->where('category_id', $category->id)
                ->when($request->search, function ($query) use ($request) {
                    $query->where('judul', 'like', "%{$request->search}%");
                })
                ->orderBy('judul')
                ->get();
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
