<?php
/**
 *
 * @author jguerrero
 *        
 */
class Usuario extends \CI_Model {
	private $id,$usuario,$nombre,$apellido_paterno,$apellido_materno,$tipo,$activo;
	private $idPerfil;
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
	 * @return the $usuario
	 */
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @return the $apellido_paterno
	 */
	public function getApellido_paterno() {
		return $this->apellido_paterno;
	}

	/**
	 * @return the $apellido_materno
	 */
	public function getApellido_materno() {
		return $this->apellido_materno;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $usuario
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param field_type $apellido_paterno
	 */
	public function setApellido_paterno($apellido_paterno) {
		$this->apellido_paterno = $apellido_paterno;
	}

	/**
	 * @param field_type $apellido_materno
	 */
	public function setApellido_materno($apellido_materno) {
		$this->apellido_materno = $apellido_materno;
	}
	
	public function NombreCompleto(){
		return $this->nombre." ".$this->apellido_paterno." ".$this->apellido_materno;
	}
	/**
	 * @return the $tipo
	 */
	public function getTipo() {
		return $this->tipo;
	}

	/**
	 * @param field_type $tipo
	 */
	public function setTipo($tipo) {
		$this->tipo = $tipo;
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
	 * @return the $idPerfil
	 */
	public function getIdPerfil() {
		return $this->idPerfil;
	}

	/**
	 * @param field_type $idPerfil
	 */
	public function setIdPerfil($idPerfil) {
		$this->idPerfil = $idPerfil;
	}




	
}

?>