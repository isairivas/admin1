<?php


/**
 * Description of Evento
 *
 * @author isai
 */
class Evento extends Model {
    
    private $table = 'eventos';
    private $primary = 'id';
    
    function __construct() {
        parent::__construct($this->table,$this->primary);
    }
    
    public function getEventosBySemana($fechaInicial){
        $db = parent::getAdapter();
        $sql = "SELECT * FROM {$this->table} "
               ." WHERE fecha BETWEEN '{$fechaInicial}' AND (SELECT DATE_ADD('{$fechaInicial}', INTERVAL 6 DAY) ) ";
               
        $registros = $db->query($sql);
        return parent::toArray($registros);
        
    }
    
    public function getEventos(){
        $db = parent::getAdapter();
        $sql = "SELECT * FROM {$this->table} "
               ." WHERE sys_status = 'ACTIVO' ORDER BY sys_created_at DESC ";
               
        $registros = $db->query($sql);
        return parent::toArray($registros);
    }
    
    private function getFechaFinal($fechaInicial,$dias=7){
        $dia = (60 * 60)*(24);
        
        if($fecha == null){
            $fecha = time() - $dia ;
        }
        if($numeroDias == 0){
            return $fecha;
        }
        if($numeroDias < 0 ){
            return $false;
        }
        
        
        $totalSegundosEliminados = $dia * $numeroDias;
        $totalTimeStamp = $fecha - $totalSegundosEliminados;
        return $totalTimeStamp;
    }
    
    public function getEvento($id){
        $evento = parent::getById($id);
        $imagenesDB = new Model('eventos_imagenes','evento_imagen_id');
        $imagenes = $imagenesDB->getByColumn('eventos_id', $id);
        $evento['imagenes'] = $imagenesDB->toArray($imagenes);
        
        $organizadoresDB = new Model('evento_organizadores','id');
        $organizadores = $organizadoresDB->getByColumn('eventos_id', $id);
        $evento['organizadores'] = $organizadoresDB->toArray($organizadores);
        
        $patDB = new Model('evento_patrocinadores','id');
        $patrocinadores = $patDB->getByColumn('eventos_id', $id);
        $evento['patrocinadores'] = $patDB->toArray($patrocinadores);
        
        return $evento;
        
        
    }
}


