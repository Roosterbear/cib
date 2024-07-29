<?php
class Libros extends \CI_Controller{
	/* --------------------------------------------- */
	/* ESTE ES EL CONTROLADOR PARA EL ABC DE LIBROS */
	/* ------------------------------------------- */	
	public $ficha, $ejemplar;
	
	public function __construct(){
		parent:: __construct();	
		$this->load->model("Ficha");
		$this->load->model("Ejemplar");
		/*
		$this->load->library("UsuarioSITO",null,"usuario");
		
		$this->usuario->setUsername(@$_REQUEST["uid"]);
		$this->usuario->setSitoSession(@$_REQUEST["sid"]);
		
		if(!$this->usuario->login()){
			show_error("La session ha caducado o esta entrando con un usuario no valido",500,"Acceso Denegado");		
		}
		*/
		
	}
	
	/* ************************************** */
	/*       MANEJADORES DE VISTAS           */
	/* ************************************ */
	
	public function index(){			
		$data['ficha'] = 'selected-tab';
		$data['ocultarFicha'] = 0;
		$data['ocultarEjemplar'] = 1; 
		
		$this->load->view("header");		
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/fichaVw");
		$this->load->view("footer");
	}
	
	/* ------- FICHA ------- */
	public function getFicha(){
		$data['ficha'] = 'selected-tab';
		$data['ocultarFicha'] = 0;
		$data['ocultarEjemplar'] = 1;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);		
		$this->load->view("/admin/fichaVw");
		$this->load->view("footer");
	}
	
	public function altaFicha(){
		$data['ficha'] = 'selected-tab';
		$data['altaFicha'] = 'selected-tab';
		$data['ocultarFicha'] = 0;
		$data['ocultarEjemplar'] = 1;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/altaFichaVw");
		$this->load->view("footer");
	}
	
	public function bajaFicha(){
		$data['ficha'] = 'selected-tab';
		$data['bajaFicha'] = 'selected-tab';
		$data['ocultarFicha'] = 0;
		$data['ocultarEjemplar'] = 1;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/bajaFichaVw");
		$this->load->view("footer");
	}
	
	public function cambioFicha(){		
		$data['ficha'] = 'selected-tab';		
		$data['cambioFicha'] = 'selected-tab';
		$data['ocultarFicha'] = 0;
		$data['ocultarEjemplar'] = 1;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/cambioFichaVw");
		$this->load->view("footer");
	}
	
	/* ----- EJEMPLAR ----- */
	public function getEjemplar(){		
		$data['ejemplar'] = 'selected-tab';
		$data['ocultarFicha'] = 1;
		$data['ocultarEjemplar'] = 0;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/ejemplarVw");
		$this->load->view("footer");
	}
	
	public function altaEjemplar(){		
		$data['ejemplar'] = 'selected-tab';
		$data['altaEjemplar'] = 'selected-tab';
		$data['ocultarFicha'] = 1;
		$data['ocultarEjemplar'] = 0;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/altaEjemplarVw");
		$this->load->view("footer");
	}
	
	public function bajaEjemplar(){		
		$data['ejemplar'] = 'selected-tab';
		$data['bajaEjemplar'] = 'selected-tab';
		$data['ocultarFicha'] = 1;
		$data['ocultarEjemplar'] = 0;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/bajaEjemplarVw");
		$this->load->view("footer");
	}
	
	public function cambioEjemplar(){		
		$data['ejemplar'] = 'selected-tab';
		$data['cambioEjemplar'] = 'selected-tab';
		$data['ocultarFicha'] = 1;
		$data['ocultarEjemplar'] = 0;
		
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw",$data);
		$this->load->view("/admin/cambioEjemplarVw");
		$this->load->view("footer");
	}
	
	/* --------------------------- */
	/* --------------------------- */
	/* --- FUNCIONES PARA ABC ---- */
	/* --------------------------- */
	/* --------------------------- */
	
	/* ---------------------- */
	/* ------- FICHAS ------- */
	/* ---------------------- */
	public function getFichas(){
		$this->ficha = new Ficha();
			
		echo $this->ficha->mostrarFichas();		
	}
	
	/* ALTA DE FICHAS */
	public function addFicha(){
		$this->ficha = new Ficha();
		
		$data['titulo'] = $_REQUEST['titulo'];
		$data['autor'] = $_REQUEST['autor'];
		$data['isbn'] = $_REQUEST['isbn'];
		$data['clasificacion'] = $_REQUEST['clasificacion'];
				
		echo $this->ficha->addFicha($data);
		
	}
	
	/* BAJA FICHAS */
	public function showFicha(){
		$this->ficha = new Ficha();
			
		$value = $_REQUEST['value']==''?0:$_REQUEST['value']; 
				
		$sql = "select Id, autor, titulo,ISBN, clasificacion from cib.ficha where ";
		$sql .= " Id = ${value}";
		
		echo $this->ficha->execSQL($sql);
	}
	
	
	public function deleteFicha(){
		$this->ficha = new Ficha();
		
		$value = $_REQUEST['value'];
		$id = 0;
		
		$id = $value;	
		
		$sql = "delete from cib.ficha where id = $id";
		
		echo $this->ficha->delete($sql,$id);
	}
	
	/* CAMBIO FICHAS */
	/* ---------------------------------------------------- */
	/* ---------------------------------------------------- */
	/* EL BUSCADOR DE FICHAS se encuentra en alumno/Fichero */
	/* ---------------------------------------------------- */
	/* ---------------------------------------------------- */
	
	public function updateFicha($id){
		$this->ficha = new Ficha();
		$data['id'] = $id;
		
		/* OBTENER DATOS FICHA POR ID */
		$array = $this->ficha->mostrarFichasById($id);		
		
		$data['titulo'] = $array[0]['titulo'];
		$data['autor'] = $array[0]['autor'];
		$data['isbn'] = $array[0]['isbn'];
		$data['clasificacion'] = $array[0]['clasificacion'];
		
		$this->load->view("header");		
		$this->load->view("/admin/cambioFichaFormVw",$data);
		$this->load->view("footer");
	}
	
	
	public function updateFichaQuery(){
		$this->ficha = new Ficha();
		
		$id = $_REQUEST['id'];
		$query = $_REQUEST['query'];
		$sql = "update cib.ficha ".$query." where id = ".$id;
		
		$resultado = $this->ficha->update($sql);
		echo $resultado?$id:false;
	}
	
	
	/* -------------------------- */
	/* ------- EJEMPLARES ------- */
	/* -------------------------- */
	public function getEjemplares(){
		/* ESTA FUNCION NO LA VOY A UTILIZAR */
		$this->ejemplar = new Ejemplar();
		
		echo $this->ejemplar->mostrarEjemplares();		
	}
	
	/* ------- ALTA EJEMPLARES ------- */
	public function showFichaEjemplares(){
		$this->ficha = new Ficha();
			
		$value = $_REQUEST['value']==''?0:$_REQUEST['value'];
	
		$sql = "select f.Id as Id, autor, titulo,ISBN, clasificacion, e.numAdquisicion as adquisicion from cib.ficha as f left outer join cib.ejemplar as e on f.id = e.idFicha";
		$sql .= " where f.Id = ${value} order by 6";
	
		echo $this->ficha->execSQLFichaEjemplar($sql);
	}
	
	/* ------- BAJA EJEMPLARES ------- */	
	public function showFichaEjemplaresBorrar(){
		$this->ficha = new Ficha();
			
		$value = $_REQUEST['value']==''?0:$_REQUEST['value'];
	
		$sql = "select f.Id as Id, autor, titulo,ISBN, clasificacion, e.numAdquisicion as adquisicion, e.id as ide from cib.ficha as f left outer join cib.ejemplar as e on f.id = e.idFicha";
		$sql .= " where f.Id = ${value} order by 6";
	
		echo $this->ficha->execSQLFichaEjemplarBorrar($sql);
	}
	
	/* ------- CAMBIAR EJEMPLARES ------- */
	public function showFichaEjemplaresCambiar(){
		$this->ficha = new Ficha();
			
		$value = $_REQUEST['value']==''?0:$_REQUEST['value'];
	
		$sql = "select f.Id as Id, autor, titulo,ISBN, clasificacion, e.numAdquisicion as adquisicion, e.id as ide from cib.ficha as f left outer join cib.ejemplar as e on f.id = e.idFicha";
		$sql .= " where f.Id = ${value} order by 6";
	
		echo $this->ficha->execSQLFichaEjemplarCambiar($sql);
	}
	
	
	public function addEjemplar(){
		$this->ejemplar = new Ejemplar();
		
		$data['idFicha'] = $_REQUEST['idFicha'];
		$data['adq'] = $_REQUEST['adq'];
		$data['tomo'] = $_REQUEST['tomo'];
		$data['volumen'] = $_REQUEST['volumen'];
		$data['accesible'] = $_REQUEST['accesible'];
				
		echo $this->ejemplar->addEjemplar($data);
	}
	
	public function deleteEjemplar($ide){
		$this->ejemplar = new Ejemplar();
		
		$data['ide'] = $ide;	
				
		$this->load->view("header");
		$this->load->view("/admin/deletedEjemplarVw",$data);
		$this->load->view("footer");				
	}
	
	public function borrarEjemplar(){
		$this->ejemplar = new Ejemplar();
		
		$value = $_REQUEST['value'];
		$id = $value;
		
		$sql = "delete from cib.ejemplar where id = $id";
		
		echo $this->ejemplar->deleteEjemplar($sql,$id);
	}
	
	public function updateEjemplar($ide){
		$this->ejemplar = new Ejemplar();
		
		$data['ide'] = $ide;	
		$array = $this->ejemplar->mostrarEjemplarById($ide);
		$data['adq'] = $array[0]['numAdquisicion'];
		$data['tomo'] = $array[0]['tomo'];
		$data['volumen'] = $array[0]['volumen'];
		$data['accesible'] = $array[0]['accesible'];
				
		$this->load->view("header");
		$this->load->view("/admin/cambioEjemplarFormVw",$data);
		$this->load->view("footer");
	}
	
	public function printEjemplar($ide){
		$this->ejemplar = new Ejemplar();
		
		$data['ide'] = $ide;
		$array = $this->ejemplar->mostrarEjemplarById($ide);
		$data['adq'] = $array[0]['numAdquisicion'];
		$data['tomo'] = $array[0]['tomo'];
		$data['volumen'] = $array[0]['volumen'];
		$data['accesible'] = $array[0]['accesible'];
				
		$this->load->view("header");
		$this->load->view("/admin/imprimirEtiquetaVw",$data);
		$this->load->view("footer");
	}
	
	public function updateEjemplarQuery(){
		$this->ejemplar = new Ejemplar();
		
		$ide = $_REQUEST['ide'];		
		$query = $_REQUEST['query'];
		$sql = "update cib.ejemplar ".$query." where id = ".$ide;
		
		$resultado = $this->ejemplar->update($sql);
		echo $resultado?$ide:false;
	}
		
	public function showFichaMostrarEjemplares(){
		$this->ficha = new Ficha();
			
		$value = $_REQUEST['value']==''?0:$_REQUEST['value'];
	
		$sql = "select f.Id as Id, autor, titulo,ISBN, clasificacion, e.numAdquisicion as adquisicion, e.id as ide from cib.ficha as f left outer join cib.ejemplar as e on f.id = e.idFicha";
		$sql .= " where f.Id = ${value} order by 6";
	
		echo $this->ficha->execSQLFichaEjemplarMostrar($sql);
	}
	
	
	/* --------------------------------------------------- */
	/* ------------ BUSCADOR EJEMPLARES ------------------ */
	/* --------------------------------------------------- */
	public function bigSearchOfBooks(){
		$this->ficha = new Ficha();
		
		$texto = $_REQUEST['texto'];
		
		$sql = "select titulo, autor, fecha, isbn, clasificacion, numAdquisicion, ejemplar, volumen, tomo, accesible
				from cib.ficha f inner join cib.ejemplar e 
				on f.Id = e.idFicha
				where titulo like '%{$texto}%' 
				or autor like '%{$texto}%'
				or numAdquisicion like '%{$texto}%'
				";
		echo 'Funciona!';
		//echo $this->ficha->execQueryBigSearchOfBooks($sql);
	}
	
	
	
	
	/* --------------------------------------------------- */
	/* --------------------------------------------------- */
	/* --- FUNCIONES PARA MOSTRAR DETALLES EN FICHERO ---- */
	/* --------------------------------------------------- */
	/* --------------------------------------------------- */
		
	public function detalleFichero($id){
		$this->ficha = new Ficha();
		$this->ejemplar = new Ejemplar();
		$data['id'] = $id;

		// id, titulo, autor, isbn, clasificacion
		$array = $this->ficha->mostrarFichasById($id);
		
		$data['titulo'] = $array[0]['titulo'];
		$data['autor'] = $array[0]['autor'];
		$data['isbn'] = $array[0]['isbn'];
		$data['clasificacion'] = $array[0]['clasificacion'];
		
		
		// numAdquisicion, volumen, tomo, accesible
		$arraye = $this->ejemplar->mostrarEjemplaresByIdFicha($id);
		
		$cont = 0;
		$ejemplar = [];
		
		foreach($arraye as $e){			
			$ejemplar[$cont]['adq'] = $e['numAdquisicion'];
			$ejemplar[$cont]['volumen'] = $e['volumen'];
			$ejemplar[$cont]['tomo'] = $e['tomo'];
			$ejemplar[$cont]['accesible'] = $e['accesible'];
			$cont++;			
		}					
		
		$data['ejemplar'] = $ejemplar;
		
		$this->load->view("header");
		$this->load->view("/admin/detalleFicheroVw",$data);
		$this->load->view("footer");
		
		
		
	}
}

