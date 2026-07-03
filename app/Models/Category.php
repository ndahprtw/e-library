<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['nama_kategori'];

    public function book()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}
