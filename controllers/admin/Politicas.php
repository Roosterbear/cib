<?php
/**
 *
 * @author jguerrero
 *        
 */
class Politicas extends \CI_Controller {
	
	/**
	 * 
	 * @var Libreria
	 */
	public $libreria;
	
	/**
	 *
	 * @return void
	 *
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model("Politica");
		$this->load->helper("alerta");
		$this->load->library("Libreria");
	}
	
	public function index(){
	    //$param["politicas"]=$this->libreria->listadoPoliticas();
		//$this->load->view("admin/politicas/index",$param);
		$this->load->view("admin/politicas/index");
	}
	
	public function borrar($idPolitica){
		$politica=new Politica($idPolitica);
		$this->libreria->borrarPolitica($politica);
		echo bs_alerta("Se Borro","success");
		$this->vwListado();
	}
	
	public function agregar(){
		try{
			$politica=new Politica();
			$politica->setNombre($_REQUEST["nombre"]);
			$politica->setDias($_REQUEST["dias"]);
			$politica->setLibros($_REQUEST["libros"]);
			$politica->setRenovacion($_REQUEST["renovacion"]);
			
			
			
			$this->libreria->agregarPolitica($politica);
			echo bs_alerta("Se agrego sin error","success");
		}catch(Exception $e){
			send_exception($e);
		}
		$this->vwListado();
	
	}
	public function editar(){
		try{
			$politica=new Politica();
			$politica->setId($_REQUEST["id"]);
			$politica->setNombre($_REQUEST["nombre"]);
			$politica->setDias($_REQUEST["dias"]);
			$politica->setLibros($_REQUEST["libros"]);
			$politica->setRenovacion($_REQUEST["renovacion"]);
		
		
		
			$this->libreria->actualizarPolitica($politica);
			echo bs_alerta("Se edito correcto","success");
			
		}catch(Exception $e){
			send_exception($e);
		}
		$this->vwListado();
	}
	
	public function vwEditar($idPolitica,$funcion="editar"){
		try{
			$politica=new Politica($idPolitica);
	        $param["funcion"]=$funcion;
	        if($idPolitica!=0){
				$param["politica"]=$this->libreria->Politica($politica);
	        }else{
	        	$param["politica"]=new Politica();
	        }
			$this->load->view("admin/politicas/edicion",$param);
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	public function vwListado(){
	
		$param["politicas"]=$this->libreria->listadoPoliticas();
		$this->load->view("admin/politicas/listado",$param);
	}
}

?>