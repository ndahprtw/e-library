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
            return view('pages.dashboard-user');
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