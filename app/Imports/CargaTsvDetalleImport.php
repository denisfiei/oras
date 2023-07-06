<?php

namespace App\Imports;

use App\Models\CargaDetalle;
use App\Models\CargaGisaid;
use App\Models\TipoMuestreo;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;

class CargaTsvDetalleImport implements OnEachRow, WithChunkReading, WithStartRow
{
    use Importable;

    public $errors = [], $total = 0, $total_error = 0, $carga = [], $fecha = '';

    public function __construct($carga)
    {
        $this->carga = $carga;
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
        
        try {
            $success = true;
            $columna = [];

            if (empty($row[0])) {
                $success = false;
                $columna[] = 'Virus_name (No puede estar vacio)';
            } else {
                if (CargaDetalle::where('virus_name', $row[0])->where('activo', 'S')->first()) {
                    $success = false;
                    $columna[] = 'Virus_name (Registro ya fue cargado anteriormente)';
                } else {
                    if (!CargaGisaid::where('virus_name', $row[0])->where('activo', 'S')->first()) {
                        $success = false;
                        $columna[] = 'Virus_name (No existe registro en el archivo GISAID)';
                    }
                }
            }

            if (empty($row[1])) {
                $success = false;
                $columna[] = 'Id_pais (No puede estar vacio)';
            } 
            
            if (empty($row[2])) {
                $success = false;
                $columna[] = 'Kit_ct (No puede estar vacio)';
            } 
            
            if (empty($row[4])) {
                if ($row[4] != 0) {
                    $success = false;
                    $columna[] = 'Ct (No puede estar vacio)';
                }
            } else {
                if (!is_numeric($row[4])) {
                    $success = false;
                    $columna[] = 'Ct (Debe ser un número)';
                }
            }
            
            if (!empty($row[5])) {
                if (!is_numeric($row[5])) {
                    $success = false;
                    $columna[] = 'Ct2 (Debe ser un número o vacio)';
                }
            }
           
            if ($row[7]) {
                if ($row[7] != 'SI' && $row[7] != 'NO') {
                    $success = false;
                    $columna[] = '1Dosis (Debe ser "SI, NO o Vacio")';
                }
            }
            
            if ($row[8]) {
                if ($row[8] != 'SI' && $row[8] != 'NO') {
                    $success = false;
                    $columna[] = '2Dosis (Debe ser "SI, NO o Vacio")';
                }
            }
            
            if ($row[10]) {
                if ($row[10] != 'SI' && $row[10] != 'NO') {
                    $success = false;
                    $columna[] = '3Dosis (Debe ser "SI, NO o Vacio")';
                }
            }
            
            if ($row[12]) {
                if ($row[12] != 'SI' && $row[12] != 'NO') {
                    $success = false;
                    $columna[] = '4Dosis (Debe ser "SI, NO o Vacio")';
                }
            }
            
            $tipo_muestreo = null;
            if (!$tipo_muestreo = TipoMuestreo::where('nombre', $row[13])->where('activo', 'S')->pluck('id')->first()) {
                $success = false;
                $columna[] = 'Tipo_muestreo ("'.$row[13].'": No existe en los registros)';
            }
            /*if (!empty($row[13])) {
                if ($row[13] != 'VIGILANCIA ALEATORIA' && $row[13] != 'FOCALIZADA' && $row[13] != 'ESPECIAL') {
                    $success = false;
                    $columna[] = 'Tipo_muestreo (No se encuentra entre los datos aceptables)';
                }
            }*/

            if ($row[16]) {
                $fecha = explode('-', $row[16]);
                // if(count($fecha) < 3 && !checkdate($fecha[1], $fecha[2], $fecha[0])){
                if(count($fecha) < 3){
                    $success = false;
                    $columna[] = 'Corrida ("'.$row[16].'": No contiene el formato correcto "YYYY-MM-DD")';
                }
            } 

            if (empty($row[18])) {
                $success = false;
                $columna[] = 'Fecha_ingreso_sistema (No puede estar vacio)';
            } else {
                $fecha_sis = explode('-', $row[18]);
                if(count($fecha_sis) < 3 && !checkdate($fecha_sis[1], $fecha_sis[2], $fecha_sis[0])){
                    $success = false;
                    $columna[] = 'Fecha_ingreso_sistema (No contiene el formato correcto "YYYY-MM-DD")';
                }
            }

            if (empty($row[19])) {
                $success = false;
                $columna[] = 'Coverage (No puede estar vacio)';
            } 
            
            if (empty($row[20])) {
                $success = false;
                $columna[] = 'N_percentage (No puede estar vacio)';
            } else {
                if ($row[20] < 0 || $row[20] > 1) {
                    $success = false;
                    $columna[] = 'N_percentage (Debe ser un número > 0 y <=1)';
                }
            }

            if ($row[21]) {
                if ($row[21] != 'SI' && $row[21] != 'NO') {
                    $success = false;
                    $columna[] = 'Asintomático (Debe ser "SI, NO o Vacio")';
                }
            }
            
            if ($row[23]) {
                if ($row[23] != 'SI' && $row[23] != 'NO') {
                    $success = false;
                    $columna[] = 'Comorbilidad (Debe ser "SI, NO o Vacio")';
                } elseif($row[23] == 'SI') {
                    if (empty($row[24])) {
                        $success = false;
                        $columna[] = 'Listar_comorbilidad (Si Comorbilidad es SI, este campo no puede estar vacio)';
                    } 
                }
            }

            if ($success) {
                /*$fecha_muestra = null;
                $fecha_sistema = null;
                if ($row[6]) {
                    $fecha_muestra = $this->transformDateTime($row[6], 'Y-m-d');
                }
                if ($row[21]) {
                    $fecha_sistema = $this->transformDateTime($row[21], 'Y-m-d H:i:s');
                }*/
    
                $detalle = new CargaDetalle();
                $detalle->carga_id = $this->carga->id;
                $detalle->virus_id = $this->carga->virus_id;
                $detalle->pais_id = $this->carga->pais_id;
                $detalle->virus_name = $row[0];
                $detalle->id_pais = $row[1];
                $detalle->kit_ct = $row[2];
                $detalle->gen = $row[3];
                $detalle->ct = $row[4];
                $detalle->ct2 = $row[5];
                $detalle->marca_dosis_1 = $row[6];
                $detalle->dosis_1 = $row[7];
                $detalle->dosis_2 = $row[8];
                $detalle->marca_dosis_3 = $row[9];
                $detalle->dosis_3 = $row[10];
                $detalle->marca_dosis_4 = $row[11];
                $detalle->dosis_4 = $row[12];
                $detalle->dosis_5 = 'NO';
                $detalle->tipo_muestreo_id = $tipo_muestreo;
                $detalle->numeracion_placa = $row[14];
                $detalle->placa = $row[15];
                $detalle->corrida = $row[16];
                $detalle->verificado = $row[17];
                $detalle->fecha_sistema = $row[18];
                $detalle->coverage = $row[19];
                $detalle->n_percentage = $row[20];
                $detalle->asintomatico = $row[21];
                $detalle->sintomas = $row[22];
                $detalle->comorbilidad = $row[23];
                $detalle->lista_comorbilidad = $row[24];
                $detalle->user_id = Auth::user()->id;
                $detalle->save();
    
                $this->total += 1;
            } else {
                $this->total_error += 1;
    
                $this->errors[] = [
                    'fila' => $rowIndex,
                    'error' => $columna
                ];
            }

        } catch (\Exception $e) {
            $this->total_error += 1;

            $this->errors[] = [
                'fila' => $rowIndex,
                'error' => [$e->getMessage()]
            ];
        }
    }

    public function getData()
    {
        return [
            'total' => $this->total,
            'total_error' => $this->total_error,
            'errors' => $this->errors,
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
