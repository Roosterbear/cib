<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once ('adodb/adodb.inc.php');

/**
 *
 * @author jguerrero
 *        
 */
class Adodb {
	
	/**
	 */
	function __construct($parametros=NULL) {
		
		$db=null;
		
		if(isset($parametros["exceptions"])){
			require_once ('adodb/adodb-exceptions.inc.php');
		}
		require_once ('adodb/adodb.inc.php');
		require(APPPATH.'config/database.php');
		
		$adodb=NewADOConnection($db['default']['dbdriver']);
		$adodb->Connect($db['default']['hostname'],$db['default']['username'],$db['default']['password'],$db['default']['database']);
		$adodb->SetFetchMode(ADODB_FETCH_ASSOC);
		$CI=&get_instance();
		$CI->db= &$adodb;
		
	}
	
}
function nulo($valor){
	if($valor==null){
		return "NULL";
	}
	return is_numeric($valor)? $valor:"'$valor'";
}
//TODO eliminar funcion en produccion
function pre($var){
	echo "<pre>".print_r($var,true)."</pre>";
}