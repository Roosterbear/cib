<?php

/**
 *
 * @author jguerrero
 *
 */
class Biblioteca {
  public $db;

  /**
   */
  function __construct() {
    $this->db=&get_instance()->db;
    //$this->db->debug = true;
  }


  public function EjemplarLibro(Ejemplar $ejemplar, $por="id"){
    if($por=="id" && $ejemplar->getId()===null){ Throw new Exception("Requiere id ".__METHOD__);}
    if($por=="numAdquisicion" && $ejemplar->getNumAdquisicion()===null){ Throw new Exception("Requiere # de Adquisición ".__METHOD__);}

    $filtro="";
    if($por=="id"){	$filtro="e.id={$ejemplar->getId()}"; }
    if($por=="numAdquisicion"){	$filtro="e.numAdquisicion='{$ejemplar->getNumAdquisicion()}'"; }
    //@fixme actualizar registros de tabla
    $sql="SELECT  e.*,f.autor,f.titulo,f.isbn,f.tipoMaterial,f.clasificacion
		,enPrestamo=isnull(p.id,0)
		FROM cib.ejemplar e 
		inner join cib.ficha f on f.id=e.idFicha 
		left outer join cib.prestamo p on p.idEjemplar =e.id and p.estado=1
		WHERE $filtro ";

    //pre($sql);

    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $ejemplar->setTitulo($rs->fields['titulo']);
    $ejemplar->setAutor($rs->fields['autor']);
    $ejemplar->setISBN($rs->fields['isbn']);
    $ejemplar->setTipomaterial($rs->fields['tipoMaterial']);
    $ejemplar->setClasificacion($rs->fields['clasificacion']);
    //$ejemplar->setEstatus($rs->fields['estatus']);
    $ejemplar->setId($rs->fields['id']);
    $ejemplar->setIdficha($rs->fields['idFicha']);
    $ejemplar->setFechaingreso($rs->fields['fechaIngreso']);
    $ejemplar->setNumadquisicion($rs->fields['numAdquisicion']);
    $ejemplar->setVolumen($rs->fields['volumen']);
    $ejemplar->setEjemplar($rs->fields['ejemplar']);
    $ejemplar->setTomo($rs->fields['tomo']);
    $ejemplar->setAccesible($rs->fields['accesible']);
    $ejemplar->setNoescuela($rs->fields['noEscuela']);
    $ejemplar->setFechaModificacion($rs->fields['fechaModificacion']);
    $ejemplar->setEnPrestamo($rs->fields['enPrestamo']!=0);

    return $ejemplar;

  }

