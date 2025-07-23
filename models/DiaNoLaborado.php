<?php
class DiaNoLaborado extends \CI_Model{
	private $id=0;
	private $fecha=NULL;
	private $idUsuario=0;
	
	public function __construct($id=NULL) {
		parent::__construct ();
		if($id!==null){
			$this->setId($id);
		}
	}
	

	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param field_type  number $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return the $fecha
	 */
	public function getFecha()
	{
		return $this->fecha;
	}

	/**
	 * @param field_type  field_type $fecha
	 */
	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	/**
	 * @return the $idUsuario
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}

	/**
	 * @param field_type  number $idUsuario
	 */
	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
	}



}
?>