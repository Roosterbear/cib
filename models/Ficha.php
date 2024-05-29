<?php
class Ficha extends \CI_Model {
	/* @@@@@@@@@@@@@@@@@@@@@@@@@ */
	/* CLASE PARA MANEJAR FICHAS */
	/* @@@@@@@@@@@@@@@@@@@@@@@@@ */

	private $Id, $titulo, $autor, $ISBN, $fecha, $fechaMod, $datosFijos, $etiquetasMARC, $tipoMaterial, $clasificacion, $estatus, $coleccion_No;
	public $cib;
	
	public function __construct() {
		parent::__construct ();		
		$this->load->library("CIB");
	}

	/* ------------------- */
	/* ----- FICHERO ----- */
	/* ------------------- */
	public function buscarLibro($busqueda,$autor){
		if ($busqueda == '' || $busqueda == ' ') return '';
		$this->cib = new CIB();
				
		$sqlTitulo = "select id, titulo, autor, clasificacion from cib.ficha where titulo like '%".$busqueda."%'";
		$sqlAutor = "select id, titulo, autor, clasificacion from cib.ficha where autor like '%".$busqueda."%'";
		$rs = $autor?$this->db->Execute($sqlAutor):$this->db->Execute($sqlTitulo);
		
		$tabla = $this->cib->getBook($rs->getArray());
		return $tabla;		
	}
	
	public function addFicha($data){
			
		$titulo = $data['titulo'];
		$autor = $data['autor'];
		$isbn = $data['isbn'];
		$clasificacion = $data['clasificacion'];
			
		$sql = "insert into cib.ficha(titulo, autor, ISBN, clasificacion) values('".$titulo."','".$autor."','".$isbn."','".$clasificacion."')";
		$rs = $this->db->Execute($sql);
	
		return $this->db->insert_id();	
	}
	
	public function delete($sql,$id){
		if(!$this->fichaIsFree($id)){
			//$rs = $this->db->Execute($sql);
			return "<strong>ID: <u>$id</u> <span>ELIMINADO</span></strong>";
		}else{
			return "<strong>ID: <span>$id</span> <u>NO eliminado</u> por contener ejemplares</strong>";
		}
	}
	
	public function fichaIsFree($id){
		$this->cib = new CIB();
		$sql = "select top(1) id from cib.ejemplar where idFicha = (select id from cib.ficha where id = $id)";
		$rs = $this->db->Execute($sql);
		return $rs->fields['id'];
	
	}
	
	
	/* ------------------------ */
	/* ----- CAMBIO FICHA ----- */
	/* ------------------------ */	
	
	public function buscarLibroCambio($busqueda,$autor){
		if ($busqueda == '' || $busqueda == ' ') return '';
		$this->cib = new CIB();
	
		$sqlTitulo = "select id, titulo, autor, clasificacion, isbn from cib.ficha where titulo like '%".$busqueda."%'";
		$sqlAutor = "select id, titulo, autor, clasificacion, isbn from cib.ficha where autor like '%".$busqueda."%'";
		$rs = $autor?$this->db->Execute($sqlAutor):$this->db->Execute($sqlTitulo);
	
		$tabla = $this->cib->getBookCambio($rs->getArray());
		return $tabla;
	}
	
	public function mostrarFichas(){
		$this->cib = new CIB();
		
		$sql = "select id, titulo, autor, isbn, clasificacion from cib.ficha";
		$rs = $this->db->Execute($sql);
		
		$tabla = $this->cib->getFicha($rs);
		return $tabla;
	}
	
	public function mostrarFichasById($id){
		$this->cib = new CIB();
		
		$sql = "select id, titulo, autor, isbn, clasificacion from cib.ficha where id = {$id}";
		$rs = $this->db->Execute($sql);	
		
		return $rs->getArray();
	}
	
	public function execSQL($sql){
		$this->cib = new CIB();
		$rs = $this->db->Execute($sql);
				
		return $this->cib->getOneFicha($rs->getArray());
		 
	}
	
	public function execSQLFichaEjemplar($sql){
		$this->cib = new CIB();
		$rs = $this->db->Execute($sql);
	
		return $this->cib->getFichaEjemplares($rs->getArray());
			
	}
	
	public function execSQLFichaEjemplarBorrar($sql){
		$this->cib = new CIB();
		$rs = $this->db->Execute($sql);
	
		return $this->cib->getFichaEjemplaresBorrar($rs->getArray());
			
	}
	
	public function getIdFromISBNFicha($isbn){
		$this->cib = new CIB();
		$sql = "select id from cib.ficha where ISBN = '$isbn'";
		$rs = $this->db->Execute($sql);
		return $rs->fields['id'];
	}
		
	public function update($sql){
		$this->cib = new CIB();
						
		$rs = $this->db->Execute($sql);
		return true;
	}
	
	
	
	/* ------------------- */
	/* ----- GETTERS ----- */
	/* ------------------- */
	public function getId() {
		return $this->Id;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getAutor() {
		return $this->autor;
	}

	public function getISBN() {
		return $this->ISBN;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function getFechaMod() {
		return $this->fechaMod;
	}

	public function getDatosFijos() {
		return $this->datosFijos;
	}

	public function getEtiquetasMARC() {
		return $this->etiquetasMARC;
	}

	public function getTipoMaterial() {
		return $this->tipoMaterial;
	}

	public function getClasificacion() {
		return $this->clasificacion;
	}

	public function getEstatus() {
		return $this->estatus;
	}

	
	/* ------------------- */
	/* ----- SETTERS ----- */
	/* ------------------- */
	public function setId($Id) {
		$this->Id = $Id;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setAutor($autor) {
		$this->autor = $autor;
	}

	public function setISBN($ISBN) {
		$this->ISBN = $ISBN;
	}

	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function setFechaMod($fechaMod) {
		$this->fechaMod = $fechaMod;
	}

	public function setDatosFijos($datosFijos) {
		$this->datosFijos = $datosFijos;
	}

	public function setEtiquetasMARC($etiquetasMARC) {
		$this->etiquetasMARC = $etiquetasMARC;
	}

	public function setTipoMaterial($tipoMaterial) {
		$this->tipoMaterial = $tipoMaterial;
	}

	public function setClasificacion($clasificacion) {
		$this->clasificacion = $clasificacion;
	}

	public function setEstatus($estatus) {
		$this->estatus = $estatus;
	}

}

?>