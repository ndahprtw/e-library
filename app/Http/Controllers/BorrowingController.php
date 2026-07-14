<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Notifications\BookAvailableNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view borrow', only: ['index']),
            new Middleware('permission:borrow books', only: ['create']),
            new Middleware('permission:return books', only: ['update']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('User')) {
            $data = Borrowing::with(['book', 'user'])->where('user_id', Auth::user()->id)->orderBy('tanggal_peminjaman', 'desc')->get();
        } else {
            $data = Borrowing::with(['book', 'user'])->orderBy('tanggal_peminjaman', 'desc')->get();
        }
        return view('pages.borrowing.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $book = Book::findOrFail($request['book_id']);

            if ($book->stok <= 0) {
                return redirect()->route('peminjaman.index')->with('error', 'Stok buku habis.');
            }

            $book->decrement('stok');

            Borrowing::create([
                'tanggal_peminjaman' => now(),
                'tanggal_jatuh_tempo' => now()->addDays(7),
                'user_id' => Auth::user()->id,
                'book_id' => $book->id,
                'status' => 'dipinjam',
            ]);
        });

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dipinjam.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {

        DB::transaction(function () use ($borrowing) {
            $book = Book::with('reminders.user')->findOrFail($borrowing->book_id);
            $book->increment('stok');

            if($borrowing->tanggal_jatuh_tempo < now()) {
                $borrowing->update([
                    'tanggal_pengembalian' => now(),
                    'status' => 'terlambat',
                ]);
            } else {
                $borrowing->update([
                    'tanggal_pengembalian' => now(),
                    'status' => 'dikembalikan',
                ]);
            }

             foreach ($book->reminders as $reminder) {
                $reminder->user->notify(
                    new BookAvailableNotification($book)
                );

                $reminder->delete();
            }

        });

        return redirect()->route('peminjaman.index')->with('success', 'Buku yang dipinjam berhasil dikembalikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }

    public function read($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back();
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $periode = Carbon::create()->month((int) $bulan)->translatedFormat('F') . ' ' . $tahun;

        $data = Borrowing::whereMonth('tanggal_peminjaman', $bulan)
            ->whereYear('tanggal_peminjaman', $tahun)
            ->with('book.category')
            ->get();

        $pdf = Pdf::loadView('pages.borrowing.download', compact('data', 'periode'))
            ->setPaper('a4', 'portrait'); 
        return $pdf->stream('laporan-peminjaman-' . now()->format('d-m-Y') . '.pdf');
    }
}
