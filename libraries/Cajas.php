<?php
/**
 *
 * @author jguerrero
 *        
 */
class Cajas {
	// TODO - Insert your code here
	
	public $db;
	
	/**
	 */
	function __construct() {
		$this->db=&get_instance()->db;
        //$this->db->debug = true;
	}
	
	public function TieneAdeudosBiblioteca(Usuario $usuario){
		if($usuario->getId()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}
		$sql="select top 1 * from cxc where cve_cliente={$usuario->getId()} and cve_concepto in (30,253) and [status]=1 ";
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}

		return ($rs->RecordCount()>0);
		  
	}
	
	
}

?>