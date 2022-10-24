<?php

namespace App\Http\Controllers\V1;
use App\Models\Reporte;
use App\Http\Controllers\Controller;
use App\Models\Citatorio;
use App\Models\Docentes;
use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;


class ReporteAPIController extends Controller
{

    public function store(Request $request)
    {
        //  Valido que el estudiante citado y el profesor esten registrados dentro de la misma escuela
        //  Busco en la base de datos si existe el Id de docente
        $profesor_encontrado = DB::table('docentes')->where('id', $request->id_docente)->get();

        if( empty($profesor_encontrado[0]) ){ // Id de profesor invalido
            return response()->json( ['error' => 'id de profesor invalido.' ], 400);
        }

        //  Busco en la base de datos si existe el Id del estudiante
        $estudiante_encontrado = DB::table('estudiantes')->where('id', $request->id_estudiante)->get();
        if( empty($estudiante_encontrado[0]) ){ // Id de estudiante invalido
            return response()->json( ['error' => 'id de estudiante invalido.' ], 400);
        }

        //  Valido que tanto el profesor como el estudiante citado esten registrados en la misma escuela.
        if( $profesor_encontrado[0]->clave != $estudiante_encontrado[0]->clave ){
            return response()->json( ['error' => 'El alumno y el profesor no pertenecen a la misma escuela' ], 400);
        }

        $reporte_temp = new Reporte();
        $reporte_temp->id_docente = $request->id_docente;
        $reporte_temp->id_estudiante = $request->id_estudiante;
        $reporte_temp->descripcion = $request->descripcion;
        $reporte_temp->fecha = $request->fecha;
        try{
            $reporte_temp->save();
            return "Guardado con éxito";
        }
        catch(exception $e){
            return "Hubo un problema al guardar los datos, intente más tarde";
        }

    }

   /* public function showAll($id_estudiante)
    {
        $datos = Reporte::all() -> where('id_estudiante',$id_estudiante);
        return response() -> json($datos);
    }*/

    public function showReporte($id_reporte)
    {
        $datos = Reporte::all() -> where('id',$id_reporte);
        $nombreEst = (Estudiantes::get() -> where('id',$datos[0]->id_estudiante));
        $nombreDoc = (Docentes::get() -> where('id',$datos[0]->id_docente));
        $descripcion = $datos[0]->descripcion;
        $fecha = $datos[0]->fecha;
        $reporte[0] = array(
            "Nombre_estudiante"=> $nombreEst[0]->Nombre ,
            "Nombre_doc"=> $nombreDoc[0]->Nombre,
            "descripcion"=> $descripcion,
            "fecha"=> $fecha,
        );
        return response() -> json($reporte);
    }

    public function destroy(Request $request,Reporte $reporte)
    {
        $reporte = Reporte::destroy($id_reporte=($request->id_reporte));
        if($reporte == 0){
            return "Hubo un error al eliminar el reporte, intente más tarde";
        }else{
            return "Eliminado con éxito";
        }
    }

}
