<?php

namespace App\Imports;

use App\Models\CargaDetalle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;

class CargaDetalleImport implements OnEachRow, WithChunkReading, WithStartRow
{
    use Importable;

    public $duplicados = [], $total = 0, $total_error = 0, $carga = 0, $fecha = '';

    public function __construct($carga)
    {
        $this->carga = $carga;
        //$this->fecha = date('Y-m-d H:i:s');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = array_map('trim', $row->toArray());
        
        $collection_date = null;
        if ($row[2]) {
            $collection_date = $this->transformDateTime($row[2]);
        }

        $gisaid = new CargaDetalle();
        $gisaid->carga_id = $this->carga;
        $gisaid->virus_name = $row[0];
        $gisaid->accession_id = $row[1];
        $gisaid->collection_date = $collection_date;
        $gisaid->location = $row[3];
        $gisaid->host = $row[4];
        $gisaid->additional_location_information = $row[5];
        $gisaid->sampling_strategy = $row[6];
        $gisaid->gender = $row[7];
        $gisaid->patient_age = $row[8];
        $gisaid->patient_status = $row[9];
        $gisaid->last_vaccinated = $row[10];
        $gisaid->passage = $row[11];
        $gisaid->specimen = $row[12];
        $gisaid->additional_host_information = $row[13];
        $gisaid->lineage = $row[14];
        $gisaid->clade = $row[15];
        $gisaid->aa_substitutions = $row[16];
        $gisaid->save();

        $this->total += 1;
    }

    public function getData()
    {
        return [
            'total' => $this->total,
            'total_error' => $this->total_error,
            'duplicados' => $this->duplicados,
        ];
    }

    private function transformDateTime(string $value, string $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
