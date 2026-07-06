<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_peminjaman' => 'date',
            'tanggal_jatuh_tempo' => 'date',
            'tanggal_pengembalian' => 'date',
        ];
    }
    
    protected $fillable = [
        'book_id',
        'user_id',
        'tanggal_peminjaman',
        'tanggal_jatuh_tempo',
        'tanggal_pengembalian',
        'status'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
