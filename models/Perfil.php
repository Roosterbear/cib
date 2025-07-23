<?php
/**
 *
 * @author jguerrero
 *        
 */
class Perfil extends \CI_Model {
	private $id,$nombre,$libros;
	
	/**
	 *
	 * @return void
	 *
	 */
	public function __construct($id=NULL) {
		parent::__construct ();
		if($id!=null){
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
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param field_type $libros
	 */
	public function setLibros($libros) {
		$this->libros = $libros;
	}

}

?>