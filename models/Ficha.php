<?php

/** 
 * @author jguerrero
 * 
 */
class Ficha extends \CI_Model {
	private $Id, $titulo, $autor, $ISBN, $fecha, $fechaMod, $datosFijos, $etiquetasMARC, $tipoMaterial, $clasificacion, $estatus;
	
	/**
	 *
	 * @return void
	 *
	 */
	public function __construct() {
		parent::__construct ();
		// TODO - Insert your code here
	}
	/**
	 * @return the $Id
	 */
	public function getId() {
		return $this->Id;
	}

	/**
	 * @return the $titulo
	 */
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	 * @return the $autor
	 */
	public function getAutor() {
		return $this->autor;
	}

	/**
	 * @return the $ISBN
	 */
	public function getISBN() {
		return $this->ISBN;
	}

	/**
	 * @return the $fecha
	 */
	public function getFecha() {
		return $this->fecha;
	}

	/**
	 * @return the $fechaMod
	 */
	public function getFechaMod() {
		return $this->fechaMod;
	}

	/**
	 * @return the $datosFijos
	 */
	public function getDatosFijos() {
		return $this->datosFijos;
	}

	/**
	 * @return the $etiquetasMARC
	 */
	public function getEtiquetasMARC() {
		return $this->etiquetasMARC;
	}

	/**
	 * @return the $tipoMaterial
	 */
	public function getTipoMaterial() {
		return $this->tipoMaterial;
	}

	/**
	 * @return the $clasificacion
	 */
	public function getClasificacion() {
		return $this->clasificacion;
	}

	/**
	 * @return the $estatus
	 */
	public function getEstatus() {
		return $this->estatus;
	}

	/**
	 * @param field_type $Id
	 */
	public function setId($Id) {
		$this->Id = $Id;
	}

	/**
	 * @param field_type $titulo
	 */
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	/**
	 * @param field_type $autor
	 */
	public function setAutor($autor) {
		$this->autor = $autor;
	}

	/**
	 * @param field_type $ISBN
	 */
	public function setISBN($ISBN) {
		$this->ISBN = $ISBN;
	}

	/**
	 * @param field_type $fecha
	 */
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	/**
	 * @param field_type $fechaMod
	 */
	public function setFechaMod($fechaMod) {
		$this->fechaMod = $fechaMod;
	}

	/**
	 * @param field_type $datosFijos
	 */
	public function setDatosFijos($datosFijos) {
		$this->datosFijos = $datosFijos;
	}

	/**
	 * @param field_type $etiquetasMARC
	 */
	public function setEtiquetasMARC($etiquetasMARC) {
		$this->etiquetasMARC = $etiquetasMARC;
	}

	/**
	 * @param field_type $tipoMaterial
	 */
	public function setTipoMaterial($tipoMaterial) {
		$this->tipoMaterial = $tipoMaterial;
	}

	/**
	 * @param field_type $clasificacion
	 */
	public function setClasificacion($clasificacion) {
		$this->clasificacion = $clasificacion;
	}

	/**
	 * @param field_type $estatus
	 */
	public function setEstatus($estatus) {
		$this->estatus = $estatus;
	}

}

?>