<?php

/** 
 * @author jguerrero
 * 
 */
class Libreria {

	public $db;
	/**
	 */
	function __construct() {
		$this->db=&get_instance()->db;
		//$this->db->debug = true;
	}
	
	public function Politica(Politica &$politica){
		$sql="select * from cib.politica WHERE id={$politica->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		
		$politica=new Politica();
		$politica->setId($rs->fields["id"]);
		$politica->setNombre($rs->fields["nombre"]);
		$politica->setDias($rs->fields["dias"]);
		$politica->setRenovacion($rs->fields["renovacion"]);
		$politica->setLibros($rs->fields["libros"]);
	
		return $politica;
	
	}
	
	public function listadoPoliticas(){
		$sql="select p.*,esborrable=isnull(pp.idPolitica,0) 
		from cib.politica p left outer join cib.perfilPolitica pp on pp.idPerfil=p.id";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$listado=array();
		while (!$rs->EOF){
			$politica=new Politica();
			$politica->setId($rs->fields["id"]);
			$politica->setNombre($rs->fields["nombre"]);
			$politica->setDias($rs->fields["dias"]);
			$politica->setRenovacion($rs->fields["renovacion"]);
			$politica->setLibros($rs->fields["libros"]);
			$politica->setEsBorrable($rs->fields["esborrable"]==0);
			$listado[]=$politica;
			
			$rs->MoveNext();
		}
		
		return $listado;
		
	}
	
	public function borrarPolitica(Politica $politica){
		$sql="DELETE FROM cib.politica  WHERE id={$politica->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		

	}
	public function agregarPolitica(Politica $politica){
		$sql="insert into cib.politica (nombre,libros,dias,renovacion) 
				values ('".$politica->getNombre()."', ".$politica->getLibros().",".$politica->getDias().",".$politica->getRenovacion().")";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		
	
	}
	
	
	public function actualizarPolitica(Politica $politica){
		$sql="UPDATE cib.politica SET 
		nombre='{$politica->getNombre()}', libros={$politica->getLibros()}, dias={$politica->getDias()}, renovacion={$politica->getRenovacion()}
		WHERE id={$politica->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	
		
	}
	public function DiaLaborado(DiaNoLaborado &$laboral){
		$sql="select *from cib.diasNoLaborables WHERE id={$laboral->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
	
		$laboral=new DiaNoLaborado();
		$laboral->setId($rs->fields["id"]);
		$laboral->setFecha($rs->fields["fecha"]);
		$laboral->setIdUsuario($rs->fields["idUsuario"]);
		
		return $laboral;
	
	}
	public function listaDiaLaborado(){
		$filtro="";
	
		$sql="select *,fecha= (replace(convert(varchar,fecha, 111), '/', '-')),esBorrable=case when getdate()>fecha then 1 else 0 end from cib.diasNoLaborables $filtro; ";
		
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$lista=array();
		
		while (!$rs->EOF){
	        $laboral= new  DiaNoLaborado();
	        $laboral->setId($rs->fields["id"]);
	        $laboral->setFecha($rs->fields["fecha"]);
	        $laboral->setIdUsuario($rs->fields["idUsuario"]);
	        $laboral->setEsBorrable($rs->fields["esBorrable"]==0);

			$lista[]=$laboral;
	        
			$rs->MoveNext();
		}
	
		return $lista;
		
	}
	public function agregarFecha(DiaNoLaborado $listado){
		$sql="insert into cib.diasNoLaborables (fecha,idUsuario)
				values ('".$listado->getFecha()."',".$listado->getIdUsuario().")";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	
	
	}
	public function borrarFecha(DiaNoLaborado $listado){
		$sql="DELETE FROM cib.diasNoLaborables  WHERE id={$listado->getId()}"  ;
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	
	
	}
	
	public function buscarFecha (DiaNoLaborado $listado){
		$sql="SELECT * FROM cib.diasNoLaborables WHERE fecha='{$listado->getFecha()}'";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ return true; }
		return false;
	}
	
	public function filtrarFecha ($fechaInicio, $fechaFinal){
		//$this->db->debug = true;
		$sql="SELECT *, fecha = (replace(convert(varchar,fecha, 111), '/', '-')) FROM cib.diasNoLaborables WHERE fecha >= '{$fechaInicio}' and fecha <= '{$fechaFinal}'";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$lista=array();
		
		while (!$rs->EOF){
	        $laboral= new  DiaNoLaborado();
	        $laboral->setId($rs->fields["id"]);
	        $laboral->setFecha($rs->fields["fecha"]);
	        $laboral->setIdUsuario($rs->fields["idUsuario"]);

			$lista[]=$laboral;
	        
			$rs->MoveNext();
		}
	
		return $lista;
		
	}
	
