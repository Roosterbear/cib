<?php

/** 
 * @author jguerrero
 * 
 */
class Politica extends \CI_Model {
	private $id, $nombre, $libros, $dias, $renovacion;
	/**
	 *
	 * @return void
	 *
	 */
	public function __construct($id=NULL) {
		parent::__construct ();
		if($id!==null){
			$this->setId($id);
		}
	}
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @return the $libros
	 */
	public function getLibros() {
		return $this->libros;
	}

	/**
	 * @return the $dias
	 */
	public function getDias() {
		return $this->dias;
	}

	/**
	 * @return the $renovacion
	 */
	public function getRenovacion() {
		return $this->renovacion;
       
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		if(is_numeric($id)===false){throw new Exception("El id no es numérico.");}
		$this->id = $id;
	}

	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		if(strlen($nombre)<1){ Throw new Exception("Nombre no puede estar vacío"); }
		if(strlen($nombre)>30){ Throw new Exception("Nombre debe ser maximo de 30 caracteres"); }
		$this->nombre = $nombre;
	}

	/**
	 * @param field_type $libros
	 */
	public function setLibros($libros) {
		if(is_numeric($libros)===false){throw new Exception("Los libros deben ser entero.");}
		$this->libros = $libros;
	}

	/**
	 * @param field_type $dias
	 */
	public function setDias($dias) {
		if(is_numeric($dias)===false){throw new Exception("Los días deben ser entero.");}
		$this->dias = $dias;
	}

	/**
	 * @param field_type $renovacion
	 */
	public function setRenovacion($renovacion) {
		if(is_numeric($renovacion)===false){throw new Exception("Las renovaciones deben ser entero.");}
		$this->renovacion = $renovacion;
	}


}

?>