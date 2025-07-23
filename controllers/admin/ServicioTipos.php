<?php
class ServicioTipos extends \CI_Controller{
	/**
	 *
	 * @var Libreria
	 */
	
	public $libreria;
	
	public function __construct(){
		parent:: __construct();
		$this->load->model("ServicioTipo");
		$this->load->helper("alerta");
		$this->load->library("Libreria");
	}
	
	public function index(){
		$this->load->view("admin/servicioTipos/index");
	}
	
	public function vwCatalogo(){
		try {
			$param["servicioTipos"]=$this->libreria->listaServicios();
			$this->load->view("admin/servicioTipos/catalogo",$param);
			
		} catch (Exception $e){
			send_exception($e);
		}
		
	}
	
	public function agregar (){
		try {
		$servicio= new ServicioTipo();
		$servicio->setNombre($_REQUEST["nombre"]);
		$this->libreria->agregarServicio($servicio);
		echo bs_alerta("Se agrego servicio sin error","success");
		}catch (Exception $e){
			send_exception($e);
		}
		$this->vwCatalogo();
	}
	public function borrar($idServicio){
		$id=new ServicioTipo($idServicio);
		$this->libreria->borrarServicio($id);
		echo bs_alerta("Se elimino servicio","danger");
		
		$this->vwCatalogo();
	}
	
	public function buscar(){
		try{
			if ($_REQUEST){
				if ($_REQUEST){
					$param["servicioTipos"]=$this->libreria->buscarServicio($_REQUEST['nombre']);
					$this->load->view("admin/servicioTipos/catalogo",$param);
				}
			}
			
			
		}
		catch (Exception $e){
			send_exception($e);
		}
		
	}
	
	
}
?>