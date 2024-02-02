<?php

class ServicioPrestamo extends \CI_Model{
	private $id;
	private $idServicioActivo;
	private $idSolicitante;
	private $idUsuario;
	private $fechaSalida;
	private $fechaEntrada;
	private $estado;
	private $servicio;
	private $activo;
	
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
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $idServicioActivo
	 */
	public function getIdServicioActivo() {
		return $this->idServicioActivo;
	}

	/**
	 * @param field_type $idServicioActivo
	 */
	public function setIdServicioActivo($idServicioActivo) {
		$this->idServicioActivo = $idServicioActivo;
	}

	/**
	 * @return the $idSolicitante
	 */
	public function getIdSolicitante() {
		return $this->idSolicitante;
	}

	/**
	 * @param field_type $idSolicitante
	 */
	public function setIdSolicitante($idSolicitante) {
		$this->idSolicitante = $idSolicitante;
	}

	/**
	 * @return the $idUsuario
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * @param field_type $idUsuario
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}

	/**
	 * @return the $fechaSalida
	 */
	public function getFechaSalida() {
		return $this->fechaSalida;
	}

	/**
	 * @param field_type $fechaSalida
	 */
	public function setFechaSalida($fechaSalida) {
		$this->fechaSalida = $fechaSalida;
	}

	/**
	 * @return the $fechaEntrada
	 */
	public function getFechaEntrada() {
		return $this->fechaEntrada;
	}

	/**
	 * @param field_type $fechaEntrada
	 */
	public function setFechaEntrada($fechaEntrada) {
		$this->fechaEntrada = $fechaEntrada;
	}

	/**
	 * @return the $servicio
	 */
	public function getServicio() {
		return $this->servicio;
	}

	/**
	 * @param field_type $servicio
	 */
	public function setServicio($servicio) {
		$this->servicio = $servicio;
	}

	/**
	 * @return the $activo
	 */
	public function getActivo() {
		return $this->activo;
	}

	/**
	 * @param field_type $activo
	 */
	public function setActivo($activo) {
		$this->activo = $activo;
	}
	/**
	 * @return the $estado
	 */
	public function getEstado() {
		return $this->activo;
	}
	
	/**
	 * @param field_type $estado
	 */
	public function setEstado($estado) {
		$this->estado = $estado;
	}

	
}
?>