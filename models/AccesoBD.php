<?php

class AccesoBD extends \CI_Model {
	
	public $db;
	
	function __construct() {
		$this->db=&get_instance()->db;
	}

    function test(){
        $sql = "select a.matricula from cib.prestamo p
                inner join cib.ejemplar e on p.idEjemplar = e.id
                inner join cib.ficha f on e.idFicha = f.Id
                inner join persona per on per.cve_persona = p.idSolicitante
                inner join alumno a on per.cve_persona = a.cve_alumno
                where CONVERT(date, fechaEntrega) = CONVERT(date, DATEADD(day, 1, GETDATE()))";
        $rs = $this->db->Execute($sql);
        
        // ***************************************
        // REGRESA UN ARRAY CON LAS MATRICULAS QUE
        // DEBEN ENTREGAR LIBRO AL DIA SIGUIENTE
        // ***************************************
        
        $matriculas = [];

        while(!$rs->EOF){
            $matriculas[] = $rs->fields['matricula'];
            $rs->MoveNext();
        }

        return $matriculas;
        //return $rs->fields["campo"];
    }
	
}