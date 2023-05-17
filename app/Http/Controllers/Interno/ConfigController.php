<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Config;
use App\Models\Secondary\Item;

class ConfigController extends Controller
{
    public function index()
    {
        return view('sistema.interno.config');
    }

    public function buscar(Request $request)
    {
        $config = Config::first();

        return [
            'config' => $config,
        ];
    }

    public function update(Request $request)
    {
        $request->replace($this->null_string($request->all()));
        
        $this->validate($request, [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:255',
            'telefono_1' => 'required|max:9',
            'whatsapp' => 'max:12',
            'dominio' => 'required|max:50',
            /*'nombre_bd' => 'required|max:50',
            'usuario_bd' => 'required|max:50',
            'clave_bd' => 'required|max:50',*/
        ]);

        try {

            DB::beginTransaction();

            $config = Config::first();

            if ($request->hasFile('logo')) {
                $anterior = $config->logo;

                $file = $request->file('logo');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'logo_'.time().'.'.$extension;
                Storage::putFileAs('public/', $file, $fileContent);
                Storage::delete('public/'.$anterior);

                $config->logo = $fileContent;
            }

            if ($request->hasFile('logo_login')) {
                $anterior2 = $config->logo_login;

                $file2 = $request->file('logo_login');
                $fileName2 = $file2->getClientOriginalName();
                $extension2 = $file2->getClientOriginalExtension();
                $fileContent2 = 'logo_login_'.time().'.'.$extension2;
                Storage::putFileAs('public/', $file2, $fileContent2);
                Storage::delete('public/'.$anterior2);

                $config->logo_login = $fileContent2;
            }

            $config->nombre = $request->nombre;
            $config->descripcion = $request->descripcion;
            $config->direccion = $request->direccion;
            $config->codigo_tel = '+51';
            $config->telefono_1 = $request->telefono_1;
            $config->telefono_2 = $request->telefono_2;
            $config->whatsapp = $request->whatsapp;
            $config->email = Str::lower($request->email);
            $config->facebook = $request->facebook;
            $config->twitter = $request->twitter;
            $config->instagram = $request->instagram;
            $config->youtube = $request->youtube;
            $config->user_id = Auth::user()->id;
            $config->save();

            $this->update_cache($config);

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'Los datos se actualizaron con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar los datos, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    private function store_cache($config)
    {
        Cache::forever('config_cache', $config);

        return;
    }

    private function update_cache($config)
    {
        if( Cache::has('config_cache') ) {

            Cache::forget('config_cache');
            
            Cache::forever('config_cache', $config);

            return;
        }

        $this->store_cache($config);

        return;
    }

    public function null_string($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) && $value === 'null') {
                $data[$key] = null;
            }
        }

        return $data;
    }
}
