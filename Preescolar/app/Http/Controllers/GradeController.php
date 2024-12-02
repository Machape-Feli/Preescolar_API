<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{

    public function index()
    {
        $calificacion = grade::get();
        return response()->json([ "datos" => $calificacion, "mensaje" => "Toma tus datos" ], 200 );

        /* $instalacion = Instalation::where("estado", "=", "activo")->get();
        return response()->json(['mensaje' => 'Instalaciones', 'Datos:' => $instalacion]); */
    }
            /* 
            $table->id('calificacionID');
            $table->string('nombreEstudiante');
            $table->foreignId('estudianteID');//foranea
            $table->double('primerBloque');
            $table->double('segundoBloque');
            $table->double('tercerBloque');
            $table->double('cuartoBloque');
            $table->double('quintoBloque');
            $table->double('sextoBloque');
            $table->double('calificacionFinal');
            $table->timestamps();
             */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'nombreEstudiante' => 'required|string|,
            'estudianteID' => 'required|exists:students,estudianteID',
            'primerBloque' => 'required|decimal:2',
            'segundoBloque' => 'nullable|decimal:2',
            'tercerBloque' => 'nullable|decimal:2',
            'cuartoBloque' => 'nullable|decimal:2',
            'quintoBloque' => 'nullable|decimal:2',
            'sextoBloque' => 'nullable|decimal:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error en la validación de los datos',
                'errores' => $validator->errors()
            ], 422);
        }

        $calificacion = new Grade();
        $calificacion->nombreEstudiante = "";
        $calificacion->estudianteID = $request->estudianteID;
        /* $calificacion-> = $request->;
        $calificacion-> = "";
        $calificacion-> = "activo";
        $calificacion-> = $request->claseID;
 */
        $calificacion->save();

        return response()->json([
            'Mensaje' => 'Calificacion registrada exitosamente',
            'Calificacion' => $calificacion
        ], 201);
    }

    public function show(Grade $calificacion)
    {
        
    }

    public function update(Request $request, Grade $calificacion)
    {
        
    }

    public function destroy(Grade $calificacion)
    {
        
    }

}
