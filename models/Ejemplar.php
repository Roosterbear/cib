<?php

/** 
 * @author jguerrero
 * 
 */
class Ejemplar extends Ficha {
	
	private $id, $idFicha, $fechaIngreso, $numAdquisicion, $volumen, $ejemplar, $tomo, $accesible, $noEscuela, $fechaModificacion;
	private $enPrestamo;
	public function esPrestable(){
		if($this->accesible==1){ return true;}
		if($this->accesible==3){ return true;}
		return false;
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $idFicha
	 */
	public function getIdFicha() {
		return $this->idFicha;
	}

	/**
	 * @return the $fechaIngreso
	 */
	public function getFechaIngreso() {
		return $this->fechaIngreso;
	}

	/**
	 * @return the $numAdquisicion
	 */
	public function getNumAdquisicion() {
		return $this->numAdquisicion;
	}

	/**
	 * @return the $volumen
	 */
	public function getVolumen() {
		return $this->volumen;
	}

	/**
	 * @return the $ejemplar
	 */
	public function getEjemplar() {
		return $this->ejemplar;
	}

	/**
	 * @return the $tomo
	 */
	public function getTomo() {
		return $this->tomo;
	}

	/**
	 * @return the $accesible
	 */
	public function getAccesible() {
		return $this->accesible;
	}

	/**
	 * @return the $noEscuela
	 */
	public function getNoEscuela() {
		return $this->noEscuela;
	}

	/**
	 * @return the $fechaModificacion
	 */
	public function getFechaModificacion() {
		return $this->fechaModificacion;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $idFicha
	 */
	public function setIdFicha($idFicha) {
		$this->idFicha = $idFicha;
	}

	/**
	 * @param field_type $fechaIngreso
	 */
	public function setFechaIngreso($fechaIngreso) {
		$this->fechaIngreso = $fechaIngreso;
	}

	/**
	 * @param field_type $numAdquisicion
	 */
	public function setNumAdquisicion($numAdquisicion) {
		$this->numAdquisicion = $numAdquisicion;
	}

	/**
	 * @param field_type $volumen
	 */
	public function setVolumen($volumen) {
		$this->volumen = $volumen;
	}

	/**
	 * @param field_type $ejemplar
	 */
	public function setEjemplar($ejemplar) {
		$this->ejemplar = $ejemplar;
	}

	/**
	 * @param field_type $tomo
	 */
	public function setTomo($tomo) {
		$this->tomo = $tomo;
	}

	/**
	 * @param field_type $accesible
	 */
	public function setAccesible($accesible) {
		$this->accesible = $accesible;
	}

	/**
	 * @param field_type $noEscuela
	 */
	public function setNoEscuela($noEscuela) {
		$this->noEscuela = $noEscuela;
	}

	/**
	 * @param field_type $fechaModificacion
	 */
	public function setFechaModificacion($fechaModificacion) {
		$this->fechaModificacion = $fechaModificacion;
	}

	/**
	 *
	 * @return void
	 *
	 */
	public function __construct($id=NULL) {
		parent::__construct ();
		if($id!==NULL){
			$this->setId($id);	
		}
	}
	/**
	 * @return the $enPrestamo
	 */
	public function getEnPrestamo() {
		return $this->enPrestamo;
	}

	/**
	 * @param field_type $enPrestamo
	 */
	public function setEnPrestamo($enPrestamo) {
		$this->enPrestamo = $enPrestamo;
	}

}

?>