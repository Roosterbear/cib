<?php

/* --------------------------------------------------------*/
/* ESTA CLASE CONTIENE TODO LO REFERENTE AL ABC DE FICHAS */
/* ------------------------------------------------------*/

class Ficha extends \CI_Model {
	
	public function __construct() {
		parent::__construct ();	
		$this->load->library("CIB");
	}
	
	
	
	// agregar un filtro 
	
	/*
	 * -solo datos basicos
	 * -los ultimos 20
	 * -
	 * 
	 * 
	 * */
	public function getFicha2(){
		//$this->cib = new CIB();

		// LO QUE ESTA EN LA BD
		// id - titulo - autor - ISBN - fecha - fechaMod - datosFijos - etiquetasMARC - tipoMaterial - clasificacion - estatus - coleccion_No
		// LO QUE DEBERIA ESTAR
		// id - titulo - autor - ISBN - fecha - clasificacion - lugar - area - edicion - descripcion
		// PONDREMOS MIENTRAS
		// id - titulo - autor - ISBN - clasificacion
		$sql = "select id, titulo, autor, isbn, clasificacion from cib.ficha";
		
		//$rs = $this->db->Execute($sql);

		//$tabla = $this->cib->getFicha($rs->getArray());
		//return $tabla;
		echo $sql;

	}
	
}