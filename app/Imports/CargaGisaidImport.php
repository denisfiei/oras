<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Sede;
use App\Models\Dependencia;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;

class CargaGisaidImport implements OnEachRow, WithChunkReading, WithHeadingRow
{
    use Importable;

    public $duplicados = [], $total = 0, $total_error = 0;

    public function chunkSize(): int
    {
        return 100;
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = array_map('trim', $row->toArray());
        $fecha = date('Y-m-d H:i:s');

        if (!$sede = Sede::where('x_nombre', $row['sede'])->first()) {
            $sede = new Sede();
            $sede->c_codigo = Str::upper($row['codigo']);
            $sede->x_nombre = Str::upper($row['sede']);
            $sede->x_departamento = 'LIMA';
            $sede->x_provincia = Str::upper($row['provincia']);
            $sede->import_at = $fecha;
            $sede->save();
        } 

        if (!Dependencia::where('sede_id', $sede->id)->where('x_nombre', $row['dependencia'])->first()) {
            $dependencia = new Dependencia();
            $dependencia->sede_id = $sede->id;
            //$dependencia->c_codigo = Str::upper($row['codigo']);
            $dependencia->x_nombre = Str::upper($row['dependencia']);
            $dependencia->x_tag = $row['tag'];
            $dependencia->import_at = $fecha;
            $dependencia->save();
        } else {

            $this->total += 1;
            $this->total_error += 1;
            $this->duplicados[] = [
                'fila' => $rowIndex,
                'nombre' => $row['dependencia']
            ];
        }
    }

    public function getData()
    {
        return [
            'total' => $this->total,
            'total_error' => $this->total_error,
            'duplicados' => $this->duplicados,
        ];
    }
}
