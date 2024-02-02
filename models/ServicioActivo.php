<?php
class ServicioActivo extends \CI_Model{
	private $id=0;
	private $idServicio=0;
	private $nombre= NULL;
    private $servicio;
	
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
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $idServicio
	 */
	public function getIdServicio() {
		return $this->idServicio;
	}

	/**
	 * @param number $idServicio
	 */
	public function setIdServicio($idServicio) {
		$this->idServicio = $idServicio;
	}

	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
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


	
	
}
?>