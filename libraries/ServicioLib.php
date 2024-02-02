<?php
class ServicioLib{
	public $db;
	
	function __construct() {
		$this->db=&get_instance()->db;
       // $this->db->debug = true;
	}
	
	public function ServicioPrestamo (Usuario &$usuario){
		$sql="select * from cib.servicioPrestamo WHERE idSolicitante={$usuario->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		
		$prestamo=new ServicioPrestamo();
		$prestamo->setId($rs->fields["id"]);
		$prestamo->setIdServicioActivo($rs->fields["idServicioActivo"]);
		$prestamo->setIdSolicitante($rs->fields["idSolicitante"]);
		$prestamo->setIdUsuario($rs->fields["idUsuario"]);
		$prestamo->setFechaSalida($rs->fields["fechaSalida"]);
		$prestamo->setFechaEntrada($rs->fields["fechaEntrada"]);
		$prestamo->setEstado($rs->fields["estado"]==1);
		
		return $prestamo;
	}
	
	public function listaPrestamos(Usuario &$usuario,$estado=1){
		
		$sql="select 
                sp.id,
                sp.idServicioActivo,
                sp.idSolicitante,
                sp.idUsuario,	
                sp.fechaSalida,
                sp.fechaEntrada,
                sp.estado,
                s.nombre as servicio,
                sa.nombre as activo
                
                from cib.servicioPrestamo sp 
                left outer join cib.servicioActivo sa on sp.idServicioActivo = sa.id  
                left outer join cib.servicio s on sa.idServicio = s.id
                where sp.idSolicitante={$usuario->getId()} and estado=$estado";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		//if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$lista=array();
		while (!$rs->EOF){
			$prestamo=new ServicioPrestamo();
			$prestamo->setId($rs->fields["id"]);
			$prestamo->setIdServicioActivo($rs->fields["idServicioActivo"]);
			$prestamo->setIdSolicitante($rs->fields["idSolicitante"]);
			$prestamo->setIdUsuario($rs->fields["idUsuario"]);
			$prestamo->setFechaSalida($rs->fields["fechaSalida"]);
			$prestamo->setFechaEntrada($rs->fields["fechaEntrada"]);
			$prestamo->setEstado($rs->fields["estado"]==1);
			$prestamo->setServicio($rs->fields("servicio"));
			$prestamo->setActivo($rs->fields["activo"]);
			
		
			$lista[]=$prestamo;
		
			$rs->MoveNext();
		}
		return $lista;
	}
	public function agregarPrestamo (ServicioPrestamo $prestamo){
		
		
		if($prestamo->getIdServicioActivo()==null){ throw new Exception("Requiere  id servicio activo");}
		if($prestamo->getIdUsuario()==null){ throw new Exception("Requiere  id usuario ");}
		if($prestamo->getIdSolicitante()==null){ throw new Exception("Requiere  id solicitante ");}
		
		
		$sql="insert into cib.ServicioPrestamo (idServicioActivo,idSolicitante, idUsuario, fechaSalida, estado)
		values (".$prestamo->getIdServicioActivo().", ".$prestamo->getIdSolicitante().",".$prestamo->getIdUsuario().",getdate(),1)";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null	,$ex1);}
		
		
	}
	public Function DevolverPrestamo(ServicioPrestamo $prestamo){
		if($prestamo->getId()==null){ throw new Exception("Requiere  id prestamo");}
		if($prestamo->getIdUsuario()==null){ throw new Exception("Requiere  id usuario ");}
		
		$sql="UPDATE cib.servicioPrestamo SET	idUsuario={$prestamo->getIdUsuario()},fechaEntrada=getdate(),estado=0
		WHERE id={$prestamo->getId()} and estado=1";
		$ok=$this->db->Execute($sql);
		if($ok===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la Ejecución.  ".__METHOD__,null,$ex1);}
		if($this->db->Affected_Rows()<1){
			throw new Exception("No se recibio nada");
		}
	
	}
	
	
	
}
?>