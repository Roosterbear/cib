<?php

class Ficha extends \CI_Model {
	private $Id, $titulo, $autor, $ISBN, $fecha, $fechaMod, $datosFijos, $etiquetasMARC, $tipoMaterial, $clasificacion, $estatus, $coleccion_No;
	public $cib;
	
	public function __construct() {
		parent::__construct ();
		//$this->db = &get_instance()->db;
		$this->load->library("CIB");
	}

	/* ------------------- */
	/* ----- FICHERO ----- */
	/* ------------------- */
	public function buscarLibro($busqueda){
		if ($busqueda == '' || $busqueda == ' ') return '';
		$this->cib = new CIB();
				
		$sql = "select titulo, autor, clasificacion from cib.ficha where titulo like '%".$busqueda."%'";
		$rs = $this->db->Execute($sql);
		
		$tabla = $this->cib->getBook($rs->getArray());
		return $tabla;
		
	}
	
	
	/* ------------------- */
	/* ----- GETTERS ----- */
	/* ------------------- */
	public function getId() {
		return $this->Id;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getAutor() {
		return $this->autor;
	}

	public function getISBN() {
		return $this->ISBN;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function getFechaMod() {
		return $this->fechaMod;
	}

	public function getDatosFijos() {
		return $this->datosFijos;
	}

	public function getEtiquetasMARC() {
		return $this->etiquetasMARC;
	}

	public function getTipoMaterial() {
		return $this->tipoMaterial;
	}

	public function getClasificacion() {
		return $this->clasificacion;
	}

	public function getEstatus() {
		return $this->estatus;
	}

	
	/* ------------------- */
	/* ----- SETTERS ----- */
	/* ------------------- */
	public function setId($Id) {
		$this->Id = $Id;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setAutor($autor) {
		$this->autor = $autor;
	}

	public function setISBN($ISBN) {
		$this->ISBN = $ISBN;
	}

	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function setFechaMod($fechaMod) {
		$this->fechaMod = $fechaMod;
	}

	public function setDatosFijos($datosFijos) {
		$this->datosFijos = $datosFijos;
	}

	public function setEtiquetasMARC($etiquetasMARC) {
		$this->etiquetasMARC = $etiquetasMARC;
	}

	public function setTipoMaterial($tipoMaterial) {
		$this->tipoMaterial = $tipoMaterial;
	}

	public function setClasificacion($clasificacion) {
		$this->clasificacion = $clasificacion;
	}

	public function setEstatus($estatus) {
		$this->estatus = $estatus;
	}

}

?>