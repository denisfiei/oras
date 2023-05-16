<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class RowsImport implements ToCollection
{
    use Importable;

    protected $data;

    public function collection(Collection $rows)
    {
        unset($rows[0]);
        $total = count($rows);
        $this->data = compact('total');
    }

    public function getData()
    {
        return $this->data;
    }
}
