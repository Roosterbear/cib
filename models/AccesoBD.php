<?php

class AccesoBD extends \CI_Model {
	
	public $db;

	function __construct() {
		$this->db=&get_instance()->db;
    }

    public function listadoAlumnosConLibrosaCaducar(){
        $sql="select a.matricula,f.titulo, per.nombre from cib.prestamo p
        inner join cib.ejemplar e on p.idEjemplar = e.id
        inner join cib.ficha f on e.idFicha = f.Id
        inner join persona per on per.cve_persona = p.idSolicitante
        inner join alumno a on per.cve_persona = a.cve_alumno
        where CONVERT(date, fechaEntrega) = CONVERT(date, DATEADD(day, 1, GETDATE()))";
        $rs = $this->db->execute($sql);
        $listado=array();
        while(!$rs->EOF){
            $listado[ $rs->fields['matricula']][] = [
                'titulo'=>$rs->fields['titulo'],
                'nombre'=>$rs->fields['nombre']
            ];
            $rs->MoveNext();
        }
        return $listado;
    }

    public function grabarLogEnvioCorreo($log, $status_error){
        $log = $status_error?'ERROR->'.$log:$log;
        $sql = "insert into loglf (descripcion) 
        values (CONCAT('".$log."->',CONVERT(varchar(19),GETDATE(),120)))";
        $rs = $this->db->execute($sql);
        return true;
    }
}