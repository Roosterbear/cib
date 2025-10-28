<?php

class Prestamos extends \CI_Controller {

  private $idUsuario=11328;

  public $usuario;

  public $cuentas;

  public $biblioteca;

  public $cajas;

  public function __construct() {
    parent::__construct ();

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

    $this->load->model("EtiquetasMARC");
    $this->load->model("Ficha");
    $this->load->model("Ejemplar");

    // *************************
    // Acceder a Modelo POLITICA
    // *************************
    $this->load->model("Politica");
    
    // *************************
    // Acceder a Modelo PRESTAMO
    // *************************
    $this->load->model("Prestamo");

    $this->load->model("Perfil");
    $this->load->model("PrestamoRenovacion");

    $this->load->library("Cuentas");
    $this->load->library("Biblioteca");
    $this->load->library("MenusDB");
    $this->load->library("BibliotecaMenus");
    $this->load->library("Cajas");
  }

  public function index(){
    $this->load->view("admin/prestamo/index");
  }

  public function buscarUsuario(){
    try{
      /* SE MANDO POR POST usuario */
      /* $busqueda = usuario enviado */
      $busqueda = utf8_decode($_REQUEST["usuario"]);

      /* SE CREA UN NUEVO USUARIO */
      $usuario = new Usuario();
      
      if(preg_match("/^([ab]\d{5})|(\d{6})$/i", $busqueda)){
        
        /* SE BUSCA POR MATRICULA O NUMERO DE EMPLEADO */
        $usuario->setUsuario($busqueda);
      }else{
        /* SE BUSCA POR NOMBRE */
        $usuario->setNombre($busqueda);
      }


      /* ------------------------------------------- */
      /* SE PASA EL USUARIO PARA OBTENER INFORMACION */
      /* ------------------------------------------- */
      
      /* $cuentas es una LIBRERIA */
      /* Recibe el objeto $usuario y lineas a mostrar */
      $listado = $this->cuentas->listUsuarios($usuario,12);

      if(count($listado)==0){
        throw new Exception("No se encontro ningun resultado",2);
      }

      /* SI SOLO HAY UN RESULTADO, MOSTRAR PRESTAMOS */
      if(count($listado)==1){
        $usr=array_pop($listado);

        /* CARGA LA VISTA DE PRESTAMO DE USUARIO === SOLO 1 USUARIO === */
        $this->vwPrestamoUsuario($usr->getId(), $usr->getTipo());

      }else{
        
        /* SI HAY VARIOS RESULTADOS, MOSTRAR LISTADO */
        $this->output->append_output('<div class="row" >');
        foreach ($listado as $usr){

          /* CARGA LA VISTA DE PRESTAMO DE USUARIO === VARIOS USUARIOS === */
          $this->vwUsuario($usr->getId(), $usr->getTipo());
        }

        $this->output->append_output('</div>');
      }
    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function buscarEjemplar(){
    try{

      // ***************************************************************
      // DE ACUERDO AL NUMERO DE ADQUISICION, SE REGRESA OBJETO EJEMPLAR
      // ***************************************************************
      $busqueda= utf8_decode($_REQUEST["adquisicion"]);

      $idPerfil=$_REQUEST["idPerfil"];

      $ejemplar= new Ejemplar();
      $ejemplar->setNumAdquisicion($busqueda);

      // ***************************************************************
      // AQUI VA TODA LA INFORMACION DEL EJEMPLAR A BUSCAR PARA PRESTAMO
      // ***************************************************************
      $d["ejemplar"]=$this->biblioteca->EjemplarLibro($ejemplar,"numAdquisicion");

      // ***************************************************************
      $d["idPerfil"]=$idPerfil;

      $this->load->view("admin/prestamo/ejemplar",$d);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  // **********
  // REVISAR
  // **********

  public function Nuevo(){


    try{
      $prestamo= new Prestamo();
      $prestamo->setIdejemplar(@$_REQUEST['idEjemplar']);
      $prestamo->setIdsolicitante(@$_REQUEST['idSolicitante']);

      // ******************************************************
      // No estamos pasando la politica, de donde la obtiene???
      // ******************************************************

      
      $prestamo->setIdpolitica(@$_REQUEST['idPolitica']);
      
      $prestamo->setIdusuario($this->usuario->getCve_persona());

      $this->biblioteca->prestarEjemplar($prestamo);

      bs_alerta("Ejemplar prestado Correctamente", "success");
      $this->vwPrestamoUsuario($prestamo->getIdSolicitante(),	@$_REQUEST["tipo"]);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function Renovar($idPrestamo,$idUsuario,$tipo){
    try{
      $prestamo= new Prestamo($idPrestamo);
      $prestamo->setIdusuario($this->usuario->getCve_persona());

      $this->biblioteca->RenovarPrestamo($prestamo);

      echo bs_alerta("Renovación Correcta", "success");
      $this->vwPrestamoUsuario($idUsuario,$tipo);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function Devolver($idPrestamo,$idUsuario,$tipo){
    try{
      $prestamo= new Prestamo($idPrestamo);
      $prestamo->setIdusuario($this->usuario->getCve_persona());

      $this->biblioteca->DevolverPrestamo($prestamo);

      echo bs_alerta("Ejemplar Devuelto", "success");
      $this->vwPrestamoUsuario($idUsuario,$tipo);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwUsuario($idUsuario,$tipo,$seleccionable=true){
    try{

      if($tipo=="Alumno"){

        /* === Se crea usuario ALUMNO === */
        $usuario= new Alumno($idUsuario);
        $this->cuentas->UsuarioAlumno($usuario);
      }
      if($tipo=="Empleado"){

        /* === Se crea usuario EMPLEADO === */
        $usuario= new Empleado($idUsuario);
        $this->cuentas->UsuarioEmpleado($usuario);
      }
      
      $datos["usuario"]=$usuario;
      $datos["seleccionable"]=$seleccionable;
      
      /* === Se carga la vista === */
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
      $d["prestamos"]=$this->biblioteca->ListPrestamosPorUsuario($usuario);
      $d["tipo"]=$usuario->getTipo();

      //buscamos al usuario para encontrar politica y ver que no exceda el num max de libros
      $user=$this->cuentas->Usuario($usuario);
      $perfil= new Perfil($user->getIdPerfil());
      $d["perfil"]=$this->biblioteca->Perfil($perfil);
      $d["multa"]=false;
      $d["nuevoPrestamo"]=false;

      //Validamos que no tenga ninguna multa
      $d["multa"]=$this->cajas->TieneAdeudosBiblioteca($usuario);
      if(!$d["multa"]){
        if($user->getActivo() && $perfil->getLibros() > count($d["prestamos"])){
          $d["nuevoPrestamo"]=true;
        }
      }

      $this->load->view("admin/prestamo/listado",$d);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwHistorial($idUsuario){
    try{
      $usuario= new Usuario($idUsuario);
      $d["prestamos"]=$this->biblioteca->ListPrestamosPorUsuario($usuario,0);

      $this->load->view("admin/prestamo/historial",$d);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwNuevoPrestamo($idSolicitante,$tipo){
    try{

      $usuario=new Usuario($idSolicitante);
      $usuario->setTipo($tipo);

      $user=$this->cuentas->Usuario($usuario);
      $d["usuario"]=$user;

      $this->load->view("admin/prestamo/nuevo_prestamo",$d);

    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwEjemplar($idEjemplar){
    try{

      $ejemplar= new Ejemplar($idEjemplar);

      $d["ejemplar"]=$this->biblioteca->EjemplarLibro($ejemplar);

      $this->load->view("admin/prestamo/ejemplar",$d);
    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwPolitica($id){
    try{

      $politica=new Politica($id);
      $d["politica"]=$this->biblioteca->Politica($politica);
      $this->load->view("admin/politica",$d);
    }catch(Exception $e){
      send_exception($e);
    }
  }

  public function vwRenovaciones($id){
    try{

      $prestamo=new Prestamo($id);
      $d["renovaciones"]=$this->biblioteca->ListaRenovaciones($prestamo);
      $this->load->view("admin/prestamoRenovaciones",$d);
    }catch(Exception $e){
      send_exception($e);
    }
  }
  public function vwEditarFecha($id){
    try{

      $prestamo=new Prestamo($id);
      $param["prestamos"]=$prestamo;
      $this->load->view("admin/prestamo/fecha",$param);
    }catch(Exception $e){
      send_exception($e);

    }
  }
  public function editarFecha(){
    try{
      $prestamo=new prestamo();
      $prestamo->setId($_REQUEST["id"]);
      $prestamo->setFechaEntrega($_REQUEST["fechaEntrega"]);
      $this->biblioteca->actualizarFecha($prestamo);
      echo bs_alerta("Se edito correcto","success");

      echo '<script type="text/javascript">$("#buscar").submit();</script>';



    }catch(Exception $e){
      send_exception($e);
    }

  }
  public function vwBuscarLibro(){
    try{

      $prestamo=new  Prestamo();
      $param["prestamos"]=$prestamo;
      $this->load->view("admin/prestamo/busqueda", $param);
    }catch(Exception $e){
      send_exception($e);

    }
  }
  public function BuscarLibro(){
    try{
      $prestamo=new Prestamo();
      $prestamo->ejemplar->setNumAdquisicion($_REQUEST["numAdquisicion"]);

      $d["prestamo"]=$this->biblioteca->PrestamoPorAdquisicion($prestamo);
      $this->load->view("admin/prestamo/devolver",$d);

    }catch(Exception $e){
      send_exception($e);
    }

  }


  public function DevolverLibro($id){
    try{

      $prestamo= new Prestamo($id);
      $prestamo->setIdusuario($this->usuario->getCve_persona());
      $this->biblioteca->DevolverPrestamo($prestamo );
      echo bs_alerta("Devuelto sin error", "success");
      echo '<script type="text/javascript">$("#buscar").submit();</script>';

    }catch(Exception $e){
      send_exception($e);
    }
  }
}

?>