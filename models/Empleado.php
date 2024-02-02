<?php

/**
 *
 * @author jguerrero
 *        
 */
class Empleado extends Usuario {
	private $cve_empleado,$departamento,$puesto;
	
	/**
	 *
	 * @return void
	 *
	 *
	 */
	public function __construct($id = NULL) {
		parent::__construct ( $id );
		$this->setTipo("Empleado");
		// TODO - Insert your code here
	}
	/**
	 * @return the $cve_empleado
	 */
	public function getCve_empleado() {
		return $this->cve_empleado;
	}

	/**
	 * @return the $departamento
	 */
	public function getDepartamento() {
		return $this->departamento;
	}

	/**
	 * @param field_type $cve_empleado
	 */
	public function setCve_empleado($cve_empleado) {
		$this->cve_empleado = $cve_empleado;
	}

	/**
	 * @param field_type $departamento
	 */
	public function setDepartamento($departamento) {
		$this->departamento = $departamento;
	}
	/**
	 * @return the $puesto
	 */
	public function getPuesto() {
		return $this->puesto;
	}

	/**
	 * @param field_type $puesto
	 */
	public function setPuesto($puesto) {
		$this->setIdPerfil(4);
		if(strpos($puesto, 'PTC') !== false){ $this->setIdPerfil(2);}
		if(strpos($puesto, 'Profesor') !== false){ $this->setIdPerfil(3);}
		if(strpos($puesto, 'Funciones Administrativas') !== false){ $this->setIdPerfil(4);}
		$this->puesto = $puesto;
	}


	
}

?>