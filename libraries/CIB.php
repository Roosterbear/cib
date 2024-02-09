<?php 
class CIB {
	public $db;
	
	public function __construct() {
		$this->db = &get_instance()->db;
		// $rs=$this->db->Execute($sql);
        // $rs->getArray();
        // $rs->fields['descripcion'];
	}
	
	public function getBook(){
		$sql = "select titulo, autor, clasificacion from cib.ficha where id=1";
		$rs = $this->db->Execute($sql);	
		
		return $rs->getArray();		
	}
	
	
	
}


?>