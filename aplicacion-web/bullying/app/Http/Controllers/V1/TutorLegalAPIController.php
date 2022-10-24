<?php

namespace App\Http\Controllers\V1;
use App\Models\Reporte;
use App\Http\Controllers\Controller;
use App\Models\EstudianteTutorLegal;
use App\Models\TutorLegal;
use Illuminate\Http\Request;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;


class TutorLegalAPIController extends Controller
{
    public function  store(Request $request){
        //Se valida que todos los datos se hayan enviado correctamente
        if($request->clave==null || $request->matricula== null ||
         $request->FechaNac== null || $request->id_tutor_legal==null  ){
            return response()->json( ['error' => 'Algunos datos están incompletos.' ], 400);
        }

        $tutor_legal = DB::table('tutores_legales')->where('id', $request->id_tutor_legal)->get();
        if( empty($tutor_legal[0]) ){ // Id de tutor invalido
            return response()->json( ['error' => 'El tutor no existe.' ], 400);
        }

        $alumno = DB::table('estudiantes')->where('FechaNac',$request->FechaNac)
        ->where('Matricula',$request->matricula)->where('clave',$request->clave)->get();

        if(empty($alumno[0]) ){ // Id de alumno invalido
            return response()->json( ['error' => 'El alumno no existe.' ], 400);
        }
        $alumno_tutor = DB::table('estudiantes_tutores_legales')->where('id_tutor_legal',$request->id_tutor_legal)->
        where('id_estudiante',$alumno[0]->id)->get();

        if(!empty($alumno_tutor[0])){ // Ya se relaciono el tutor con el alumno
            return response()->json( ['error' => 'Ya esta vinculado con usted.' ], 400);
        }

        $tutor_estudiante = new EstudianteTutorLegal();
        $tutor_estudiante -> id_tutor_legal = $request -> id_tutor_legal;
        $tutor_estudiante -> id_estudiante = $alumno[0]->id;
        try{
            $tutor_estudiante->save();
            return "Guardado con éxito";
        }
        catch(exception $e){
            return "Hubo un problema al guardar los datos, intente más tarde";
        }
    }
}
