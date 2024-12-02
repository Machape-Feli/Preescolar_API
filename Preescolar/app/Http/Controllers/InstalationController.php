<?php

namespace App\Http\Controllers;

use App\Models\Instalation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class InstalationController extends Controller
{
    public function index()
    {
        $instalacion = Instalation::where("estado", "=", "activo")->get();
        return response()->json(['mensaje' => 'Instalaciones', 'Datos:' => $instalacion]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'ubicacion' => 'required|string|max:20',
            'imagen' => 'required|file|max:255',
            'salones' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $instalacion = new Instalation();
        $instalacion -> nombre = $request->nombre;
        $instalacion -> ubicacion = $request->ubicacion;
        $instalacion -> imagen = $request ->imagen;
        $instalacion -> salones = $request->salones;
        $instalacion -> estado = 'activo';

        $instalacion->save();

        if($request->hasFile('imagen')){
            $img=$request->imagen;
            $ext=$img->extension();
            $nuevo='instalacion' . $instalacion -> instalacionID .'.'. $ext;
            $ruta = $img->storeAs('imagenes/instalacion',$nuevo,'public');
            $instalacion->imagen=asset('storage/'.$ruta);
            $instalacion->save();
        }

        return response()->json([
            'Mensaje' => 'Instalacion creado exitosamente',
            'Instalacion' => $instalacion
        ], 201);
    }

    public function show(Instalation $instalacion)
    {
        $instalacion = Instalation::find($instalacion->instalacionID);

        if (!$instalacion) {
            return response()->json(["mensaje" => "Instalacion no encontrada"], 404);
        }

        return response()->json(["Datos " => $instalacion, " mensaje" => "Instalacion encontrado"], 200);
    }

    public function update(Request $request, Instalation $instalacion)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'ubicacion' => 'required|string|max:20',
            'imagen' => 'required|file|max:255',
            'salones' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $instalacion = Instalation::find($instalacion->instalacionID);
        if (!$instalacion) {
            return response()->json([
                'mensaje' => 'Instructor no encontrado'
            ], 404);
        }

        $instalacion->nombre = $request->nombre;
        $instalacion->ubicacion = $request->ubicacion;
        $instalacion->imagen = $request->imagen;
        $instalacion->salones = $request->salones;

        $instalacion->save();

        if($request->hasFile('imagen')){
            $img=$request->imagen;
            $ext=$img->extension();
            $nuevo='instalacion' . $instalacion -> instalacionID .'.'. $ext;
            $ruta = $img->storeAs('imagenes/instalacion',$nuevo,'public');
            $instalacion->imagen=asset('storage/'.$ruta);
            $instalacion->save();
        }

        return response()->json([
            'mensaje' => 'Instalacion actualizada exitosamente',
            'instalacion' => $instalacion
        ], 200);
    }

    public function destroy(Instalation $instalacion)
    {
        $instalacion = Instalation::find($instalacion->instalacionID);

        if (!$instalacion) {
            return response()->json(['mensaje' => 'Instalacion inexistente'], 404);
        }

        //$instalacion->delete();
        $instalacion -> estado = 'inactivo';
        $instalacion -> save();

        return response()->json(['mensaje' => 'Estudiante eliminado correctamente'], 200);
    }
}

