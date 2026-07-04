<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Book::query()
            ->with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul', 'like', "%{$request->search}%");
            })
            ->orderBy('judul')
            ->paginate(5);
        return view('pages.book.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Category::orderBy('nama_kategori')->get();
        return view('pages.book.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('cover')) {
            $gambar = $request->file('cover');
            $imageName = $request->judul .'.' . $gambar->extension();
            $gambar->move(public_path('assets/images/cover-buku/'), $imageName);
        } else {
            $imageName = null;
        }


        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'cover' => $imageName
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // return view('pages.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $kategori = Category::orderBy('nama_kategori')->get();
        return view('pages.book.edit', compact('book', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

         if ($request->hasFile('cover')) {
            // Hapus file foto sebelumnya dari penyimpanan
            if ($book->cover && file_exists(public_path('assets/images/cover-buku/' . $book->cover))) {
                unlink(public_path('assets/images/cover-buku/' . $book->cover));
            }
            $book_image = $request->file('cover');
            $imageName = $request->judul .'.' . $book_image->extension();
            $book_image->move(public_path('assets/images/cover-buku/'), $imageName);    
        } else {
            $imageName = $book->cover;
        }

        $book->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'cover' => $imageName
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && file_exists(public_path('assets/images/cover-buku/'.$book->cover))) {
            unlink(public_path('assets/images/cover-buku/'.$book->cover));
        }

        $book->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
