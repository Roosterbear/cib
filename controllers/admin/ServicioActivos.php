<?php
class ServicioActivos  extends \CI_Controller{
	/**
	 *
	 * @var Libreria
	 */
	
	public $libreria;
	
	public function __construct(){
		parent:: __construct();
		$this->load->model("ServicioActivo");
		$this->load->helper("alerta");
		$this->load->library("Libreria");
		$this->load->library("MenusDB");
		$this->load->library("BibliotecaMenus");
		
	}
	public function index(){
		$this->load->view("admin/servicioActivos/index");
	}
	
	public function vwCatalogos(){
		$param=array();
		try {
			
			$param["servicioActivos"]=$this->libreria->listaActivos();
			
				
		} catch (Exception $e){
			send_exception($e);
		}
		$this->load->view("admin/servicioActivos/catalogos",$param);
	
	}
	
	public function agregar (){
		try {
			$activo= new ServicioActivo();
			$activo->setNombre($_REQUEST["nombre"]);
			$activo->setIdServicio($_REQUEST["idServicio"]);
			
			$this->libreria->agregarActivo($activo);
			echo bs_alerta("Se agrego activo sin error","success");
		}catch (Exception $e){
			bs_alerta($e->getMessage(),"danger");
		}
		$this->vwCatalogos();
	}
	public function borrar($idServicioActivo){
		$id=new ServicioActivo($idServicioActivo);
		$this->libreria->borrarActivo($id);
		echo bs_alerta("Se elimino activo","danger");
	
		$this->vwCatalogos();
	}
	
	public function buscar(){
		try{
			if ($_REQUEST){
				if ($_REQUEST){
					$param["servicioActivos"]=$this->libreria->buscarActivo($_REQUEST['nombre']);
					$this->load->view("admin/servicioActivos/catalogos",$param);
				}
			}
				
				
		}
		catch (Exception $e){
			send_exception($e);
		}
	}
	
}
?>