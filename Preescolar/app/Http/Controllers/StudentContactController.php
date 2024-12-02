<?php

namespace App\Http\Controllers;

use App\Models\StudentContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentContactController extends Controller
{
    public function index()
    {
        $contacto = StudentContact::where("estado", "=", "activo")->get();
        return response()->json(['mensaje' => 'Contactos', 'Datos:' => $contacto]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estudianteID' => 'required|integer',
            'familiarID' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $contacto = new StudentContact();
        $contacto -> estudianteID = $request->estudianteID;
        $contacto -> familiarID = $request->familiarID;
        $contacto -> estado = 'activo';

        $contacto->save();

        return response()->json([
            'Mensaje' => 'Contacto creado exitosamente',
            'Contacto' => $contacto
        ], 201);
    }

    public function show(StudentContact $contacto)
    {
        $contacto = StudentContact::find($contacto->contactoID);

        if (!$contacto) {
            return response()->json(["mensaje" => "Contacto no encontrada"], 404);
        }

        return response()->json(["Datos " => $contacto, " mensaje" => "Contacto encontrado"], 200);
    }

    public function update(Request $request, StudentContact $contacto)
    {
        $validator = Validator::make($request->all(), [
            'estudianteID' => 'required|integer',
            'familiarID' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $contacto = StudentContact::find($contacto->contactoID);
        if (!$contacto) {
            return response()->json([
                'mensaje' => 'Instructor no encontrado'
            ], 404);
        }

        $contacto -> estudianteID = $request->estudianteID;
        $contacto -> familiarID = $request->familiarID;
        $contacto -> estado = 'activo';

        $contacto->save();

        return response()->json([
            'mensaje' => 'Contacto actualizada exitosamente',
            'Contacto' => $contacto
        ], 200);
    }

    public function destroy(StudentContact $contacto)
    {
        $contacto = StudentContact::find($contacto->contactoID);

        if (!$contacto) {
            return response()->json(['mensaje' => 'Contacto inexistente'], 404);
        }

        //$contacto->delete();
        $contacto -> estado = 'inactivo';
        $contacto -> save();

        return response()->json(['mensaje' => 'Contacto eliminado correctamente'], 200);
    }
}
