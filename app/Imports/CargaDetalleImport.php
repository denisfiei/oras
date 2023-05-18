<?php

namespace App\Imports;

use App\Models\CargaDetalle;
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

    public $duplicados = [], $total = 0, $total_error = 0, $carga = 0, $muestreo = 0, $fecha = '';

    public function __construct($carga, $muestreo)
    {
        $this->carga = $carga;
        $this->muestreo = $muestreo;
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
        
        $fecha_muestra = null;
        $fecha_sistema = null;
        if ($row[6]) {
            $fecha_muestra = $this->transformDateTime($row[6], 'Y-m-d');
        }
        if ($row[20]) {
            $fecha_sistema = $this->transformDateTime($row[20], 'Y-m-d H:i:s');
        }

        $gisaid = new CargaDetalle();
        $gisaid->carga_id = $this->carga;
        $gisaid->tipo_muestreo_id = 1;
        $gisaid->codigo = $row[0];
        $gisaid->codigo_pais = $row[1];
        $gisaid->kit_ct = $row[2];
        $gisaid->gen = $row[3];
        $gisaid->ct = $row[4];
        $gisaid->ct2 = $row[5];
        $gisaid->fecha_muestra = $fecha_muestra;
        $gisaid->edad = $row[7];
        $gisaid->sexo = $row[8];
        $gisaid->vacunado = $row[9];
        $gisaid->dosis_1 = $row[10];
        $gisaid->dosis_2 = $row[11];
        $gisaid->dosis_3 = $row[12];
        $gisaid->dosis_4 = $row[13];
        $gisaid->dosis_5 = $row[14];
        $gisaid->hospitalizacion = $row[15];
        $gisaid->fallecido = $row[16];
        $gisaid->numero_placa = $row[17];
        $gisaid->placa = $row[18];
        $gisaid->corrida = $row[19];
        $gisaid->fecha_sistema = $fecha_sistema;
        $gisaid->cobertura = $row[21];
        $gisaid->cobertura_porcentaje = $row[22];
        $gisaid->asintomatico = $row[23];
        $gisaid->sintomas = $row[24];
        $gisaid->comorbilidad = $row[25];
        $gisaid->comorbilidad_lista = $row[26];
        $gisaid->user_id = Auth::user()->id;
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

    private function transformDateTime(string $value, string $format)
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
