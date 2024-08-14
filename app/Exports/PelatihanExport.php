<?php

namespace App\Exports;

use App\Models\Pelatihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PelatihanExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }


    public function collection()
    {
        $startDate = $this->data['start_date'];
        $endDate = $this->data['end_date'];
        $query = Pelatihan::with(['golongan','mata_pelatihan','pengajar']);
        
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
        
        $pelatihan = $query->get();
        return $pelatihan->map(function ($item) {
            return [
                'no' => $item->id,
                'tanggal' => $item->tanggal instanceof \Carbon\Carbon ? $item->tanggal->format('d/m/Y') : $item->tanggal,
                'waktu' => $item->start_time.' - '.$item->end_time,
                'nama' => $item->pengajar?->nama_pengajar,
                'uraian' => $item->mata_pelatihan?->mata_pelatihan,
                'golongan' => $item->golongan ? $item->golongan->nama : 'N/A',
                'jml_jp' => $item->jml_jp,
                'tarif_jp' => $item->tarif_jp,
                'jumlah_bruto' => $item->jumlah_bruto,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Waktu',
            'Nama',
            'Uraian',
            'Golongan',
            'Jumlah JP',
            'Tarif JP',
            'Jumlah Bruto',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Set width of columns
            'A' => ['width' => 5],
            'B' => ['width' => 15],
            'C' => ['width' => 20],
            'D' => ['width' => 30],
            'E' => ['width' => 30],
            'F' => ['width' => 15],
            'G' => ['width' => 15],
            'H' => ['width' => 15],
            'I' => ['width' => 20],

            // Set font bold for the header
            1 => ['font' => ['bold' => true]],

            // Set borders for the entire sheet
            'A1:I1' => ['borders' => [
                'outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]],

            // Format columns
            'G' => ['numberFormat' => ['formatCode' => '#,##0']], // Format untuk Jumlah JP
            'H' => ['numberFormat' => ['formatCode' => '#,##0']], // Format untuk Tarif JP
            'I' => ['numberFormat' => ['formatCode' => '#,##0']], // Format untuk Jumlah Bruto
        ];
    }

    public function title(): string
    {
        return 'Daftar Pelatihan';
    }
}