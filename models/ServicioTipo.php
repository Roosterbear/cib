<?php
class ServicioTipo extends \CI_Model{
	private $id=0;
	private $nombre= NULL;
	
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
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return the $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param field_type $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}
?>
