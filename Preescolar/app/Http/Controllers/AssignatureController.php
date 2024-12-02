<?php

namespace App\Http\Controllers;

use App\Models\Assignature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AssignatureController extends Controller
{
    public function index()
    {
        $clase = Assignature::get();
        return response()->json([ "datos" => $clase, "mensaje" => "Toma tus datos" ], 200 );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'grupo' => 'required|string|max:10',
            'salon' => 'required|string|max:20',
            'turno' => 'required|string|max:20',
            'instructorID' => 'required|integer',
            //valida con ID del instructor para ligarla
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $clase = new Assignature();
        $clase->nombre = $request->nombre;
        $clase->grupo = $request->grupo;
        $clase->salon = $request->salon;
        $clase->turno = $request->turno;
        $clase->estado = 'activo';
        $clase->instructorID = $request->instructorID;

        $clase->save();

        return response()->json([
            'Mensaje' => 'Clase creada exitosamente',
            'Instructor de la clase' => $clase->Teacher->nombre ?? 'no asignado',
            'Clase' => $clase
        ], 201);
    }

    public function show(Assignature $clase)
    {
        $clase = Assignature::find($clase->claseID);

        if (!$clase) {
            return response()->json(["mensaje" => "Clase no encontrada"], 404);
        }

        return response()->json(["datos" => $clase, "mensaje" => "Clase encontrada"], 200);
    }

    public function update(Request $request, Assignature $clase)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'grupo' => 'required|string|max:10',
            'salon' => 'required|string|max:20',
            'turno' => 'required|string|max:20',
            'instructorID' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $clase = Assignature::find($clase->claseID);

        if (!$clase) {
            return response()->json(['mensaje' => 'Clase no encontrada'], 404);
        }

        $clase->nombre = $request->nombre;
        $clase->grupo = $request->grupo;
        $clase->salon = $request->salon;
        $clase->turno = $request->turno;
        $clase->estado = 'activo';
        $clase->instructorID = $request->instructorID;

        $clase->save();

        return response()->json([
            'mensaje' => 'Clase actualizado exitosamente',
            'familiar' => $clase
        ], 200);
    }

    public function destroy(Assignature $clase)
    {
        $clase = Assignature::find($clase->claseID);

        if (!$clase) {
            return response()->json(['mensaje' => 'Clase no encontrada'], 404);
        }

        //$clase->delete();
        $clase -> estado = 'inactivo';
        $clase -> save();

        return response()->json(['mensaje' => 'Clase eliminada correctamente'], 200);
    }
}



