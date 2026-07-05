<?php

namespace App\Exports;

use App\Models\Borrowing;
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

class BorrowingsSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Borrowing::with(['user','book'])->get();
    }

    public function title(): string
    {
        return 'Peminjaman';
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Kategori',
            'Peminjam',
            'Tanggal Peminjaman',
            'Tanggal Jatuh Tempo',
            'Tanggal Pengembalian',
            'Status'
        ];
    }

    public function map($borrowing): array
    {
        return [
            $borrowing->book->judul,
            $borrowing->book->category->nama_kategori,
            $borrowing->user->name,
            $borrowing->tanggal_peminjaman,
            $borrowing->tanggal_jatuh_tempo,
            $borrowing->tanggal_pengembalian ?? 'belum melakukan pengembalian',
            $borrowing->status
        ];
    }

        public function styles(Worksheet $sheet)
    {
        // Header
        $sheet->getStyle('A1:G1')->applyFromArray([
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
        $sheet->getStyle('A1:G' . $sheet->getHighestRow())
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ]);

        // Rata tengah vertikal
        $sheet->getStyle('A:G')
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Nomor urut rata tengah
        $sheet->getStyle('A:A')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tahun rata tengah
        $sheet->getStyle('F:G')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Stok rata tengah
        $sheet->getStyle('G:G')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }
}
