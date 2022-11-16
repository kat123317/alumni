<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ChartExport implements FromCollection, WithStrictNullComparison
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function new(array $data): ChartExport
    {
        return new self($data);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return collect($this->data);
    }
}
