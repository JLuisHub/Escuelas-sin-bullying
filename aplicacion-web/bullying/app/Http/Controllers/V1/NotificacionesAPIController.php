<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificacionesAPIController extends Controller
{
    public function getNotificacionesReportes($id_tutor_legal){
        //Extrae todos los estudiantes relacionados con el tutor legal.
        $tutoresEstudiantes = DB::table('estudiantes_tutores_legales')->where('id_tutor_legal',$id_tutor_legal)->get(); 
        $numeroDeEstudiantes = count($tutoresEstudiantes)-1;
        $notificaciones = array();
        $tamArrey=0;

        for($posicionEstudiante=$numeroDeEstudiantes; $posicionEstudiante>=0; $posicionEstudiante--){
            //Extrae los reportes de ese tutor
            $reportes = DB::table('reportes')->where('id_estudiante',$tutoresEstudiantes[$posicionEstudiante]->id_estudiante)->get();
            $numeroReportesEstudianteActual = count($reportes);

            for($posReporteActual=0; $posReporteActual<$numeroReportesEstudianteActual; $posReporteActual++){
                //Nombre del estudiante
                $nombreEstu = DB::table('estudiantes')->where('id',$reportes[$posReporteActual]->id_estudiante)->get();
                //Nombre del docente
                $nombreDoc = DB::table('docentes')->where('id',$reportes[$posReporteActual]->id_docente)->get();
                $asunto = "reporte";
                $tamArrey+=$posReporteActual;
                //Genera la notificación del reporte
                $notificaciones[$tamArrey] = array(
                    "id"=> $reportes[$posReporteActual]->id ,
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
        $tutoresEstudiantes = DB::table('estudiantes_tutores_legales')->where('id_tutor_legal',$id_tutor_legal)->get(); 
        $numeroDeEstudiantes = count($tutoresEstudiantes)-1;
        $notificaciones = array();
        $tamArrey=0;

        for($posEstudiante=0; $posEstudiante<$numeroDeEstudiantes; $posEstudiante++){
            //Extrae todos los citatorios
            $citatorios =DB::table('citatorios')->where('id_estudiante',$tutoresEstudiantes[$posEstudiante]->id_estudiante)->get();
            $numeroCitatorios = count($citatorios);
            for($posCitatorio=0; $posCitatorio<$numeroCitatorios; $posCitatorio++){
                //Nombre del docente
                $nombreDoc = DB::table('docentes')->where('id',$citatorios[$posCitatorio]->id_docente)->get();
                $asunto = "citatorio";
                $tamArrey+=$posCitatorio;
                //Genera la notificación del citatorio
                $notificaciones[$tamArrey] = array(
                    "id"=> $citatorios[$posCitatorio]->id ,
                    "asunto"=> $asunto ,
                    "descripcion"=>"Tienes un citatorio del profesor: ".$nombreDoc[0]->Nombre." ".$nombreDoc[0]->Apaterno." ".$nombreDoc[0]->Amaterno,   
                );
            }
        }
        return response() -> json($notificaciones);
    }
}