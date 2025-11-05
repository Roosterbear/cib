<?php

/** 
 * @author jguerrero
 * 
 */
class Alumno extends Usuario {
	private $matricula,$status,$grupo,$cuatrimestre,$fechaBaja;

	public function __construct($id=NULL) {
		parent::__construct ($id);
		$this->setTipo("Alumno");
	}
	/**
	 * @return the $matricula
	 */
	public function getMatricula() {
		return $this->matricula;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return the $grupo
	 */
	public function getGrupo() {
		return $this->grupo;
	}

	/**
	 * @param field_type $matricula
	 */
	public function setMatricula($matricula) {
		$this->matricula = $matricula;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @param field_type $grupo
	 */
	public function setGrupo($grupo) {
		$this->grupo = $grupo;
	}
	/**
	 * @return the $cuatrimestre
	 */
	public function getCuatrimestre() {
		return $this->cuatrimestre;
	}

	/**
	 * @param field_type $cuatrimestre
	 */
	public function setCuatrimestre($cuatrimestre) {
		$this->cuatrimestre = $cuatrimestre;
	}
	/**
	 * @return the $fechaBaja
	 */
	public function getFechaBaja() {
		return $this->fechaBaja;
	}

	/**
	 * @param field_type $fechaBaja
	 */
	public function setFechaBaja($fechaBaja) {
		$this->fechaBaja = $fechaBaja;
	}
}
?>