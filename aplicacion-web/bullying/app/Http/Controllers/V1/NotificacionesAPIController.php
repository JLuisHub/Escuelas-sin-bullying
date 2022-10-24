<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificacionesAPIController extends Controller
{
    //
    public function getNotificacionesReportes($id_tutor_legal){
        //Extrae todos los estudiantes relacionados con él tutor legal.
        $tutores_estudiantes = DB::table('estudiantes_tutores_legales')->where('id_tutor_legal',$id_tutor_legal)->get(); 
        $tam = count($tutores_estudiantes)-1;
        $notificaciones = array();
        $tamArrey=0;
        for($i=$tam; $i>=0; $i--){
            //Extrae los reportes de ese tutor
            $reportes =DB::table('reportes')->where('id_estudiante',$tutores_estudiantes[$i]->id_estudiante)->get();
            $tam2 = count($reportes);
            for($j=0; $j<$tam2; $j++){
                //Nombre del estudiante
                $nombreEstu = DB::table('estudiantes')->where('id',$reportes[$j]->id_estudiante)->get();
                //Nombre del docente
                $nombreDoc = DB::table('docentes')->where('id',$reportes[$j]->id_docente)->get();
                $asunto = "reporte";
                $tamArrey+=$j;
                //Genera la notificación del reporte
                $notificaciones[$tamArrey] = array(
                    "id"=> $reportes[$j]->id ,
                    "asunto"=> $asunto ,
                    "descripcion"=>$nombreEstu[0]->Nombre." ".$nombreEstu[0]->Apaterno." ".$nombreEstu[0]->Amaterno.
                    " tiene un reporte del profesor: ".$nombreDoc[0]->Nombre." ".$nombreDoc[0]->Apaterno." ".$nombreDoc[0]->Amaterno,   
                );
            }
        }
        return response() -> json($notificaciones);
    }


    public function getNotificacionesCitatorio($id_tutor_legal){
        //Extrae todos los alumnos vinculados a él
        $tutores_estudiantes = DB::table('estudiantes_tutores_legales')->where('id_tutor_legal',$id_tutor_legal)->get(); 
        $tam = count($tutores_estudiantes)-1;
        $notificaciones = array();
        $tamArrey=0;
        for($i=0; $i<$tam; $i++){
            //Extrae todos los citatorios
            $citatorios =DB::table('citatorios')->where('id_estudiante',$tutores_estudiantes[$i]->id_estudiante)->get();
            $tam2 = count($citatorios);
            for($j=0; $j<$tam2; $j++){
                //Nombre del docente
                $nombreDoc = DB::table('docentes')->where('id',$citatorios[$j]->id_docente)->get();
                $asunto = "citatorio";
                $tamArrey+=$j;
                //Genera la notificación del citatorio
                $notificaciones[$tamArrey] = array(
                    "id"=> $citatorios[$j]->id ,
                    "asunto"=> $asunto ,
                    "descripcion"=>"Tienes un citatorio del profesor: ".$nombreDoc[0]->Nombre." ".$nombreDoc[0]->Apaterno." ".$nombreDoc[0]->Amaterno,   
                );
            }
        }
        return response() -> json($notificaciones);
    }
}