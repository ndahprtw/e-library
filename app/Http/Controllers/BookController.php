<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class BookController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view books', only: ['index', 'show']),
            new Middleware('permission:create books', only: ['create', 'store']),
            new Middleware('permission:edit books', only: ['edit', 'update']),
            new Middleware('permission:delete books', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('User')) {

            $data = Book::query()
                ->with('category')
                ->when($request->search, function ($query) use ($request) {
                    $query->where('judul', 'like', "%{$request->search}%");
                })
                ->orderBy('judul')
                ->get();
            $kategori = Category::orderBy('nama_kategori')->get();
            return view('pages.book.index-user', compact('data', 'kategori'));

        } else {

            $data = Book::query()
                ->with('category')
                ->when($request->search, function ($query) use ($request) {
                    $query->where('judul', 'like', "%{$request->search}%");
                })
                ->orderBy('judul')
                ->paginate(5);
            return view('pages.book.index-admin', compact('data'));

        }
        
        
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
    public function store(StoreBookRequest $request)
    {

        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('books', 'public');
        }


        Book::create([
            'judul' => $request->validated('judul'),
            'penulis' => $request->validated('penulis'),
            'penerbit' => $request->validated('penerbit'),
            'tahun_terbit' => $request->validated('tahun_terbit'),
            'stok' => $request->validated('stok'),
            'category_id' => $request->validated('category_id'),
            'cover' => $cover,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('pages.book.show', compact('book'));
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
    public function update(UpdateBookRequest $request, Book $book)
    {

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $cover = $request->file('cover')->store('books', 'public');
        } else {
            $cover = $book->cover;
        }   

        $book->update([
            'judul' => $request->validated('judul'),
            'penulis' => $request->validated('penulis'),
            'penerbit' => $request->validated('penerbit'),
            'tahun_terbit' => $request->validated('tahun_terbit'),
            'stok' => $request->validated('stok'),
            'category_id' => $request->validated('category_id'),
            'cover' => $cover,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    /**
     * Export PDF using laravel-dompdf.
     */
    public function exportPdf()
    {
        $data = Book::with('category')->get();
        $pdf = Pdf::loadView('pages.book.download', compact('data'))
            ->setPaper('a4', 'portrait'); //untuk set uk ukuran kertas dan orientasi

        // // jika ingin langsung mendownload file PDF
        // return $pdf->download('laporan-buku-' . now()->format('d-m-Y') . '.pdf');

        // jika ingin menampilkan preview PDF
        return $pdf->stream('laporan-buku-' . now()->format('d-m-Y') . '.pdf');
    }
}
