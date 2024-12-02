<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index()
    {
        //consulta solo activos 
/*      $estudiantes = Student::where("estatus", "=", "activo")->get();
        return response()->json([ "datos" => $estudiantes, "mensaje" => "Toma tus datos" ], 200 );
*/  
        //prueba de consulta
        $estudiante = Student::get();
        return response()->json([ "datos" => $estudiante, "mensaje" => "Toma tus datos" ], 200 );

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellidoP' => 'required|string|max:20',
            'apellidoM' => 'required|string|max:20',
            'imagen' => 'nullable|file|max:255',
            'claseID' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $estudiante = new Student();
        $estudiante->nombre = $request->nombre;
        $estudiante->apellidoP = $request->apellidoP;
        $estudiante->apellidoM = $request->apellidoM;
        $estudiante->imagen = "";
        $estudiante->estatus = "activo";
        $estudiante->claseID = $request->claseID;

        $estudiante->save();

        if($request->hasFile('imagen')){
            $img=$request->imagen;
            $ext=$img->extension();
            $nuevo='estudiante'.$estudiante->estudianteID.'.'.$ext;
            $ruta = $img->storeAs('imagenes/estudiante',$nuevo,'public');
            $estudiante->imagen=asset('storage/'.$ruta);
            $estudiante->save();
        }

        return response()->json([
            'Mensaje' => 'Estudiante creado exitosamente',
            'Estudiante' => $estudiante
        ], 201);
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(["mensaje" => "Estudiante no encontrado"], 404);
        }

        return response()->json(["datos" => $estudiante, "mensaje" => "Estudiante encontrado"], 200);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(["mensaje" => "Estudiante no encontrado"], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'nullable|string|max:50',
            'apellidoP' => 'nullable|string|max:20',
            'apellidoM' => 'nullable|string|max:20',
            'imagen' => 'nullable|string|max:255',
            'estatus' => 'nullable|string|max:20',
        ]);

        $estudiante->nombre = $validatedData['nombre'] ?? $estudiante->nombre;
        $estudiante->apellidoP = $validatedData['apellidoP'] ?? $estudiante->apellidoP;
        $estudiante->apellidoM = $validatedData['apellidoM'] ?? $estudiante->apellidoM;

        $estudiante->imagen = $validatedData['imagen'] ?? $estudiante->imagen;
        $estudiante->estatus = $validatedData['estatus'] ?? $estudiante->estatus;

        $estudiante->save();

        return response()->json(["datos" => $estudiante, "mensaje" => "Estudiante actualizado correctamente"], 200);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['mensaje' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();

        return response()->json(['mensaje' => 'Estudiante eliminado correctamente'], 200);
    }
}
