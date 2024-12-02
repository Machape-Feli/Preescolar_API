<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TeacherController extends Controller
{
    public function index()
    {
        $Instructores = Teacher::where("estatus", "=", "activo")->get();
        return response()->json([ "datos" => $Instructores, "mensaje" => "Toma tus datos" ] , 200 );
/* 
        $instructor = Teacher::all();
        return response()->json($instructor);
 */
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellidoP' => 'required|string|max:20',
            'apellidoM' => 'required|string|max:20',
            'correo' => 'required|string|email|max:50|unique:teachers',//añadir unique
            'contrasena' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:10|unique:teachers',
            'imagen' => 'nullable|file|max:255',
            'rol' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $instructor = new Teacher();
        $instructor->nombre = $request->nombre;
        $instructor->apellidoP = $request->apellidoP;
        $instructor->apellidoM = $request->apellidoM;
        $instructor->correo = $request->correo;
        $instructor->contrasena = bcrypt($request->contrasena);
        $instructor->telefono = $request->telefono;
        $instructor->imagen = "";
        $instructor->rol = $request->rol;
        $instructor->estatus = "activo";

        $instructor->save();

        if($request->hasFile('imagen')){
            $img=$request->imagen;
            $ext=$img->extension();
            $nuevo = 'instructor_' . $instructor->instructorID . '.' . $ext;
            $ruta = $img->storeAs('imagenes/instructores', $nuevo, 'public');
            $instructor->imagen=asset('storage/'.$ruta);
            $instructor->save();
        }

        return response()->json([
            'Mensaje' => 'Instructor creado exitosamente',
            'Instructor' => $instructor
        ], 201);
    }

    public function show($id)
    {
        $instructor = Teacher::find($id);

        if (!$instructor) {
            return response()->json(["mensaje" => "Instructor no encontrado"], 404);
        }

        return response()->json(["datos" => $instructor, "mensaje" => "Instructor encontrado"], 200);
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:50',
        'apellidoP' => 'required|string|max:20',
        'apellidoM' => 'required|string|max:20',
        'correo' => 'required|string|email|max:50',
        'contrasena' => 'nullable|string|min:8',
        'telefono' => 'nullable|string|max:10',
        'imagen' => 'nullable|file|max:255',
        'rol' => 'required|string|max:20',
        'estatus' => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'mensaje' => 'Error en la validación de los datos',
            'errores' => $validator->errors()
        ], 422);
    }

    $instructor = Instructor::find($id);
    if (!$instructor) {
        return response()->json([
            'mensaje' => 'Instructor no encontrado'
        ], 404);
    }

    $instructor->nombre = $request->nombre;
    $instructor->apellidoP = $request->apellidoP;
    $instructor->apellidoM = $request->apellidoM;
    $instructor->correo = $request->correo;

    if ($request->filled('contrasena')) {
        $instructor->contrasena = bcrypt($request->contrasena);
    }

    $instructor->telefono = $request->telefono;
    //$instructor->imagen = "";
    $instructor->rol = $request->rol;
    $instructor->estatus = $request->estatus;

    $instructor->save();

    if($request->hasFile('imagen')){
        $img=$request->imagen;
        $ext=$img->extension();
        $nuevo='instructor_'.$instructor->id.'_1'.'.'.$ext;
        $ruta = $img->storeAs('imagenes/instructores',$nuevo,'public');
        $instructor->imagen=asset('storage/'.$ruta);
        $instructor->save();
    }

    return response()->json([
        'mensaje' => 'Instructor actualizado exitosamente',
        'instructor' => $instructor
    ], 200);
}


    public function destroy($id)
    {
        $instructor = Instructor::find($id);

        if (!$instructor) {
            return response()->json([
                'mensaje' => 'Instructor no encontrado'
            ], 404);
        }

        $instructor->delete();

        return response()->json([
            'mensaje' => 'Instructor eliminado correctamente'
        ], 200);
    }
}
