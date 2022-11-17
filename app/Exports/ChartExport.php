<?php

namespace App\Exports;

use App\Exports\Sheets\SurveyDataSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class ChartExport implements WithMultipleSheets
{
    use Exportable;
    public array $datas;
    public array $titles;

    public function __construct(array $datas, array $titles)
    {
        $this->datas = $datas;
        $this->titles = $titles;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /* public function collection()
    {
        return [collect($this->data), collect($this->data)];
    } */

    public function sheets(): array
    {
        $sheets = [];
        for ($i = 0; $i < count($this->datas); $i++) {
            $sheets[] = new SurveyDataSheet($this->datas[$i], $this->titles[$i]);
        }
        return $sheets;
    }
}
