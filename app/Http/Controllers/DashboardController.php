<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('User')) {
            $totalPeminjaman = Borrowing::where('user_id', auth()->user()->id)->count();
            $totalDipinjam = Borrowing::where('user_id', auth()->user()->id)->where('status', 'dipinjam')->count();
            $totalDikembalikan = Borrowing::where('user_id', auth()->user()->id)->where('status', 'dikembalikan')->count();
            $totalPengembalianTerlambat = Borrowing::where('user_id', auth()->user()->id)->where('status', 'terlambat')->count();
            $rekomendasiBuku = Book::withCount('borrows')
                ->with('category')
                ->orderByDesc('borrows_count')
                ->take(5)
                ->get();
            return view('pages.dashboard-user', compact('rekomendasiBuku', 'totalPeminjaman', 'totalDipinjam', 'totalDikembalikan', 'totalPengembalianTerlambat'));
        } else {

            // Card Dashboard
            $totalPetugas = User::role('Petugas')->count();
            $totalPengguna = User::role('User')->count();
            $totalKategori = Category::count();
            $totalBuku = Book::count();
            $totalPeminjaman = Borrowing::count();
            $totalTerlambat = Borrowing::where('status', 'terlambat')->count();
            $penggunaBaru = User::whereDate('created_at', today())->count();
    
            // Buku yang masih dipinjam
            $totalDipinjam = Borrowing::where('status', 'dipinjam')->count();
    
            $rasioKategori = Category::withCount('book')->get();
    
            $kategori = $rasioKategori->pluck('nama_kategori');
            $jumlahBuku = $rasioKategori->pluck('books_count');
    
            // Buku Terpopuler
            $bukuTerpopuler = Book::withCount('borrows')
                ->orderByDesc('borrows_count')
                ->take(2)
                ->get();
    
            // Peminjaman Hari Ini
            $peminjamanHariIni = Borrowing::with(['user', 'book'])
                ->whereDate('tanggal_peminjaman', today())
                ->latest()
                ->get();
    
            return view('pages.dashboard', compact(
                'totalPetugas',
                'totalPengguna',
                'totalKategori',
                'totalBuku',
                'totalTerlambat',
                'penggunaBaru',
                'totalPeminjaman',
                'totalDipinjam',
                'bukuTerpopuler',
                'peminjamanHariIni',
                'kategori',
                'jumlahBuku'
            ));
        }
    }
}