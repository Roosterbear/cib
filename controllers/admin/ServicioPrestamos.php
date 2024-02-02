<?php


class ServicioPrestamos extends \CI_Controller {
	// TODO - Insert your code here
	
	/**
     *
     * @var ServicioLib
     */
	public $servicio;
	
	/**
	 *
	 * @var Biblioteca
	 */
	public $biblioteca;
	
	/**
	 * 
	 * @var UsuarioSITO
	 */
	public $usuario;
	
	public function __construct() {
		parent::__construct ();
		$this->load->model("ServicioPrestamo");
		$this->load->helper("alerta");
		$this->load->library("ServicioLib",null,"servicio");
		//$this->load->servicio= new ServicioLib();
		$this->load->library("UsuarioSITO",null,"usuario");
		
		$this->usuario->setUsername(@$_REQUEST["uid"]);
		$this->usuario->setSitoSession(@$_REQUEST["sid"]);
		
		if(!$this->usuario->login()){
			show_error("La session ha caducado o esta entrando con un usuario no valido",500,"Acceso Denegado");
				
		}
		
		$this->load->helper("alerta");
		$this->load->model("Usuario");
		$this->load->model("Alumno");
		$this->load->model("Empleado");
		
		
		$this->load->library("Cuentas");
		$this->load->library("Biblioteca",null,"biblioteca");
		$this->load->library("MenusDB");
		$this->load->library("BibliotecaMenus");
		
	}
	public function index(){
		$this->load->view("admin/servicioPrestamos/index");
	}
	
	public function buscarUsuario(){
		try{
			$busqueda= utf8_decode($_REQUEST["usuario"]);
			$usuario =new Usuario();
			if(preg_match("/^([ab]\d{5})|(\d{6})$/i", $busqueda)){
				$usuario->setUsuario($busqueda);
			}else{
				$usuario->setNombre($busqueda);
			}
				
			$listado=$this->cuentas->listUsuarios($usuario,12);
				
			if(count($listado)==0){
				throw new Exception("No se encontro ningun resultado",2);
			}
			if(count($listado)==1){
				$usr=array_pop($listado);
				$this->vwPrestamoUsuario($usr->getId(), $usr->getTipo());
			}else{
				$this->output->append_output('<div class="row" >');
	
				foreach ($listado as $usr){
					$this->vwUsuario($usr->getId(), $usr->getTipo());
				}
				$this->output->append_output('</div>');
			}
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	public function vwUsuario($idUsuario,$tipo,$seleccionable=true){
		try{
				
			if($tipo=="Alumno"){
				$usuario= new Alumno($idUsuario);
				$this->cuentas->UsuarioAlumno($usuario);
			}
			if($tipo=="Empleado"){
				$usuario= new Empleado($idUsuario);
				$this->cuentas->UsuarioEmpleado($usuario);
			}
	
				
			$datos["usuario"]=$usuario;
			$datos["seleccionable"]=$seleccionable;
			$this->load->view("admin/usuario",$datos);
	
	
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	public function vwPrestamoUsuario($idUsuario,$tipo){
		try{
			$usuario= new Usuario($idUsuario);
			$usuario->setTipo($tipo);
			$this->vwUsuario($usuario->getId(), $tipo,false);
			$d["idSolicitante"]=$usuario->getId();
		    $d["prestamos"]=$this->servicio->listaPrestamos($usuario);
			$d["tipo"]=$usuario->getTipo();
			
			$user=$this->cuentas->Usuario($usuario);;
			//buscamos al usuario para encontrar politica y ver que no exceda el num max de libros

			//pre(var_dump($user);
				
			
			$d["nuevoPrestamo"]=$user->getActivo();
				
			$this->load->view("admin/servicioPrestamos/listado",$d);
				
	
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	
	
	public function vwHistorial($idSolicitante){
		try{
			
			//$prestamo= new ServicioPrestamo($idSolicitante);
			$usuario= new Usuario($idSolicitante);
			$d["prestamos"]=$this->servicio->listaPrestamos($usuario,0);
			
			
			$this->load->view("admin/servicioPrestamos/historial",$d);
	
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	
	public function vwListado(){
		$param=array();
		try {
			$param["prestamos"]=$this->servicio->ServicioPrestamo();
		} catch (Exception $e){
			send_exception($e);
		}
		$this->load->view("admin/servicioPrestamos/listado",$param);
	
	}
	
	public function menu($tipo){
		try {
			$menu="";
			$bm= new BibliotecaMenus();
			$bm->setRequerdio(true);
			$bm->setVacio(true);
			$bm->setBlank1stItem(true);
			$bm->setClass("form-control");
			$idServicio= isset($_REQUEST["idServicio"])?$_REQUEST["idServicio"]:0;
			
			switch($tipo){
				case "prestamo":
					$menu= $bm->ServicioActivosSinPrestamo($idServicio);
				break;
				case "devolver":
					$menu= $bm->ServicioActivosEnPrestamo($idServicio,null,"idServicioActivoDevuelto");
				break;
				default:
					throw new Exception("tipo de menu desconocido");	
				break;
			}
			
			echo $menu;
			
			
			
		} catch (Exception $e){
			send_exception($e);
		}
	}
	
	public function agregar(){
		try {
			$prestamo= new ServicioPrestamo();

			$prestamo->setIdServicioActivo($_REQUEST["idServicioActivo"]);
			$prestamo->setIdusuario($this->usuario->getCve_persona());
			$prestamo->setIdSolicitante($_REQUEST["idSolicitante"]);
			
			$this->servicio->agregarPrestamo($prestamo);
			$this->vwPrestamoUsuario($prestamo->getIdSolicitante(), @$_REQUEST["tipo"]);
			echo bs_alerta("Se agrego prestamo sin error","success");
			
			
		}catch (Exception $e){
			
			echo bs_alerta($e->getMessage(),"danger");
		}
		
	}
	public function Devolver($idPrestamo,$idUsuario,$tipo){
		try{
	
	
			$prestamo= new ServicioPrestamo($idPrestamo);
			//$prestamo->setIdusuario(3);	
			$prestamo->setIdusuario($this->usuario->getCve_persona());
			$this->servicio->DevolverPrestamo($prestamo);
	
			echo bs_alerta("Devuelto sin error", "success");
			$this->vwPrestamoUsuario($idUsuario,$tipo);
			
			
	
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	                                                                                                                                                                                                                                                                                               
	
	public function vwDevolver(){
		try{
		
			$prestamo=new ServicioPrestamo();
			$param["prestamos"]=$prestamo;
			$this->load->view("admin/servicioPrestamos/devolver", $param);
		}catch(Exception $e){
			send_exception($e);
		
		}
	}
	public function DevolverActivo(){
		try{
	
			$prestamo= new ServicioPrestamo($_REQUEST["idServicioActivoDevuelto"]);
			$prestamo->setIdusuario($this->usuario->getCve_persona());
			$this->servicio->DevolverPrestamo($prestamo);
			echo bs_alerta("Devuelto sin error", "success");
			
			echo '<script type="text/javascript">$("#buscar").submit();</script>';
	
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	
}

?>