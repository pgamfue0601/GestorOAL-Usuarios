<?php

namespace App\Http\Controllers;

use App\Models\UsuarioOAL;
use App\Http\Requests\StoreUsuarioOALRequest;
use App\Http\Requests\UpdateUsuarioOALRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\DocumentosUsuariosController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsuarioOALImport;

class UsuarioOALController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = UsuarioOAL::orderBy('id', 'desc')->paginate(10);
        $contadorUsuarios = UsuarioOAL::all()->count();
        return inertia("Dashboard", [
            "usuariosOAL" => $usuarios,
            "contadorUsuarios" => $contadorUsuarios
        ]);
    }

    public function search()
    {
        return inertia("Search");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $usuario = UsuarioOAL::create($request->all());

        return response()->json(['usuario' => $usuario]);

    }

    /**
     * Display the specified resource.
     */
    public function show(UsuarioOAL $usuarioOAL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsuarioOAL $usuarioOAL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $usuarioOAL = UsuarioOAL::find($id);
        $usuarioOAL->update($request->all());
    }

    public function updateThroughSearch($id, Request $request)
    {
        $usuarioOAL = UsuarioOAL::find($id);
        $usuarioOAL->update($request->all());
        return to_route('search');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuarioOAL = UsuarioOAL::find($id);
        DocumentosUsuariosController::destroyAllDocsUser($usuarioOAL->id);
        $usuarioOAL->delete();
        return to_route('dashboard');
    }

    //Funcion para recoger la edad
    public function getEdad($id) {
        $edad = \DB::table('usuario_o_a_l_s')->where('id', $id)->value('edad');

        return response()->json(['edad' => $edad]);
    }

    public function getFechaActivacion($id) {
        $fecha = \DB::table('usuario_o_a_l_s')->where('id', $id)->value('fecha_activacion');

        return response()->json(['fecha_activacion' => $fecha]);
    }

    public function getSpecialties($id) {
        $specialties = \DB::table('usuario_o_a_l_s')->where('id', $id)->value('especialidad');

        return response()->json(['especialidades' => $specialties]);
    }

    public function getCarnet($id) {
        $carnet = \DB::table('usuario_o_a_l_s')->where('id', $id)->value('carnet');

        return response()->json(['carnet' => $carnet]);
    }

    public function createPDF(){
        $usuarios = UsuarioOAL::latest()->get();
        $pdf = Pdf::loadView('pdf', ['usuarios' => $usuarios, 'fromSearch' => false]);
        return $pdf->download('usuariosListado.pdf');
    }

    public function createPdfFromSearch(Request $request){
        $usuarios = $request->all();
        $pdf = Pdf::loadView('pdf', ['usuarios' => $usuarios, 'fromSearch' => true]);
        return $pdf->download('usuariosBusqueda.pdf');
    }

    public function searchUsers(Request $request){
        $search = $request->all()['newData'];
        $edadData = $request->all()['edadData'];
        $usuarios = UsuarioOAL::query();
        if (isset($search['nombre']) && !empty($search['nombre'])) {
            $usuarios->where('nombre', 'like', '%'.$search['nombre'].'%');
        }
        if (isset($search['apellidos']) && !empty($search['apellidos'])) {
            $usuarios->where('apellidos', 'like', '%'.$search['apellidos'].'%');
        }
        if (isset($search['telefono']) && !empty($search['telefono'])) {
            $usuarios->where('telefono', 'like', '%'.$search['telefono'].'%');
        }
        if (isset($search['dni']) && !empty($search['dni'])) {
            $usuarios->where('dni', 'like', '%'.$search['dni'].'%');
        }
        if (isset($search['edad']) && !empty($search['edad'])) {
            switch ($search['edad']) {
                case 'menor':
                    $usuarios->where(function($query) use ($edadData) {
                        $query->whereRaw("STR_TO_DATE(edad, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL ? YEAR)", [$edadData['edadNumero']]);
                    });
                    break;
                case 'mayor':
                    $usuarios->where(function($query) use ($edadData) {
                        $query->whereRaw("STR_TO_DATE(edad, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL ? YEAR)", [$edadData['edadNumero']]);
                    });
                    break;
                case 'entre':
                    $usuarios->where(function($query) use ($edadData) {
                        $query->whereRaw("STR_TO_DATE(edad, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL ? YEAR)", [$edadData['minEdad']])
                              ->whereRaw("STR_TO_DATE(edad, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL ? YEAR)", [$edadData['maxEdad']]);
                    });
                    break;
                default:
                    break;
            }
        }
        if (isset($search['ocupacion']) && !empty($search['ocupacion'])) {
            $usuarios->where('ocupacion', 'like', '%'.$search['ocupacion'].'%');
        }
        if (isset($search['ocupacion2']) && !empty($search['ocupacion2'])) {
            $usuarios->where('ocupacion2', 'like', '%'.$search['ocupacion2'].'%');
        }
        if (isset($search['ocupacion3']) && !empty($search['ocupacion3'])) {
            $usuarios->where('ocupacion3', 'like', '%'.$search['ocupacion3'].'%');
        }
        if (isset($search['nivel_estudios']) && !empty($search['nivel_estudios'])) {
            $usuarios->where('nivel_estudios', 'like', '%'.$search['nivel_estudios'].'%');
        }
        if (isset($search['especialidad']) && !empty($search['especialidad'])) {
            foreach ($search['especialidad'] as $key => $value) {
                $usuarios->where('especialidad', 'like', '%'.$value.'%');
            }
        }
        if (isset($search['disponibilidad']) && !empty($search['disponibilidad'])) {
            $usuarios->where('disponibilidad', 'like', '%'.$search['disponibilidad'].'%');
        }
        if (isset($search['carnet']) && !empty($search['carnet'])) {
            foreach ($search['carnet'] as $key => $value) {
                $usuarios->where('carnet', 'like', '%'.$value.'%');
            }
        }
        if (isset($search['localidad']) && !empty($search['localidad'])) {
            $usuarios->where('localidad', 'like', '%'.$search['localidad'].'%');
        }
        if (isset($search['observaciones']) && !empty($search['observaciones'])) {
            $usuarios->where('observaciones', 'like', '%'.$search['observaciones'].'%');
        }
        if (isset($search['discapacidad']) && !empty($search['discapacidad'])) {
            $usuarios->where('discapacidad', 'like', '%'.$search['discapacidad'].'%');
        }
        if (isset($search['sexo']) && !empty($search['sexo'])) {
            $usuarios->where('sexo', 'like', '%'.$search['sexo'].'%');
        }
        if (isset($search['fecha_activacion']) && !empty($search['fecha_activacion'])) {
            $usuarios->where('fecha_activacion', 'like', '%'.$search['fecha_activacion'].'%');
        }
        if (isset($search['programa_oal']) && !empty($search['programa_oal'])) {
            $usuarios->where('programa_oal', 'like', '%'.$search['programa_oal'].'%');
        }
        if (isset($search['programa_oal_2']) && !empty($search['programa_oal_2'])) {
            $usuarios->where('programa_oal_2', 'like', '%'.$search['programa_oal_2'].'%');
        }
        if (isset($search['programa_oal_3']) && !empty($search['programa_oal_3'])) {
            $usuarios->where('programa_oal_3', 'like', '%'.$search['programa_oal_3'].'%');
        }
        if (isset($search['año_programa_oal']) && !empty($search['año_programa_oal'])) {
            $usuarios->where('año_programa_oal', 'like', '%'.$search['año_programa_oal'].'%');
        }
        if (isset($search['año_programa_oal_2']) && !empty($search['año_programa_oal_2'])) {
            $usuarios->where('año_programa_oal_2', 'like', '%'.$search['año_programa_oal_2'].'%');
        }
        if (isset($search['año_programa_oal_3']) && !empty($search['año_programa_oal_3'])) {
            $usuarios->where('año_programa_oal_3', 'like', '%'.$search['año_programa_oal_3'].'%');
        }
        if (isset($search['vehiculo']) && !empty($search['vehiculo'])) {
            $usuarios->where('vehiculo', 'like', '%'.$search['vehiculo'].'%');
        }
        $usuarios->orderBy('created_at', 'desc');

        $result = $usuarios->paginate(10);
        return response()->json(['usuarios' => $result, 'contador' => $usuarios->count(), 'usuariosPDF' => $usuarios->get()]);
    }

    public function importExcel(Request $request) {
        $files = $request->file();
        foreach ($files as $file) {
            try {
                //Si el archivo tiene algun error, no se completará la importación.
                Excel::import(new UsuarioOALImport, $file);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
     
                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                    $failure->values(); // The values of the row that has failed.
                }
            }
        }
        // return to_route('dashboard');
    }
}