	public function servicioTipo (ServicioTipo $catalogo){
		$sql="select *from cib.servicio WHERE id={$catalogo->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		
		$catalogo= new ServicioTipo();
		$catalogo->setId($rs->fields["id"]);
		$catalogo->setNombre($rs->fields["nombre"]);
		
		return $catalogo;
	}
	
	public function listaServicios (){
		
		$sql="select  distinct s.*,esborrable=isnull(sa.idServicio,0)
		from cib.servicio s left outer join cib.servicioActivo sa on sa.idServicio=s.id  ";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$lista=array();
		 while (!$rs->EOF){
		 	$catalogo= new ServicioTipo();
		 	$catalogo->setId($rs->fields["id"]);
		 	$catalogo->setNombre($rs->fields["nombre"]);
		 	$catalogo->setEsBorrable($rs->fields["esborrable"]==0);
		 	
		 	$lista[]=$catalogo;
		 	
		 	$rs->MoveNext();
		 }
		 return $lista;
		 
		 
	}
	
	public function agregarServicio(ServicioTipo $catalogo){
		$sql="insert into cib.servicio (nombre) values ('".$catalogo->getNombre()."')";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		
	}
	
	public function borrarServicio(ServicioTipo $catalogo){
		$sql="DELETE FROM cib.servicio WHERE id={$catalogo->getId()}" ;
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	}
	
	public function buscarServicio($buscar){
		$sql="SELECT distinct s.*,esborrable=isnull(sa.idServicio,0) FROM cib.servicio s left outer join cib.servicioActivo sa on sa.idServicio=s.id
        WHERE s.nombre like '%{$buscar}%' ";	
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ return true; }
		
		$lista=array();
		while (!$rs->EOF){
			$catalogo= new ServicioTipo();
			$catalogo->setId($rs->fields["id"]);
			$catalogo->setNombre($rs->fields["nombre"]); 
			$catalogo->setEsBorrable($rs->fields["esborrable"]==0);
		
			$lista[]=$catalogo;
		
			$rs->MoveNext();
		}
		return $lista;
		
	}
	
	public function servicioActivo (ServicioActivo $catalogos){
		$sql="select *from cib.servicioActivo WHERE id={$catalogos->getId()}";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
	
		$catalogos= new ServicioActivo();
		$catalogos->setId($rs->fields["id"]);
		$catalogos->setIdServicio->fields["idServicio"];
		$catalogos->setNombre($rs->fields["nombre"]);
	
		return $catalogos;
	}
	public function listaActivos(){
	    $sql="SELECT distinct sa.*,esborrable=isnull(sp.idServicioActivo,0) ,servicio=s.nombre
	    		FROM cib.servicioActivo as sa
	    		inner join cib.servicio s on sa.idServicio=s.id 
	    		left outer join cib.servicioPrestamo as sp on sp.idServicioActivo=sa.id";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
		$lista=array();
		while (!$rs->EOF){
			$catalogos= new ServicioActivo();
			$catalogos->setId($rs->fields["id"]);
			$catalogos->setIdServicio($rs->fields["idServicio"]);
			$catalogos->setNombre($rs->fields["nombre"]);
			$catalogos->setEsBorrable($rs->fields["esborrable"]==0);
			$catalogos->setServicio($rs->fields["servicio"]);
	
			$lista[]=$catalogos;
	
			$rs->MoveNext();
		}
		return $lista;
	}
	
	public function agregarActivo(ServicioActivo $catalogos){
		$sql="insert into cib.servicioActivo (idservicio,nombre) values ({$catalogos->getIdServicio()} , '".$catalogos->getNombre()."')";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	
	}
	
	public function borrarActivo(ServicioActivo $catalogos){
		$sql="DELETE FROM cib.servicioActivo WHERE id={$catalogos->getId()}" ;
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
	}
	
	public function buscarActivo($buscar){
		$sql="SELECT distinct sa.*,esborrable=isnull(sp.idServicioActivo,0) FROM cib.servicioActivo sa left outer join cib.servicioPrestamo sp on sp.idServicioActivo=sa.id
        WHERE sa.nombre like '%{$buscar}%'  ";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ return true; }
	
		$lista=array();
		while (!$rs->EOF){
			$catalogos= new ServicioActivo();
			$catalogos->setId($rs->fields["id"]);
			$catalogos->setIdServicio($rs->fields["idServicio"]);
			$catalogos->setNombre($rs->fields["nombre"]);
			$catalogos->setEsBorrable($rs->fields["esborrable"]==0);
	
			$lista[]=$catalogos;
	
			$rs->MoveNext();
		}
		return $lista;
	
	}
		
}

?>