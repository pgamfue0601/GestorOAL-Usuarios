<?php

namespace App\Imports;

use App\Models\UsuarioOAL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithStartRow;

HeadingRowFormatter::default('none');

class UsuarioOALImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, SkipsEmptyRows, WithValidation, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use SkipsErrors;

    public function model(array $row)
    {
        
        return new UsuarioOAL([
            'nombre' => $row['Nombre'],
            'apellidos' => $row['Apellidos'],
            'sexo' => $row['Sexo'],
            'dni'=> $row['DNI/NIE'],
            'fecha_activacion' => date('d/m/Y', (($row['Fecha_activacion'] - 25569) * 86400)),
            'edad' => date('d/m/Y', (($row['Edad'] - 25569) * 86400)),
            'telefono' => $row['Telefono'],
            'ocupacion' => $row['Ocupacion'],
            'ocupacion2' => $row['Ocupacion2'],
            'ocupacion3' => $row['Ocupacion3'],
            'discapacidad' => $row['Discapacidad'],
            'nivel_estudios' => $row['Nivel_estudios'],
            'especialidad' => $row['Especialidad'],
            'disponibilidad' => $row['Disponibilidad'],
            'carnet' => $row['Carnet'],
            'vehiculo' => $row['Vehiculo'],
            'localidad' => $row['Localidad'],
            'observaciones' => $row['Observaciones'],
            'programa_oal' => $row['Programa_oal'],
            'año_programa_oal' => (int)$row['year_programa'],
            'programa_oal_2' => $row['Programa_oal_2'],
            'año_programa_oal_2' => (int)$row['year_programa_2'],
            'programa_oal_3' => $row['Programa_oal_3'],
            'año_programa_oal_3' => (int)$row['year_programa_3'],
        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }

    public function onError(\Throwable $e)
    {
        \Log::error('Error al importar la fila: ' . $e->getMessage());
    }

    public function rules(): array 
    {
        return [
            '*.DNI/NIE' => [
                'required',
                'regex:/\d{8}[A-Z]|[A-Z]\d{8}/'
            ],
            '*.Telefono' => [
                'required',
                'regex:/^\d{9}$/'
            ],
            '*.Fecha_activacion' => [
                'required',
                'integer'
            ],
            '*.Edad' => [
                'required',
                'integer'
            ],
            '*.Sexo' => [
                'required',
                'in:Hombre,Mujer,No binario, Otro'
            ],
            '*.Nombre' => [
                'required',
            ],
            '*.Apellidos' => [
                'required',
            ],
            '*.Ocupacion' => [
                'required',
            ],
            '*.Telefono' => [
                'required',
            ],
            '*.Discapacidad' => [
                'required',
            ],
            '*.Nivel_estudios' => [
                'required',
            ],
            '*.Especialidad' => [
                'required',
            ],
            '*.Disponibilidad' => [
                'required',
            ],
            '*.Carnet' => [
                'required',
            ],
            '*.Vehiculo' => [
                'required',
            ],
            '*.Localidad' => [
                'required',
            ],
        ];
    }

    public function headingRow(): int
    {
        return 2;
    }
}
