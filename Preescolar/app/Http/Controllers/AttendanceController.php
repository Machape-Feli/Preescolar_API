<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{
    public function index()
    {
        $asistencia = Attendance::get();
        return response()->json([ "Datos" => $asistencia, "mensaje" => "Toma tus datos" ], 200 );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|unique:attendances',
            'estudianteID' => 'required|exists:students,id',
            'claseID' => 'required|exists:assignatures,claseID'
            //valida con ID la existencia de esa clase y estudiantes
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Mensaje' => 'Error en la validación de los datos',
                'Errores' => $validator->errors()
            ], 422);
        }

        $asistencia = new Attendance();
        $asistencia->fecha = $request->fecha;
        $asistencia->estudianteID = $request->estudianteID;
        $asistencia->claseID = $request->claseID;
        $asistencia->save();

        return response()->json([
            'Mensaje' => 'Asistencia creada exitosamente',
            'Asistencia' => $asistencia
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
