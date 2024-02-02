<?php
/**
 *
 * @author jguerrero
 *        
 */
class PrestamoRenovacion extends \CI_Model {
	private $id, $idPrestamo, $fecha, $idUsuario;
	
	public $usuario;
	
	/**
	 *
	 * @return void
	 *
	 */
	public function __construct() {
		parent::__construct ();
		$this->usuario=new Usuario();
	}
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $idPrestamo
	 */
	public function getIdPrestamo() {
		return $this->idPrestamo;
	}

	/**
	 * @return the $fecha
	 */
	public function getFecha() {
		return $this->fecha;
	}

	/**
	 * @return the $idUsuario
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $idPrestamo
	 */
	public function setIdPrestamo($idPrestamo) {
		$this->idPrestamo = $idPrestamo;
	}

	/**
	 * @param field_type $fecha
	 */
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	/**
	 * @param field_type $idUsuario
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}

}

?>