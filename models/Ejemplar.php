<?php

class Ejemplar extends Ficha {	
	/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
	/* CLASE PARA MANEJAR EJEMPLARES */
	/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
	
	/* ------------------------------------------------------------------------ */
	/* ------------------------------------------------------------------------ */
	/* ----------- ESTAS VARIABLES SON HEREDADAS,  N O   M O V E R  ----------- */
	private $id, $idFicha, $fechaIngreso, $numAdquisicion, $volumen, $ejemplar, $tomo, $accesible, $noEscuela, $fechaModificacion;
	private $enPrestamo;	
	public $ficha;
	/* ------------------------------------------------------------------------ */
	/* ------------------------------------------------------------------------ */
	/* ------------------------------------------------------------------------ */

	
	public function mostrarEjemplares(){
		/* ESTA FUNCION NO LA VOY A UTILIZAR */
		$this->cib = new CIB();
	
		$sql = "select idFicha, numAdquisicion, f.titulo, f.autor, f.clasificacion
				from cib.ejemplar e
				inner join cib.ficha f on f.id=e.idFicha
		";
		$rs = $this->db->Execute($sql);
	
		$tabla = $this->cib->getEjemplar($rs);
		return $tabla;
	}
	
	
	public function addEjemplar($data){
		$this->cib = new CIB();
		
		$idFicha = $data['idFicha'];
		$adquisicion = $data['adq'];
		$tomo = $data['tomo'];
		$volumen = $data['volumen'];
		$accesible = $data['accesible'];
		
		$sql = "insert into cib.ejemplar(idFicha, numAdquisicion, volumen, tomo, accesible) values($idFicha,'".$adquisicion."','".$volumen."','".$tomo."',$accesible)";
		
		$existeADQ = $this->adqRepetido($idFicha, $adquisicion);
		
		
		if($existeADQ == ''){
			// COMENTAR LA SIGUIENTE LINEA PARA HACER PRUEBAS
			$rs = $this->db->Execute($sql);
			// ----------------------------------------------
				
			return $this->db->insert_id();			
		}else{
			return 0;
		}
	}
	
	public function adqRepetido($idFicha, $adq){
		$this->cib = new CIB();
		
		$sql = "select id from cib.ejemplar where idFicha = {$idFicha} and numAdquisicion = '{$adq}'				
		";
		$rs = $this->db->Execute($sql);
		return $rs->fields['id'];
	}
	
	public function deleteEjemplar($sql,$id){
		$this->cib = new CIB();
		
		$rs = $this->db->Execute($sql);
		
		return "<span class=\"green\">ID: ${id} </span><span class=\"tomato\">Eliminado</span>";
		
	}
	
	public function mostrarEjemplarById($ide){
		$this->cib = new CIB();
	
		$sql = "select id, numAdquisicion, tomo, volumen, accesible from cib.ejemplar where id =  {$ide}";
		$rs = $this->db->Execute($sql);
	
		return $rs->getArray();
	}
	
	public function mostrarEjemplaresByIdFicha($idf){
		$this->cib = new CIB();
	
		$sql = "select numAdquisicion, volumen, tomo, accesible from cib.ejemplar where idFicha = {$idf}";
		$rs = $this->db->Execute($sql);
	
		return $rs->getArray();
	}
	
	public function update($sql){
		$this->cib = new CIB();
	
		$rs = $this->db->Execute($sql);
		return true;
	}
	
	
	/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
	/* @@ ESTO DE ABAJO ES CODIGO HEREDADO @@ */
	/* @@ ----------- NO MOVER ----------- @@ */
	/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

	public function esPrestable(){
		if($this->accesible==1){ return true;}
		if($this->accesible==3){ return true;}
		return false;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $idFicha
	 */
	public function getIdFicha() {
		return $this->idFicha;
	}

	/**
	 * @return the $fechaIngreso
	 */
	public function getFechaIngreso() {
		return $this->fechaIngreso;
	}

	/**
	 * @return the $numAdquisicion
	 */
	public function getNumAdquisicion() {
		return $this->numAdquisicion;
	}

	/**
	 * @return the $volumen
	 */
	public function getVolumen() {
		return $this->volumen;
	}

	/**
	 * @return the $ejemplar
	 */
	public function getEjemplar() {
		return $this->ejemplar;
	}

	/**
	 * @return the $tomo
	 */
	public function getTomo() {
		return $this->tomo;
	}

	/**
	 * @return the $accesible
	 */
	public function getAccesible() {
		return $this->accesible;
	}

	/**
	 * @return the $noEscuela
	 */
	public function getNoEscuela() {
		return $this->noEscuela;
	}

	/**
	 * @return the $fechaModificacion
	 */
	public function getFechaModificacion() {
		return $this->fechaModificacion;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $idFicha
	 */
	public function setIdFicha($idFicha) {
		$this->idFicha = $idFicha;
	}

	/**
	 * @param field_type $fechaIngreso
	 */
	public function setFechaIngreso($fechaIngreso) {
		$this->fechaIngreso = $fechaIngreso;
	}

	/**
	 * @param field_type $numAdquisicion
	 */
	public function setNumAdquisicion($numAdquisicion) {
		$this->numAdquisicion = $numAdquisicion;
	}

	/**
	 * @param field_type $volumen
	 */
	public function setVolumen($volumen) {
		$this->volumen = $volumen;
	}

	/**
	 * @param field_type $ejemplar
	 */
	public function setEjemplar($ejemplar) {
		$this->ejemplar = $ejemplar;
	}

	/**
	 * @param field_type $tomo
	 */
	public function setTomo($tomo) {
		$this->tomo = $tomo;
	}

	/**
	 * @param field_type $accesible
	 */
	public function setAccesible($accesible) {
		$this->accesible = $accesible;
	}

	/**
	 * @param field_type $noEscuela
	 */
	public function setNoEscuela($noEscuela) {
		$this->noEscuela = $noEscuela;
	}

	/**
	 * @param field_type $fechaModificacion
	 */
	public function setFechaModificacion($fechaModificacion) {
		$this->fechaModificacion = $fechaModificacion;
	}

	/**
	 *
	 * @return void
	 *
	 */
	public function __construct($id=NULL) {
		parent::__construct ();
		if($id!==NULL){
			$this->setId($id);	
		}
	}
	/**
	 * @return the $enPrestamo
	 */
	public function getEnPrestamo() {
		return $this->enPrestamo;
	}

	/**
	 * @param field_type $enPrestamo
	 */
	public function setEnPrestamo($enPrestamo) {
		$this->enPrestamo = $enPrestamo;
	}

}

?>