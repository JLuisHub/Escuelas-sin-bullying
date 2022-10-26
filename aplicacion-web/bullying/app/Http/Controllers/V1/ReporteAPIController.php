<?php

namespace App\Http\Controllers\V1;
use App\Models\Reporte;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ReporteAPIController extends Controller
{
    public function store(Request $request)
    {
        // Validamos que el estudiante reportado tenga asociados a al menos 1 tutor legal. 
        $tutores_legales_encontrados = DB::table('estudiantes_tutores_legales')->where('id_estudiante', $request->id_estudiante)->get();
        
        if( empty($tutores_legales_encontrados[0]) ){
            return response()->json( ['error' => 'El estudiante seleccionado no tiene ningun tutor legal asignado.' ], 400);
        }

        foreach( $tutores_legales_encontrados as $tutor_legal ){

            $reporte_temp = new Reporte();
            $reporte_temp->id_docente = $request->id_docente;
            $reporte_temp->id_estudiante = $request->id_estudiante;
            $reporte_temp->id_tutor_legal = $tutor_legal->id_tutor_legal;
            $reporte_temp->descripcion = $request->descripcion;
            $reporte_temp->fecha = $request->fecha;

            // Intentamos guardar el nuevo registro en la base de datos.
            try{
                $reporte_temp->save();
            } catch(exception $e) {
                return response()->json([
                    'error' => 'ocurrio un error al guardar el reporte',
                ], 400);
            }
        }

        return response()->json([
            'mensaje' => 'Se ha creado el reporte exitosamente',
        ], Response::HTTP_OK);

    }

    public function destroy(Request $request,Reporte $reporte)
    {
        // Se obtiene obtine una respuesta al intentar eliminar un reporte
        $reporte = Reporte::destroy($id_reporte=($request->id_reporte));
        
        // Se compara el resultado obtenido
        if($reporte == 0){
            return "Hubo un error al eliminar el reporte, intente más tarde";
        }else{
            return "Eliminado con éxito";
        }
    }

    public function showEstudiante($id) {
        $datos = Reporte::all() -> where('id_estudiante',$id);
        return response() -> json($datos);
    }

}
