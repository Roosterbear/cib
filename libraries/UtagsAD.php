<?php
require_once 'adldap/adLDAP.php';
/** 
 * @author jguerrero
 * 
 */
class UtagsAD  extends adLDAP{
	/**
	 * 
	 * @var ADOConnection
	 */
	private $db;
	
	private $sal="alumnada";
	private $company="Universidad Tecnológica de Aguascalientes";
	private $ciudad="Aguascalientes";
	private $estado="Aguascalientes";
	
	/**
	 */
	function __construct($options=array()) {
		parent::__construct($options);
	}
	
	
	
	public function CrearUsuario($cve_persona,$ou){
		if(!is_numeric($cve_persona) || $cve_persona <1){ throw new Exception("cve_persona debe ser numérico positívo");}
		
		$sql="Select top 1 p.*,u.* ,passwd=isnull(a.idAdmision,a.[login])
		from persona p inner join usuario a on a.cve_alumno=p.cve_persona
		left outer join admision.dbo.aceptado ac on ac.idAdmision=p.cve_persona 
		where p.cve_persona=$cve_persona";
		
		$rs=$this->db->Execute($sql);
		if($rs===false || $rs->RecordCount()<1){
			throw new Exception("No se Encontro ninguna persona con esa clave");
		}
		$attributes=array();
		
		$attributes['username']=$rs['matricula'];
		$attributes['firstname']=ucwords(mb_strtolower($rs->fields['nombre']));
		$attributes['surname']=ucwords(mb_strtolower(trim(str_ireplace("-", "", $rs->fields['apellido_paterno']." ".$rs->fields["apellido_materno"]))));
		$attributes['email']=$rs['mail'];
		$attributes['container']=$ou;
		$attributes['change_password']=0;
		$attributes['display_name']=$attributes['firstname'].' '.$attributes['surname'];
		$attributes['telephone']=$rs->fields["movil"];
		$attributes['company']=$this->company;
		//$attributes['department']=$rs['carrera'];
		$attributes['logon_name']=$rs['matricula']."@".$this->accountSuffix;
		$attributes['address_city']=$this->ciudad;
		$attributes['address_state']=$this->estado;

		$passwd=md5($this->sal.$rs['passwd']);
		$passwd=substr($passwd, 2, 8);
		$attributes['password']=$passwd;
		$attributes['enabled']=1;
		
		if($this->user()->create($attributes)!==true){
			throw new Exception("Error al crear el usuario en AD. ".$this->getLastError());
		}
		return true;
		
	}
	
	public function restaurarPassword($usuario,$password=null){
		$sql="Select top 1 u.* ,passwd=isnull(a.idAdmision,a.[login])
		from persona p inner join usuario a on a.cve_alumno=p.cve_persona
		left outer join admision.dbo.aceptado ac on ac.idAdmision=p.cve_persona 
		where u.[login]=$usuario";
		
		$rs=$this->db->Execute($sql);
		if($rs===false || $rs->RecordCount()<1){
			throw new Exception("No se Encontro ninguna persona con esa clave");
		}
		if($password==null){
			$passwd=md5($this->sal.$rs['passwd']);
			$passwd=substr($passwd, 2, 8);
		}
		
		$update="UPDATE usuario set [password]='$passwd' where [login]='$usuario'";
		$rs=$this->db->Execute($sql);
		if($rs===false){
			throw new Exception("No se Actualizo contraseña en SITO");
		}
		
		if( $this->user()->password($usuario, $password)){
			throw new Exception("No se Actualizo contraseña en AD.  ".$this->getLastError());
		}
		return true;
	}
	
	public function getUsuario($usuario){
		$sql="SELECT * FROM usuario u inner join persona p on p.cve_persona=u.cve_persona where u.[login]='$usuario'";
		$rs= $this->db->Execute($sql);
		return $rs->FetchObj();
	
	}
	
	public function setDBConexion(ADOConnection &$db){
		$this->db=$db;
	}
	
	
	
	
}

?>