<?php

/** 
 * @author jguerrero
 * 
 */
class Cuentas {
	public $db;
	
	/**
	 */
	function __construct() {
		$this->db=&get_instance()->db;
	}
	
	public function Usuario(Usuario $usuario){
		if($usuario->getId()===null){ Throw new Exception("Requiere id ".__METHOD__);}
		if($usuario->getTipo()===null){ Throw new Exception("Requiere Tipo ".__METHOD__);}

		if($usuario->getTipo()=="Alumno"){
			$usr= new Alumno($usuario->getId());
			$this->UsuarioAlumno($usr);
		}
		if($usuario->getTipo()=="Empleado"){
			$usr= new Empleado($usuario->getId());
			$this->UsuarioEmpleado($usr);
		}
		
		return $usr;
		
	}
	
	public function listUsuarios(Usuario $usuario,$top="ALL"){
		
		$filter="";
		
		
		if($usuario->getNombre()!=""){ 
			
			$words=explode(" ", $usuario->NombreCompleto());
			foreach($words as $word){
				$filter.=" and p.nombre + p.apellido_paterno +p.apellido_materno like '%$word%' ";
			}
		}
		
		if($usuario->getUsuario()!==null){
			$filter.=" and isnull(e.cve_empleado,isnull(a.matricula,0)) = '{$usuario->getUsuario()}'";
			
		}
		
		
		if($filter==""){ Throw new Exception("Ningun filtro de busqueda ".__METHOD__);}
		
		$sql="select top $top p.cve_persona,p.cve_persona,p.nombre,p.apellido_paterno,p.apellido_materno 
		,cuenta=isnull(e.cve_empleado,isnull(a.matricula,0))
		,activo=(case when e.cve_empleado is not null then e.activo when a.status='IN' then 1  else 0 end)
		,tipo=(case when e.cve_empleado is not null  then 'Empleado' else 'Alumno' end)
		from persona p
		left outer join empleado e on e.cve_persona=p.cve_persona
		left outer join alumno a on a.cve_alumno=p.cve_persona
		where (e.cve_empleado is not null or a.cve_alumno is not null) $filter";
		//pre($sql);
		//$rs=$this->db->Execute($sql);
		
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta".__METHOD__,null,$ex1);}
		//if($rs->RecordCount()<1){ Throw new Exception("No se encontro resultados".__METHOD__,1); }
		$usuarios=array();
		
		while(!$rs->EOF){
			$u= new Usuario();
			$u->setId($rs->fields["cve_persona"]);
			$u->setNombre($rs->fields["nombre"]);
			$u->setApellido_paterno($rs->fields["apellido_paterno"]);
			$u->setApellido_materno($rs->fields["apellido_materno"]);
			$u->setActivo($rs->fields["activo"]==1);
			$u->setTipo($rs->fields["tipo"]);
			$u->setUsuario($rs->fields["cuenta"]);
			
			
			$usuarios[$u->getId()]=$u;
			$rs->MoveNext();
		}
		
		return $usuarios;
		
		
		
		
	}
	
	
	
	public function UsuarioAlumno(Alumno $alumno){
		if($alumno->getId()===null){ Throw new Exception("Requiere id.  ".__METHOD__);}
		
		$sql="select p.cve_persona,p.nombre,p.apellido_paterno,p.apellido_materno ,
		gpo.*,al.*
		from persona p
		inner join alumno al on al.cve_alumno = p.cve_persona
		left outer join (
		select top 1 g.cve_periodo ,grupo=g.nombre
		,activo=case when getdate() between pe.fecha_inicio and pe.fecha_fin then 1 else pe.activo end
		,cuatrimestre =(case
			when numero_periodo=1 then CAST(YEAR(fecha_inicio) AS varchar)+ ' ' +'ENE - ABR'
			when numero_periodo=2 then CAST(YEAR(fecha_inicio) AS varchar)+ ' ' +'MAY - AGO'
			when numero_periodo=3 then CAST(YEAR(fecha_inicio) AS varchar)+ ' ' +'SEP - DIC' end ) 
		,fecha_baja=b.fecha,a.cve_alumno
		from alumno_grupo ag
		inner join alumno a on a.matricula=ag.matricula
		inner join grupo g on g.cve_grupo=ag.cve_grupo
		inner join inscripcion i on i.matricula=ag.matricula and g.cve_periodo=i.cve_periodo
		inner join periodo pe on pe.cve_periodo=g.cve_periodo
		left outer join baja b on b.cve_periodo=g.cve_periodo and ag.matricula=b.matricula
		where a.cve_alumno={$alumno->getId()}
		order by 1 desc
		) gpo on gpo.cve_alumno=p.cve_persona
		where p.cve_persona={$alumno->getId()}";
		//pre($sql);	
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontro resultado.  ".__METHOD__,1); }
			
		$alumno->setNombre($rs->fields["nombre"]);
		$alumno->setApellido_paterno($rs->fields["apellido_paterno"]);
		$alumno->setApellido_materno($rs->fields["apellido_materno"]);
		$alumno->setActivo($rs->fields["status"]==='IN' && $rs->fields["activo"]==1);
		$alumno->setMatricula($rs->fields["matricula"]);
		$alumno->setUsuario($rs->fields["matricula"]);
		$alumno->setStatus($rs->fields["status"]);
		$alumno->setGrupo($rs->fields["grupo"]);
		$alumno->setCuatrimestre($rs->fields["cuatrimestre"]);
		$alumno->setFechaBaja($rs->fields["fecha_baja"]);
		$alumno->setIdPerfil(1);//Perfil estatico para alumno
		
		return $alumno;
	}
	
	public function UsuarioEmpleado(Empleado $usuario){
		if($usuario->getId()===null){ Throw new Exception("Requiere id.  ".__METHOD__);}
		
		$sql="select p.cve_persona,p.cve_persona,p.cve_persona,p.nombre,p.apellido_paterno,p.apellido_materno ,e.cve_empleado,e.activo,
		departamento=d.nombre,puesto=pt.nombre
		from persona p
		inner join empleado e on e.cve_persona=p.cve_persona
		left outer join puesto pt on pt.cve_empleado=e.cve_empleado and pt.activo=1
		left outer join departamento d on d.cve_departamento=pt.cve_departamento
		where p.cve_persona={$usuario->getId()} order by e.activo desc";
		//pre($sql);
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontro resultado".__METHOD__,1); }
		
		$usuario->setId($rs->fields["cve_persona"]);
		$usuario->setNombre($rs->fields["nombre"]);
		$usuario->setApellido_paterno($rs->fields["apellido_paterno"]);
		$usuario->setApellido_materno($rs->fields["apellido_materno"]);
		$usuario->setActivo($rs->fields["activo"]==1);
		$usuario->setCve_empleado($rs->fields["cve_empleado"]);
		$usuario->setUsuario($rs->fields["cve_empleado"]);
		$usuario->setDepartamento($rs->fields["departamento"]);
		$usuario->setPuesto($rs->fields["puesto"]);
		
		return $usuario;

	}
	
	public function Perfil(Perfil $perfil){
		if($perfil->getId()===null){ Throw new Exception("Requiere id.  ".__METHOD__);}
		$sql="select * from perfil where id={$perfil->getId()}";
		//pre($sql);
		$rs=$this->db->Execute($sql);
		if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
		if($rs->RecordCount()<1){ Throw new Exception("No se encontro registro".__METHOD__,1); }
		
		$perfil->setId($rs->fields["id"]);
		$perfil->setNombre($rs->fields["nombre"]);
		$perfil->setLibros($rs->fields["libros"]);
		
		return  $perfil;
	}
	
	
}

?>