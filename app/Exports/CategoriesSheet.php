<?php

namespace App\Exports;

use App\Models\Category;
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

class CategoriesSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        return Category::with(['book'])->get();
    }

    public function title(): string
    {
        return 'Kategori';
    }

    public function headings(): array
    {
        return [
            'Kategori',
            'Jumlah Buku Terkait',
        ];
    }

    public function map($category): array
    {
        return [
            $category->nama_kategori,
            $category->book->count(),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header
        $sheet->getStyle('A1:B1')->applyFromArray([
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
        $sheet->getStyle('A1:B' . $sheet->getHighestRow())
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ]);

        // Rata tengah vertikal
        $sheet->getStyle('A:B')
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Nomor urut rata tengah
        $sheet->getStyle('A:A')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tahun rata tengah
        $sheet->getStyle('B:B')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }
}
