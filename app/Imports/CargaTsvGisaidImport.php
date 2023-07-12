<?php

namespace App\Imports;

use App\Models\CargaGisaid;
use App\Models\Mapa;
use App\Models\TipoMuestreo;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;
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
                        $columna[] = 'Virus_name ("'.$row[0].'":Registro ya fue cargado anteriormente)';
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
                    $columna[] = 'Accession_id ("'.$row[1].'":Registro ya fue cargado anteriormente)';
                }
            }   
            
            $collection_date = null;
            if (!empty($row[2])) {
                $fecha = explode('-', $row[2]);
                if(count($fecha) == 3){
                    if (intval($fecha[0]) > 2000) {
                        /*$success = false;
                        $columna[] = 'Collection_date ('.$fecha[0].' No contiene el formato para el año "YYYY")';*/
                        if (intval($fecha[1]) < 12 && intval($fecha[1]) > 1) {
                            /*$success = false;
                            $columna[] = 'Collection_date ('.$fecha[1].' No contiene el formato correcto para el mes "MM")';*/
                            if (intval($fecha[2]) < 31 && intval($fecha[2]) > 1) {
                                $collection_date = $row[2];
                                /*$success = false;
                                $columna[] = 'Collection_date ('.$fecha[2].' No contiene el formato correcto para día "DD")';*/
                            }
                        }
                    }
                }
            }   
            
            if (!empty($row[3])) {
                $location = explode('/', $row[3]);

                if(count($location) <= 1){
                    $success = false;
                    $columna[] = 'Location ("'.$row[3].'":No contiene el formato correcto "Europe / Germany")';
                } else {
                    switch (count($location)) {
                        case 2:
                            $ubigeo = Mapa::where('nivel1', 'like', '%'.Str::upper(trim($location[1])).'%')
                            ->pluck('id')
                            ->first();
                            break;
                        case 3:
                            $ubigeo = Mapa::where('nivel1', 'like', '%'.Str::upper(trim($location[1])).'%')
                            ->where('nivel2', 'like', '%'.Str::upper(trim($location[2])).'%')
                            ->pluck('id')
                            ->first();
                            break;
                        
                        default:
                            $ubigeo = Mapa::where('nivel1', 'like', '%'.Str::upper(trim($location[1])).'%')
                            ->where('nivel2', 'like', '%'.Str::upper(trim($location[2])).'%')
                            ->where('nivel3', 'like', '%'.Str::upper(trim($location[3])).'%')
                            ->pluck('id')
                            ->first();
                            break;
                    }
                }
            } else {
                $success = false;
                $columna[] = 'Location ("'.$row[3].'":No puede estar vacio)';
            }
            
            if (!empty($row[7])) {
                $genders = ["MALE", "Male", "male", 'FEMALE', 'Female', 'female', 'UNKNOWN', 'Unknown', 'unknown'];
                if( !in_array($row[7], $genders) ){
                    $success = false;
                    $columna[] = 'Gender ("'.$row[7].'": No esta entre los valores aceptables: Male, Female, Unknown)';
                }
            }
            
            if ($row[8] != 0 && empty($row[8])) {
                $success = false;
                $columna[] = 'Patient_age ("'.$row[8].'":No puede estar vacio)';
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
                $gisaid->collection_date_text = $row[2];
                $gisaid->collection_date = $collection_date;
                $gisaid->ubigeo = $ubigeo;
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
