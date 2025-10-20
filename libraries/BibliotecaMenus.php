<?php

/** 
 * @author jguerrero
 * 
 */
class BibliotecaMenus extends MenusDB {
	/**
	 */
	public function __construct() {
		parent::__construct ();
		// TODO - Insert your code here
	}
	
	public function PoliticaPefil($idPerfil,$id=NULL,$nombre="idPolitica"){
		$query="select nombre,id from cib.politica p 
		inner join cib.perfilPolitica pp on p.id=pp.idPolitica
		where pp.idPerfil=$idPerfil";
		
		return $this->generarMenu($query, $nombre, $id);
	}
	
	public function Servicios($id=NULL,$nombre="idServicio"){
		$query="select nombre,id from cib.servicio order by 1 asc";
		return $this->generarMenu($query, $nombre, $id);
	}
	

	public function ServicioActivosSinPrestamo($idServicio,$id=NULL,$nombre="idServicioActivo"){
		$query="select distinct sa.nombre,sa.id 
		from cib.servicioActivo sa
		left outer join cib.servicioPrestamo sp on sp.idServicioActivo=sa.id
		where sa.idServicio=$idServicio and isnull(sp.estado,0)=0
		order by 1 asc	";
		return $this->generarMenu($query, $nombre, $id);
		
	}
	
	public function ServicioActivosEnPrestamo($idServicio,$id=NULL,$nombre="idServicioActivo"){
		$query="select distinct sa.nombre,sp.id
		from cib.servicioActivo sa
		inner join  cib.servicioPrestamo sp on sp.idServicioActivo=sa.id
		where sa.idServicio=$idServicio and sp.estado=1
		order by 1 asc	";
		return $this->generarMenu($query, $nombre, $id);
		
	}
}

?>