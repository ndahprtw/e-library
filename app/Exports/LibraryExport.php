<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LibraryExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new BooksSheet(),
            new CategoriesSheet(),
            new BorrowingsSheet(),
        ];
    }
}