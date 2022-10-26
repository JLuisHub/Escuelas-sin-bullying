<?php

namespace App\Http\Controllers\V1;
use App\Models\Reporte;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;


class ReporteAPIController extends Controller
{
    public function showEstudiante($id) {
        $datos = Reporte::where('id_estudiante',$id) -> get();

        return response() -> json($datos);
    }

    public function store(Request $request)
    {

        $reporte_temp = new Reporte();
        $reporte_temp->id_docente = $request->id_docente;
        $reporte_temp->id_estudiante = $request->id_estudiante;
        $reporte_temp->descripcion = $request->descripcion;
        $reporte_temp->fecha = $request->fecha;


        // Se notificara del reporte 
        $tutores_legales_encontrados = DB::table('estudiantes_tutores_legales')->where('id_estudiante', $request->id_estudiante)->get();
        
        if( empty($tutores_legales_encontrados[0]) ){
            
        }


        try{
            $reporte_temp->save();
            return "Guardado con éxito";
        }
        catch(exception $e){
            return "Hubo un problema al guardar los datos, intente más tarde";
        }

    }

    public function destroy(Request $request,Reporte $reporte)
    {
        $reporte = Reporte::destroy($id_reporte=($request->id_reporte));
        if($reporte == 0){
            return response() -> json("Hubo un error al eliminar el reporte, intente más tarde");
        }else{
            return response() -> json("Eliminado con éxito");
        }
    }

}