  public function prestarEjemplar(Prestamo $prestamo){


    if($prestamo->getIdEjemplar()===null){ Throw new Exception("Requiere id de Ejemplar ".__METHOD__);}
    if($prestamo->getIdSolicitante()===null){ Throw new Exception("Requiere id de Solicitante".__METHOD__);}
    if($prestamo->getIdUsuario()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}
    if($prestamo->getIdPolitica()===null){ Throw new Exception("Requiere id de Politica ".__METHOD__);}


    $sql="Declare @mod int
		SET @mod=case when datepart(weekday,getdate())>3 and 1={$prestamo->getIdPolitica()} then 2 else 0 end;
				
		INSERT INTO cib.prestamo (idEjemplar, idSolicitante, idPolitica, estado, fechaSalida, fechaEntrega, renovaciones, idUsuario)
		select top 1 {$prestamo->getIdEjemplar()}, {$prestamo->getIdSolicitante()}, {$prestamo->getIdPolitica()}, 1, getdate(),
		(case 
			when datepart(weekday,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))=1 then dateadd(day,1,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))
			when datepart(weekday,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))=7 then dateadd(day,2,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))
			else DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0)  end), 0, {$prestamo->getIdUsuario()}
		FROM cib.politica WHERE id={$prestamo->getIdPolitica()} ";

    $ok=$this->db->Execute($sql);
    if($ok===false){
      $ex1=new Exception($this->db->ErrorMsg());
      Throw new Exception("Fallo la Ejecucion.  ".__METHOD__,null,$ex1);
    }
    $prestamo->setId($this->db->Insert_ID());

    $this->ValidardiasHabiles($prestamo);
    //if($rs->RecordCount()<1){ Throw new Exception("No se encontro resultado.  ".__METHOD__,1); }
  }

  public function ValidardiasHabiles(Prestamo $prestamo){
    if($prestamo->getId()===null){ Throw new Exception("Requiere id de Prestamo ".__METHOD__);}

    $sql="UPDATE p SET p.fechaEntrega=case 
			when datepart(weekday,fechaEntrega)=7 then dateadd(day,2,fechaEntrega)
			when datepart(weekday,fechaEntrega)=6 then dateadd(day,3,fechaEntrega)
			else dateadd(day,1,fechaEntrega) end
		from cib.prestamo p 
		inner join cib.diasnolaborables d on datediff(day, d.fecha, p.fechaEntrega) = 0
		where p.id={$prestamo->getId()} ";
    //pre($sql);
    $ok=$this->db->Execute($sql);
    if($ok===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la Ejecución.  ".__METHOD__,null,$ex1);}
    if($this->db->Affected_Rows()>0){
      $this->ValidardiasHabiles($prestamo);
    }

    //if($rs->RecordCount()<1){ Throw new Exception("No se encontro resultado.  ".__METHOD__,1); }
  }

  public Function RenovarPrestamo(Prestamo $prestamo){
    if($prestamo->getId()===null){ Throw new Exception("Requiere id de prestamo".__METHOD__);}
    if($prestamo->getIdUsuario()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}
    //if($prestamo->getIdPolitica()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}

    $sql="Declare @mod int
		
		
		select  @mod=case when datepart(weekday,getdate())>3  then 2 else 0 end
		FROM cib.prestamo p 
		inner join cib.politica po on po.id=p.idPolitica 
		WHERE p.id={$prestamo->getId()} and po.id=1;
		SET @mod = isnull(@mod,0)
				
		UPDATE cib.prestamo SET 
		renovaciones= p.renovaciones+1,-- fechaEntrega=DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0) 
		fechaEntrega=case 
			when datepart(weekday,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))=1 then dateadd(day,1,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))
			when datepart(weekday,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))=7 then dateadd(day,2,DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0))
			else DATEADD(DAY, DATEDIFF(DAY, 0, dateadd(d,dias+@mod,getdate())), 0)  end
		FROM cib.prestamo p 
		inner join cib.politica po on po.id=p.idPolitica 
		WHERE p.id={$prestamo->getId()}  and p.renovaciones <po.renovacion; ";
    //pre($sql);
    $ok=$this->db->Execute($sql);
    if($ok===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la Ejecución.  ".__METHOD__,null,$ex1);}
    if($this->db->Affected_Rows()<1){
      throw new Exception("No se puede renovar, supero el numero maximo de renovaciones");
    }
    $sql="INSERT INTO cib.prestamoRenovacion (idPrestamo, fecha, idUsuario) 
		values({$prestamo->getId()},getdate(),{$prestamo->getIdUsuario()})";
    $ok=$this->db->Execute($sql);

    if($ok===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la Ejecución(registro).  ".__METHOD__,null,$ex1);}
    $this->ValidardiasHabiles($prestamo);
  }

  public Function DevolverPrestamo(Prestamo $prestamo){
    if($prestamo->getId()===null){ Throw new Exception("Requiere id de prestamo".__METHOD__);}
    if($prestamo->getIdUsuario()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}
    //if($prestamo->getIdPolitica()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}

    $sql="UPDATE cib.prestamo SET	idUsuario={$prestamo->getIdUsuario()},fechaEntrada=getdate(),estado=0
		WHERE id={$prestamo->getId()} and estado=1";
    //pre($sql);
    $ok=$this->db->Execute($sql);
    if($ok===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la Ejecución.  ".__METHOD__,null,$ex1);}
    if($this->db->Affected_Rows()<1){
      throw new Exception("No se recibio nada");
    }

  }

  public function ListPrestamosPorUsuario(Usuario $usuario,$estado=1){
    if($usuario->getId()===null){ Throw new Exception("Requiere id de Usuario ".__METHOD__);}



    $sql="SELECT p.*,e.numAdquisicion,f.titulo,f.autor,politica=po.nombre
		FROM cib.prestamo p
		inner join cib.politica po on po.id=p.idPolitica
		inner join cib.ejemplar e on e.id=p.idEjemplar
		inner join cib.ficha f on f.id=e.idFicha 
		where p.idSolicitante={$usuario->getId()} and estado=$estado";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    //if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $lista=array();

    while(!$rs->EOF){
      $prestamo=new Prestamo();
      $prestamo->setId($rs->fields['id']);
      $prestamo->setIdejemplar($rs->fields['idEjemplar']);
      $prestamo->setIdsolicitante($rs->fields['idSolicitante']);
      $prestamo->setIdpolitica($rs->fields['idPolitica']);
      $prestamo->setEstado($rs->fields['estado']);
      $prestamo->setFechasalida($rs->fields['fechaSalida']);
      $prestamo->setFechaentrega($rs->fields['fechaEntrega']);
      $prestamo->setFechaEntrada($rs->fields['fechaEntrada']);
      $prestamo->setRenovaciones($rs->fields['renovaciones']);
      $prestamo->setIdusuario($rs->fields['idUsuario']);
      $prestamo->ejemplar->setNumAdquisicion($rs->fields['numAdquisicion']);
      if($rs->fields["autor"]!=null){ $prestamo->ejemplar->setAutor($rs->fields['autor']); }
      if($rs->fields["titulo"]!=null){ $prestamo->ejemplar->setTitulo($rs->fields['titulo']); }

      $prestamo->politica->setNombre($rs->fields["politica"]);
      $lista[$prestamo->getId()]=$prestamo;
      $rs->MoveNext();
    }

    return $lista;
  }


  public function Politica(Politica $politica){
    if($politica->getId()===null){ Throw new Exception("Requiere id ".__METHOD__);}

    $sql="select * from cib.politica where id={$politica->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $politica->setNombre($rs->fields["nombre"]);
    $politica->setDias($rs->fields["dias"]);
    $politica->setLibros($rs->fields["libros"]);
    $politica->setRenovacion($rs->fields["renovacion"]);
    $politica->setId($rs->fields["id"]);

    return $politica;
  }

  public function ListaRenovaciones(Prestamo $prestamo){
    if($prestamo->getId()===null){ Throw new Exception("Requiere id de prestamo".__METHOD__);}

    $sql="select pr.*,p.nombre,p.apellido_paterno,p.apellido_materno 
		from cib.prestamoRenovacion	pr inner join persona p on p.cve_persona=pr.idUsuario 
		where idPrestamo={$prestamo->getId()}";

    //pre($sql);
    $rs=$this->db->Execute($sql);

    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    //if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $lista=array();

    while(!$rs->EOF){
      $renovacion=new PrestamoRenovacion();
      $renovacion->setId($rs->fields['id']);
      $renovacion->setIdPrestamo($rs->fields['idPrestamo']);
      $renovacion->setFecha($rs->fields['fecha']);
      $renovacion->setIdusuario($rs->fields['idUsuario']);
      $renovacion->usuario->setNombre($rs->fields["nombre"]);
      $renovacion->usuario->setApellido_paterno($rs->fields["apellido_paterno"]);
      $renovacion->usuario->setApellido_materno($rs->fields["apellido_materno"]);

      $lista[$renovacion->getId()]=$renovacion;
      $rs->MoveNext();
    }

    return $lista;

  }

  public function Perfil(Perfil $perfil){
    if($perfil->getId()===null){ Throw new Exception("Requiere id ".__METHOD__);}

    $sql="select * from cib.perfil where id={$perfil->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $perfil->setNombre($rs->fields["nombre"]);
    $perfil->setLibros($rs->fields["libros"]);
    $perfil->setId($rs->fields["id"]);

    return $perfil;
  }

  public function ArrayLibrosEnPrestamo(){
    //$sql="select * from cib.rpt_LibrosEnPrestamo";

    // Consulta nueva incluyendo especialidad
    $sql = "select * from cib.rpt_LibrosEnPrestamo lp LEFT OUTER JOIN
					(SELECT ag.matricula as Alumno, ec.nombre AS Especialidad
					FROM dbo.alumno_grupo AS ag INNER JOIN
					dbo.grupo AS g ON g.cve_grupo = ag.cve_grupo INNER JOIN
					dbo.carrera AS ca ON ca.cve_carrera = g.cve_carrera left outer JOIN
					dbo.especialidad_carrera ec on ca.cve_carrera = ec.cve_carrera and ec.cve_especialidad = g.cve_especialidad INNER JOIN
					    (SELECT        matricula, MAX(cve_periodo) AS cve_periodo
							FROM            dbo.inscripcion
							GROUP BY matricula) AS ins ON ins.matricula = ag.matricula AND g.cve_periodo = ins.cve_periodo) 
						AS gpo ON gpo.Alumno = cuenta";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    return $rs->getArray();
  }
  public function ArrayActivosEnPrestamo(){
    //$sql="select * from cib.rpt_ActivosEnPrestamo";

    // Consulta nueva incluyendo especialidad
    $sql = "select * from cib.rpt_ActivosEnPrestamo ap LEFT OUTER JOIN
				(SELECT ag.matricula as Alumno, ec.nombre AS Especialidad
					FROM dbo.alumno_grupo AS ag INNER JOIN
					dbo.grupo AS g ON g.cve_grupo = ag.cve_grupo INNER JOIN
					dbo.carrera AS ca ON ca.cve_carrera = g.cve_carrera left outer JOIN
					dbo.especialidad_carrera ec on ca.cve_carrera = ec.cve_carrera and ec.cve_especialidad = g.cve_especialidad INNER JOIN
					    (SELECT        matricula, MAX(cve_periodo) AS cve_periodo
							FROM            dbo.inscripcion
							GROUP BY matricula) AS ins ON ins.matricula = ag.matricula AND g.cve_periodo = ins.cve_periodo) 
						AS gpo ON gpo.Alumno = cuenta";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    return $rs->getArray();
  }
  public function ArrayActivosHistorico(){
    //$sql="select * from cib.rpt_ActivosPrestamoHistorico";

    // Consulta nueva incluyendo especialidad
    $sql = "select * from cib.rpt_ActivosPrestamoHistorico aph left outer join
				(SELECT ag.matricula as Alumno, ec.nombre AS Especialidad
					FROM dbo.alumno_grupo AS ag INNER JOIN
					dbo.grupo AS g ON g.cve_grupo = ag.cve_grupo INNER JOIN
					dbo.carrera AS ca ON ca.cve_carrera = g.cve_carrera left outer JOIN
					dbo.especialidad_carrera ec on ca.cve_carrera = ec.cve_carrera and ec.cve_especialidad = g.cve_especialidad INNER JOIN
					    (SELECT        matricula, MAX(cve_periodo) AS cve_periodo
							FROM            dbo.inscripcion
							GROUP BY matricula) AS ins ON ins.matricula = ag.matricula AND g.cve_periodo = ins.cve_periodo) 
						AS gpo ON gpo.Alumno = cuenta";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    return $rs->getArray();
  }

  public function ArrayLibrosEnPrestamoVencidos(){
    //$sql="select * from cib.rpt_LibrosEnPrestamo where dateadd(day,1,[Fecha de Entrega])< getdate() ";

    // Consulta nueva incluyendo especialidad
    $sql = "select * from cib.rpt_LibrosEnPrestamo lp LEFT OUTER JOIN
					(SELECT ag.matricula as Alumno, ec.nombre AS Especialidad
					FROM dbo.alumno_grupo AS ag INNER JOIN
					dbo.grupo AS g ON g.cve_grupo = ag.cve_grupo INNER JOIN
					dbo.carrera AS ca ON ca.cve_carrera = g.cve_carrera left outer JOIN
					dbo.especialidad_carrera ec on ca.cve_carrera = ec.cve_carrera and ec.cve_especialidad = g.cve_especialidad INNER JOIN
					    (SELECT        matricula, MAX(cve_periodo) AS cve_periodo
							FROM            dbo.inscripcion
							GROUP BY matricula) AS ins ON ins.matricula = ag.matricula AND g.cve_periodo = ins.cve_periodo) 
						AS gpo ON gpo.Alumno = cuenta
				where dateadd(day,1,[Fecha de Entrega])< getdate()";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    return $rs->getArray();
  }



  public function busquedaFicha(Ejemplar $ejemplar,$tipo){
    //$this->db->debug=true;
    $filtro="";
    switch ($tipo){
      case "Titulo":
        $palabras=explode(" ", $ejemplar->getTitulo());
        $and="";
        foreach($palabras as $palabra){
          $filtro.=$and." f.titulo like '%$palabra%' ";$and="and";
        }

        break;
      case "NumAdquisicion":
        $filtro="e.numAdquisicion='{$ejemplar->getNumAdquisicion()}'";
        break;
      case "IdFicha":
        $filtro="f.id={$ejemplar->getIdFicha()} ";
        break;
      default:
        Throw new Exception("No existe un mecanismo para la busqueda de esta opcion  ".__METHOD__,null);
        break;
    }

    $sql="select e.*,f.id as fichaId, esborrable=isnull(p.idEjemplar,0), 
		f.autor,f.titulo,f.isbn,f.tipoMaterial,f.clasificacion,etiquetasMarc=CAST(f.etiquetasMarc AS TEXT) ,f.coleccion_no,
		enPrestamo=isnull(p.id,0)
		from  cib.ficha f  left outer join cib.ejemplar e on e.idFicha = f.id 
		left outer join cib.prestamo p on p.idEjemplar= e.id and p.estado=1
		where $filtro ";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    $listado= array();
    $ficha= new Ficha();
    $ficha->setId($rs->fields["fichaId"]);
    $ficha->setTitulo($rs->fields['titulo']);
    $ficha->setAutor($rs->fields['autor']);
    $ficha->setISBN($rs->fields['isbn']);
    $ficha->setTipomaterial($rs->fields['tipoMaterial']);
    $ficha->setClasificacion($rs->fields['clasificacion']);
    $etiquetasMARC=new EtiquetasMARC($rs->fields["etiquetasMarc"]);

    $ficha->setEtiquetasMARC($etiquetasMARC);


    while (!$rs->EOF){
      $ejemplar = new Ejemplar();


      $ejemplar->setTitulo($rs->fields['titulo']);
      $ejemplar->setAutor($rs->fields['autor']);
      $ejemplar->setISBN($rs->fields['isbn']);
      $ejemplar->setTipomaterial($rs->fields['tipoMaterial']);
      $ejemplar->setClasificacion($rs->fields['clasificacion']);
      //$ejemplar->setEstatus($rs->fields['estatus']);
      if($rs->fields["id"]!=null){
        $ejemplar->setId($rs->fields['id']);
        $ejemplar->setIdficha($rs->fields['idFicha']);
        $ejemplar->setFechaingreso($rs->fields['fechaIngreso']);
        $ejemplar->setNumadquisicion($rs->fields['numAdquisicion']);
        $ejemplar->setVolumen($rs->fields['volumen']);
        $ejemplar->setEjemplar($rs->fields['ejemplar']);
        $ejemplar->setTomo($rs->fields['tomo']);
        $ejemplar->setAccesible($rs->fields['accesible']);
        $ejemplar->setNoescuela($rs->fields['noEscuela']);
        $ejemplar->setFechaModificacion($rs->fields['fechaModificacion']);
        $ejemplar->setEsBorrable($rs->fields["esborrable"]==0);
        $ejemplar->setEnPrestamo($rs->fields['enPrestamo']!=0);


        $ficha->ejemplares[]=$ejemplar;
      }
      $rs->MoveNext();


    }
    return $ficha;
  }


  public function Ficha(Ficha &$ficha){
    $sql="select * from cib.ficha WHERE id={$ficha->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $fichecita=new Ficha();
    $fichecita->setId($rs->fields['id']);

    return $fichecita;
  }

  public function editarFicha(Ficha $ficha){
    //$this->db->debug=true;
    $sql="UPDATE cib.ficha SET
		titulo={$this->db->qStr($ficha->getTitulo())}, autor= {$this->db->qStr ($ficha->getAutor())}, isbn= {$this->db->qStr ($ficha->getISBN())}, fechaMod=getdate(), 
		clasificacion={$this->db->qStr ($ficha->getClasificacion())},
		etiquetasMARC={$this->db->qStr ($ficha->getEtiquetasMARC()->__toString())}
		WHERE id={$ficha->getId()}";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}

  }

  public function agregarFicha(Ficha $ficha){

    if($ficha->getTitulo()==null){ throw new Exception("Requiere el titulo para agregar una nueva ficha");}
    if($ficha->getAutor()==null){ throw new Exception("Requiere el autor para agregar una neva ficha ");}
    if($ficha->getISBN()==null){ throw new Exception("Requiere el ISBN para agregar una ficha nueva");}
    if($ficha->getClasificacion()==null){ throw new Exception("Requiere la clasificacion LC para agregar una ficha nueva ");}

    //$this->db->debug=true;
    $sql="insert into cib.ficha (titulo,autor,isbn, fechaMod, clasificacion, etiquetasMARC )
			values (".$this->db->qStr($ficha->getTitulo()).", ".$this->db->qStr($ficha->getAutor()).",".$this->db->qStr($ficha->getISBN()).",
		   	    	".$this->db->qStr($ficha->getFechaMod()).", ".$this->db->qStr($ficha->getClasificacion()).",".$this->db->qStr($ficha->getEtiquetasMARC()).")";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}


  }
  public function Ejemplar(Ejemplar &$ejemplar){
    $sql="  select *
                from cib.ejemplar
                WHERE id={$ejemplar->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $ejemplar= new Ejemplar();
    $ejemplar->setId($rs->fields['id']);
    $ejemplar->setIdficha($rs->fields['idFicha']);
    $ejemplar->setFechaingreso($rs->fields['fechaIngreso']);
    $ejemplar->setNumadquisicion($rs->fields['numAdquisicion']);
    $ejemplar->setVolumen($rs->fields['volumen']);
    $ejemplar->setEjemplar($rs->fields['ejemplar']);
    $ejemplar->setTomo($rs->fields['tomo']);
    $ejemplar->setAccesible($rs->fields['accesible']);
    $ejemplar->setNoescuela($rs->fields['noEscuela']);
    $ejemplar->setFechaModificacion($rs->fields['fechaModificacion']);


    return $ejemplar;

  }
  public function editarEjemplar(Ejemplar $ejemplar){
    $sql= "UPDATE cib.ejemplar SET 
				numAdquisicion='{$ejemplar->getNumAdquisicion()}', tomo={$ejemplar->getTomo()}, volumen={$ejemplar->getVolumen()}, ejemplar={$ejemplar->getEjemplar()}, accesible={$ejemplar->getAccesible()}
		WHERE id={$ejemplar->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}

  }

  public function agregarEjemplar(Ejemplar $ejemplar){

    if($ejemplar->getNumAdquisicion()==null){ throw new Exception("Requiere numero de adquisición del ejemplar");}
    if($ejemplar->getTomo()==null){ throw new Exception("Requiere tomo para poder agregar un ejemplar nuevo ");}
    if($ejemplar->getVolumen()==null){ throw new Exception("Requiere volumen para poder agregar un ejemplar nuevo  ");}
    if($ejemplar->getEjemplar()==null){ throw new Exception("Requiere ejemplar para poder agregar un ejemplar nuevo  ");}
    if($ejemplar->getAccesible()==null){ throw new Exception("Requiere accesibilidad para poder agregar un ejemplar nuevo ");}


    $sql="insert into cib.ejemplar ( idFicha, numAdquisicion, tomo, volumen , ejemplar, accesible )
			values ( ".$ejemplar->getIdFicha().",'".$ejemplar->getNumAdquisicion()."', ".$ejemplar->getTomo().",".$ejemplar->getVolumen().",
		   	    	".$ejemplar->getEjemplar().", ".$ejemplar->getAccesible().")";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}

  }

  public function borrarEjemplar(Ejemplar $ejemplar){
    $sql="DELETE FROM cib.ejemplar WHERE id={$ejemplar->getId()}" ;
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
  }

  public function listaTitulos(Ficha $ficha){

    $filtro="";
    $palabras=explode(" ", $ficha->getTitulo());
    $and="";
    foreach($palabras as $palabra){
      $filtro.=$and." f.titulo like '%$palabra%' ";$and="and";
    }

    $sql="Select f.id, f.autor,f.titulo,f.isbn from cib.ficha f where $filtro";
    //echo $sql;
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}

    $lista=array();

    while(!$rs->EOF){

      $listado= array();
      $ficha= new Ficha();
      $ficha->setId($rs->fields["id"]);
      $ficha->setISBN($rs->fields['isbn']);
      $ficha->setTitulo($rs->fields['titulo']);

      $lista[$ficha->getId()]=$ficha;
      $rs->MoveNext();
    }

    return $lista;

  }

  public function busquedaLibro(Ficha $ficha,$tipo){
    //$this->db->debug=true;
    $filtro="";
    switch ($tipo){
      case "Titulo":
        $palabras=explode(" ", $ficha->getTitulo());
        $and="";
        foreach($palabras as $palabra){
          $filtro.=$and." f.titulo like '%$palabra%' ";$and="and";
        }

        break;

      case "Autor":
        $frases=explode(" ", $ficha->getAutor());
        $and="";
        foreach($frases as $frase){
          $filtro.=$and." f.autor like '%$frase%' ";$and="and";
        }
        break;

      case "ISBN":
        $filtro="f.ISBN='{$ficha->getISBN()}' ";
        break;

      case "NumAdquisicion":
        $filtro="f.numAdquisicion='{$ficha->getnumAdquisicion()}'";
        break;

      default:
        Throw new Exception("No existe un mecanismo para la busqueda de esta opcion  ".__METHOD__,null);
        break;
    }

    $sql="Select f.id, f.autor,f.titulo,f.isbn, e.numAdquisicion from cib.ficha f left outer join cib.ejemplar e on e.idFicha = f.id  where $filtro";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }
    $lista=array();

    while(!$rs->EOF){

      $listado= array();
      $ficha= new Ficha();
      $ficha->setId($rs->fields["id"]);
      $ficha->setAutor($rs->fields["autor"]);
      $ficha->setISBN($rs->fields['isbn']);
      $ficha->setTitulo($rs->fields['titulo']);

      $lista[$ficha->getId()]=$ficha;
      $rs->MoveNext();
    }

    return $lista;
  }
  public function actualizarFecha(Prestamo $prestamo){
    $sql="UPDATE cib.prestamo SET
		fechaEntrega='{$prestamo->getFechaEntrega()}'
		WHERE id={$prestamo->getId()}";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}


  }
  public function buscarEjemplar (Ejemplar $ejemplar){
    $sql="SELECT * FROM cib.ejemplar WHERE numAdquisicion='{$ejemplar->getNumAdquisicion()}'";
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ return true; }
    return false;
  }
  /**
   *
   * @param Ejemplar Tal Vez se deba borrar esta funcion
   * @param string $por
   * @throws Exception
   * @return Ejemplar
   */
  public function Libro(Ejemplar $ejemplar, $por="id"){
    if($por=="id" && $ejemplar->getId()===null){ Throw new Exception("Requiere id ".__METHOD__);}
    if($por=="numAdquisicion" && $ejemplar->getNumAdquisicion()===null){ Throw new Exception("Requiere # de Adquisición ".__METHOD__);}

    $filtro="";
    if($por=="id"){	$filtro="e.id={$ejemplar->getId()}"; }
    if($por=="numAdquisicion"){	$filtro="e.numAdquisicion='{$ejemplar->getNumAdquisicion()}'"; }
    //@fixme actualizar registros de tabla
    $sql="SELECT  e.*,f.autor,f.titulo,f.isbn,f.tipoMaterial,f.clasificacion
		,enPrestamo=isnull(p.id,0)
		FROM cib.ejemplar e
		inner join cib.ficha f on f.id=e.idFicha
		left outer join cib.prestamo p on p.idEjemplar =e.id and p.estado=1
		WHERE $filtro ";

    //pre($sql);

    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontraron registros.  ".__METHOD__,1); }

    $ejemplar->setTitulo($rs->fields['titulo']);
    $ejemplar->setAutor($rs->fields['autor']);
    $ejemplar->setISBN($rs->fields['isbn']);
    $ejemplar->setTipomaterial($rs->fields['tipoMaterial']);
    $ejemplar->setClasificacion($rs->fields['clasificacion']);
    //$ejemplar->setEstatus($rs->fields['estatus']);
    $ejemplar->setId($rs->fields['id']);
    $ejemplar->setIdficha($rs->fields['idFicha']);
    $ejemplar->setFechaingreso($rs->fields['fechaIngreso']);
    $ejemplar->setNumadquisicion($rs->fields['numAdquisicion']);
    $ejemplar->setVolumen($rs->fields['volumen']);
    $ejemplar->setEjemplar($rs->fields['ejemplar']);
    $ejemplar->setTomo($rs->fields['tomo']);
    $ejemplar->setAccesible($rs->fields['accesible']);
    $ejemplar->setNoescuela($rs->fields['noEscuela']);
    $ejemplar->setFechaModificacion($rs->fields['fechaModificacion']);
    $ejemplar->setEnPrestamo($rs->fields['enPrestamo']!=0);

    return $ejemplar;

  }

  public function PrestamoPorAdquisicion(Prestamo $prestamo,$estado=1){
    if($prestamo->ejemplar->getNumAdquisicion()===null){ Throw new Exception("Requiere el Numero de Adquisición ".__METHOD__);}

    $sql="SELECT p.*,e.numAdquisicion,f.titulo,f.autor,politica=po.nombre
		FROM cib.prestamo p
		inner join cib.politica po on po.id=p.idPolitica
		inner join cib.ejemplar e on e.id=p.idEjemplar
		inner join cib.ficha f on f.id=e.idFicha
		where e.numAdquisicion='{$prestamo->ejemplar->getNumAdquisicion()}' and estado=$estado";
    //pre($sql);
    $rs=$this->db->Execute($sql);
    if($rs===false){ $ex1=new Exception($this->db->ErrorMsg()); Throw new Exception("Falló la consulta.  ".__METHOD__,null,$ex1);}
    if($rs->RecordCount()<1){ Throw new Exception("No se encontró registro en prestamo.  ".__METHOD__,1); }


    $prestamo=new Prestamo();
    $prestamo->setId($rs->fields['id']);
    $prestamo->setIdejemplar($rs->fields['idEjemplar']);
    $prestamo->setIdsolicitante($rs->fields['idSolicitante']);
    $prestamo->setIdpolitica($rs->fields['idPolitica']);
    $prestamo->setEstado($rs->fields['estado']);
    $prestamo->setFechasalida($rs->fields['fechaSalida']);
    $prestamo->setFechaentrega($rs->fields['fechaEntrega']);
    $prestamo->setFechaEntrada($rs->fields['fechaEntrada']);
    $prestamo->setRenovaciones($rs->fields['renovaciones']);
    $prestamo->setIdusuario($rs->fields['idUsuario']);
    $prestamo->ejemplar->setNumAdquisicion($rs->fields['numAdquisicion']);
    if($rs->fields["autor"]!=null){ $prestamo->ejemplar->setAutor($rs->fields['autor']); }
    if($rs->fields["titulo"]!=null){ $prestamo->ejemplar->setTitulo($rs->fields['titulo']); }

    $prestamo->politica->setNombre($rs->fields["politica"]);

    return $prestamo;
  }



}

?>