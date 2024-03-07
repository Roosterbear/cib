<?php

/* ------------------------------------------------------------*/
/* ESTA CLASE CONTIENE TODO LO REFERENTE AL ABC DE EJEMPLARES */
/* ----------------------------------------------------------*/

class Ejemplar extends \CI_Model {
	

	public function __construct() {
		parent::__construct ();
		$this->load->library("CIB");
	}

	public function buscarLibro($busqueda,$autor){
		if ($busqueda == '' || $busqueda == ' ') return '';
		$this->cib = new CIB();

		$sqlTitulo = "select titulo, autor, clasificacion from cib.ficha where titulo like '%".$busqueda."%'";
		$sqlAutor = "select titulo, autor, clasificacion from cib.ficha where autor like '%".$busqueda."%'";
		$rs = $autor?$this->db->Execute($sqlAutor):$this->db->Execute($sqlTitulo);

		$tabla = $this->cib->getBook($rs->getArray());
		return $tabla;

	}
}