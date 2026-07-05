<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BooksSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Book::with(['category'])->get();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Kategori',
            'Tahun Terbit',
            'Penulis',
            'Penerbit',
            'Stok Tersedia'
        ];
    }

    public function title(): string
    {
        return 'Buku';
    }

    public function map($book): array
    {
        return [
            $book->judul,
            $book->category->nama_kategori,
            $book->tahun_terbit,
            $book->penulis,
            $book->penulis,
            $book->stock
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '28A745',
                ],
            ],
        ]);

        // Border seluruh tabel
        $sheet->getStyle('A1:F' . $sheet->getHighestRow())
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ]);

        // Rata tengah vertikal
        $sheet->getStyle('A:F')
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Nomor urut rata tengah
        $sheet->getStyle('A:A')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tahun rata tengah
        $sheet->getStyle('F:F')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }
}