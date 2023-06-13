<?php

namespace App\Imports;

use App\Models\CargaGisaid;
use App\Models\TipoMuestreo;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;

class CargaTsvGisaidImport implements OnEachRow, WithChunkReading, WithStartRow
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
                $text_ini = explode('/', $row[0]);
                if ($text_ini[0] === "hCoV-19") {
                    if (CargaGisaid::where('virus_name', $row[0])->where('activo', 'S')->first()) {
                        $success = false;
                        $columna[] = 'Virus_name (Registro ya fue cargado anteriormente)';
                    }
                } else {
                    $success = false;
                    $columna[] = 'Virus_name (No inicia con "hCoV-19")';
                }
            }
            
            if (empty($row[1])) {
                $success = false;
                $columna[] = 'accession_id (No puede estar vacio)';
            } else {
                if (CargaGisaid::where('accession_id', $row[1])->where('activo', 'S')->first()) {
                    $success = false;
                    $columna[] = 'Accession_id (Registro ya fue cargado anteriormente)';
                }
            }   
            
            if (!empty($row[2])) {
                $fecha = explode('-', $row[2]);
                if(count($fecha) < 3 && !checkdate($fecha[1], $fecha[2], $fecha[0])){
                    $success = false;
                    $columna[] = 'Collection_date (No contiene el formato correcto "YYYY-MM-DD")';
                }
            }   
            
            if (!empty($row[3])) {
                $location = explode('/', $row[3]);
                if(count($location) == 1){
                    $success = false;
                    $columna[] = 'Location (No contiene el formato correcto "Europe / Germany")';
                }
            }
            
            if (!empty($row[7])) {
                if($row[7] !== 'Male' && $row[7] !== 'Female' && $row[7] !== 'Unknown'){
                    $success = false;
                    $columna[] = 'Gender (No esta entre los valores aceptables: Male, Female, Unknown)';
                }
            }
            
            if ($row[8] != 0 && empty($row[8])) {
                $success = false;
                $columna[] = 'Patient_age (No puede estar vacio)';
            }
            
            if (empty($row[9])) {
                $success = false;
                $columna[] = 'Patient_status (No puede estar vacio)';
            }
            
            if (empty($row[11])) {
                $success = false;
                $columna[] = 'Passage (No puede estar vacio)';
            }
            
            if (empty($row[14])) {
                $success = false;
                $columna[] = 'Lineage (No puede estar vacio)';
            }
            
            if (empty($row[15])) {
                $success = false;
                $columna[] = 'Clade (No puede estar vacio)';
            }
            
            if (empty($row[16])) {
                $success = false;
                $columna[] = 'AA_Substitutions (No puede estar vacio)';
            }

            if ($success) {
                $gisaid = new CargaGisaid();
                $gisaid->carga_id = $this->carga->id;
                $gisaid->virus_id = $this->carga->virus_id;
                $gisaid->pais_id = $this->carga->pais_id;
                $gisaid->virus_name = $row[0];
                $gisaid->accession_id = $row[1];
                $gisaid->collection_date = $row[2];
                $gisaid->location = $row[3];
                $gisaid->host = $row[4];
                $gisaid->additional_location_information = $row[5];
                $gisaid->sampling_strategy = $row[6];
                $gisaid->gender = $row[7];
                $gisaid->patient_age = (is_numeric($row[8]) ? $row[8] : 0);
                $gisaid->patient_status = $row[9];
                $gisaid->last_vaccinated = $row[10];
                $gisaid->passage = $row[11];
                $gisaid->specimen = $row[12];
                $gisaid->additional_host_information = $row[13];
                $gisaid->lineage = $row[14];
                $gisaid->clade = $row[15];
                $gisaid->aa_substitutions = $row[16];
                $gisaid->user_id = Auth::user()->id;
                $gisaid->save();
    
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
                'error' => $e->getMessage()
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
