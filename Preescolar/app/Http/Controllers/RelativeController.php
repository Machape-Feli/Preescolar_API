<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RelativeController extends Controller
{
    public function index()
    {
        $familiares = Relative::where("estatus", "=", "activo")->get();
        return response()->json([ "datos" => $familiares, "mensaje" => "Toma tus datos" ], 200 );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellidoP' => 'required|string|max:20',
            'apellidoM' => 'required|string|max:20',
            'correo' => 'required|string|email|max:50|unique:relatives',
            'contrasena' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:10',
            'imagen' => 'nullable|file|max:255',
            'estado' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $familiar = new Relative();
        $familiar->nombre = $request->nombre;
        $familiar->apellidoP = $request->apellidoP;
        $familiar->apellidoM = $request->apellidoM;
        $familiar->correo = $request->correo;
        $familiar->contrasena = bcrypt($request->contrasena);
        $familiar->telefono = $request->telefono;
        $familiar->imagen = "";
        $familiar->estado = 'activo';

        $familiar->save();

        if ($request->hasFile('imagen')) {
            $img = $request->imagen;
            $ext = $img->extension();
            $nuevo = 'familiar_' . $familiar->id . '_1' . '.' . $ext;
            $ruta = $img->storeAs('imagenes/familiares', $nuevo, 'public');
            $familiar->imagen = asset('storage/' . $ruta);
            $familiar->save();
        }

        return response()->json([
            'mensaje' => 'Familiar creado exitosamente',
            'familiar' => $familiar
        ], 201);
    }

    public function show(Relative $familiar)
    {
        $familiar = Relative::find($familiar->familiarID);

        if (!$familiar) {
            return response()->json(["mensaje" => "Familiar no encontrado"], 404);
        }

        return response()->json(["Datos " => $familiar, "mensaje" => "Familiar encontrado"], 200);
    }

    public function update(Request $request, Relative $familiar)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellidoP' => 'required|string|max:20',
            'apellidoM' => 'required|string|max:20',
            'correo' => 'required|string|email|max:50|unique:relatives',
            'contrasena' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:10',
            'imagen' => 'nullable|file|max:255',
            'estado' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $familiar = Relative::find($familiar->familiarID);

        if (!$familiar) {
            return response()->json(['mensaje' => 'Familiar no encontrado'], 404);
        }

        $familiar->nombre = $request->nombre;
        $familiar->apellidoP = $request->apellidoP;
        $familiar->apellidoM = $request->apellidoM;
        $familiar->correo = $request->correo;
        //$familiar->contrasena = bcrypt($request->contrasena);
        if ($request->filled('contrasena')) {
            $familiar->contrasena = bcrypt($request->contrasena);
        }
        $familiar->telefono = $request->telefono;
        $familiar->imagen = $request->imagen;

        $familiar->save();

        if ($request->hasFile('imagen')) {
            $img = $request->imagen;
            $ext = $img->extension();
            $nuevo = 'familiar_' . $familiar->id . '_1' . '.' . $ext;
            $ruta = $img->storeAs('imagenes/familiares', $nuevo, 'public');
            $familiar->imagen = asset('storage/' . $ruta);
            $familiar->save();
        }

        return response()->json([
            'mensaje' => 'Familiar actualizado exitosamente',
            'familiar' => $familiar
        ], 200);
    }

    public function destroy(Relative $familiar)
    {
        $familiar = Relative::find($familiar->familiarID);

        if (!$familiar) {
            return response()->json(['mensaje' => 'Familiar no encontrado'], 404);
        }

        //$familiar->delete();
        $familiar -> estado = 'inactivo';
        $familiar -> save();

        return response()->json(['mensaje' => 'Familiar eliminado correctamente'], 200);
    }
}
