<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'category_id',
        'cover'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
