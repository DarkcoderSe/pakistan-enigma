<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CandidateExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    protected $candidates;

    public function __construct(array $candidates)
    {
        $this->candidates = $candidates;
    }

    public function array(): array
    {
        return $this->candidates;
    }

    public function headings(): array
    {
        return ["Name", "Phone Number", "Email"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 33,
            'B' => 33,
            'C' => 33
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
