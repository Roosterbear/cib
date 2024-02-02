<?php 
class DiasLaborados extends \CI_Controller{
	/**
	 * 
	 * @var Libreria
	 */
	public $libreria;
	
	public function __construct() {
		parent::__construct ();
		$this->load->model("DiaNoLaborado");
		$this->load->helper("alerta");
		$this->load->library("Libreria");
	}
	
	public function index(){
		
		
		$this->load->view("admin/diasLaborados/index");
	}
	
	public function vwLista(){
		$parametro=array();
		try{
			$parametro["lista"]=$this->libreria->listaDiaLaborado();
			
		}catch (Exception $e){
			send_exception($e);
		}
		$this->load->view("admin/diasLaborados/lista",$parametro);
	}
	
	public function agregar(){
		try{
		    $dia = new DiaNoLaborado();
		    $dia->setFecha($_REQUEST['fecha']);
	    if ($this->libreria->buscarFecha($dia)){
			$this->libreria->agregarFecha($dia);
			echo bs_alerta("Se agrego fecha sin error","success");
		     }
		 else {
		 	echo bs_alerta("La fecha insertada ya existe","danger");
		 }
			
		}catch(Exception $e){
			send_exception($e);
		}
		$this->vwLista();	
	}
	
	public function borrar($idFecha){
		 $id=new DiaNoLaborado($idFecha);
		 $this->libreria->borrarFecha($id);
		 echo bs_alerta("Se elimino","success");
		 $this->vwLista();
	}
	public function filtrar(){
		try {
			
			if ($_REQUEST ){		 
				 if ($_REQUEST){
				 	$parametro["lista"]= $this->libreria->filtrarFecha($_REQUEST['filtro1'],$_REQUEST['filtro2']);
				 	$this->load->view("admin/diasLaborados/lista",$parametro);
				 }
				
			}
			
		}catch(Exception $e){
			send_exception($e);
		}
		
		
	}
	
}
?>

