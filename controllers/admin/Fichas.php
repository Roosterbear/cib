<?php
class Fichas extends \CI_Controller{
	/**
	 *
	 * @var Biblioteca	 */
	public $biblioteca;

	public function __construct() {
		parent::__construct ();
		$this->load->model("EtiquetasMARC");
		$this->load->model("Ficha");
		$this->load->model("Ejemplar");
		$this->load->helper("alerta");
		$this->load->library("Biblioteca");
		
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

		//this->load->view("admin/Fichas/index");
		echo('Seeee, aqui sigo...');
		
	}
	
	public function vwFichero(Ficha $ficha){
		$d["ficha"]=$ficha;
		$d["etiqueta"]=$ficha->getEtiquetasMARC();
		$this->load->view("admin/Fichas/fichero",$d);

	}

	
	public function buscar(){
		try{
			$busqueda= utf8_decode($_REQUEST["busqueda"]);
			$tipo=utf8_decode($_REQUEST["tipo"]);
			$funcion="set".$tipo;	
			$ejemplar= new Ejemplar();

			$ejemplar->$funcion($busqueda);
			if($tipo=="Titulo"){
				$ficha= new Ficha();
				$ficha->setTitulo($busqueda);
				$param["ficha"]=$this->biblioteca->listaTitulos($ficha);
				
				if(count($param["ficha"])==1){
					$id_temp=array_pop($param["ficha"])->getId();
					$ejemplar->setIdFicha($id_temp);
					$ficha=$this->biblioteca->busquedaFicha($ejemplar,"IdFicha");
					$this->vwFichero($ficha);
					//exit;
				}else{
					$this->load->view("admin/Fichas/seleccion",$param);
				}
				
				
				
				
			}else{
				$ficha=$this->biblioteca->busquedaFicha($ejemplar,$tipo);
				$this->vwFichero($ficha);
			}
			
				
		}catch(Exception $e){
			//pre($e);
			send_exception($e);
		}
	}
	
	
	public function vwbuscar(){
		try{
			$ejemplar =new Ejemplar();
			$datos["ejemplar"]=$ejemplar;
			$this->load->view("admin/Fichero");
	
	
		}catch(Exception $e){
			send_exception($e);
		}
	}
	
	public function Editar(){
		try{
			$ejemplar=new Ficha();
			$ficha=new Ficha();
			$ficha->setId($_REQUEST["idFicha"]);
			
			$ficha->setTitulo(utf8_decode($_REQUEST["titulo_MencionDeResponsabilidad"]));
			
			if(isset($_REQUEST["isbn"])){ 
				$ficha->setISBN(  utf8_decode($_REQUEST["isbn"]) ); 
			}
				
			if(isset($_REQUEST["clasificacion_LC"])){
				$ficha->setClasificacion(utf8_decode($_REQUEST["clasificacion_LC"]));
			}
			if(isset($_REQUEST["autorPersonal"])){
				$ficha->setAutor(utf8_decode($_REQUEST["autorPersonal"]));
				
			}
			if(isset($_REQUEST["autorCorporativo"])){$ficha->getEtiquetasMARC()->setAutorCorporativo(utf8_decode($_REQUEST["autorCorporativo"]));}
			
			
			if(isset($_REQUEST["edicion"])){$ficha->getEtiquetasMARC()->setEdicion(utf8_decode($_REQUEST["edicion"]));}
			if(isset($_REQUEST["lugar_Editorial"])){$ficha->getEtiquetasMARC()->setLugar_Editorial(utf8_decode($_REQUEST["lugar_Editorial"]));}
			if(isset($_REQUEST["paginasVols_Dimensiones"])){$ficha->getEtiquetasMARC()->setPaginasVols_Dimensiones(utf8_decode($_REQUEST["paginasVols_Dimensiones"]));}
			if(isset($_REQUEST["notasGenerales"])){$ficha->getEtiquetasMARC()->setNotasGenerales(utf8_decode($_REQUEST["notasGenerales"]));}
			if(isset($_REQUEST["notasDeBibliografia"])){$ficha->getEtiquetasMARC()->setNotasDeBibliografia(utf8_decode($_REQUEST["notasDeBibliografia"]));}
			if(isset($_REQUEST["notasDeVersionOriginal"])){$ficha->getEtiquetasMARC()->setNotasDeVersionOriginal(utf8_decode($_REQUEST["notasDeVersionOriginal"]));}
			if(isset($_REQUEST["encabezadosBajoTemasGenerales"])){$ficha->getEtiquetasMARC()->setEncabezadosBajoTemasGenerales(utf8_decode($_REQUEST["encabezadosBajoTemasGenerales"]));}
			if(isset($_REQUEST["asientosSecundariosBajoAutorPersonal"])){$ficha->getEtiquetasMARC()->setAsientosSecundariosBajoAutorPersonal(utf8_decode($_REQUEST["asientosSecundariosBajoAutorPersonal"]));}
			if(isset($_REQUEST["asientosSecundariosBajoAutorCorporativo"])){$ficha->getEtiquetasMARC()->setAsientosSecundariosBajoAutorCorporativo(utf8_decode($_REQUEST["asientosSecundariosBajoAutorCorporativo"]));}
			if(isset($_REQUEST["ligaDeLosRecursosElectricos"])){$ficha->getEtiquetasMARC()->setLigaDeLosRecursosElectricos(utf8_decode($_REQUEST["ligaDeLosRecursosElectricos"]));}
			if(isset($_REQUEST["tituloUniforme"])){$ficha->getEtiquetasMARC()->setTituloUniforme(utf8_decode($_REQUEST["tituloUniforme"]));}
	        
			//pre($ficha);
			
			$this->biblioteca->editarFicha($ficha);
			echo bs_alerta("Se edito correcto","success");
		

			$this->biblioteca->Ficha($ficha);
			$this->vwFichero($this->biblioteca->busquedaFicha($ejemplar,"IdFicha"));
	        
			
		}catch(Exception $e){
			send_exception($e);
		}
		
		$this->vwFichero($ficha);
			
		
	}
	
	public function vwEditar($id){
		try{
			$ficha=new Ficha($id);
			$param['funcion'] = "editar";
			$param["fichas"]=$this->biblioteca->Ficha($ficha);
			$this->load->view("admin/Fichas/plantilla",$param);
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	public function Agregar(){
		try{
			$ficha=new Ficha();
			$ficha->setId($_REQUEST["idFicha"]);
				
			$ficha->setTitulo(utf8_decode($_REQUEST["titulo_MencionDeResponsabilidad"]));
				
			if(isset($_REQUEST["isbn"])){
				$ficha->setISBN(  utf8_decode($_REQUEST["isbn"]) );
			}
		
			if(isset($_REQUEST["clasificacion_LC"])){
				$ficha->setClasificacion(utf8_decode($_REQUEST["clasificacion_LC"]));
			}
			if(isset($_REQUEST["autorPersonal"])){
				$ficha->setAutor(utf8_decode($_REQUEST["autorPersonal"]));
		
			}
			if(isset($_REQUEST["autorCorporativo"])){$ficha->getEtiquetasMARC()->setAutorCorporativo(utf8_decode($_REQUEST["autorCorporativo"]));}
				
				
			if(isset($_REQUEST["edicion"])){$ficha->getEtiquetasMARC()->setEdicion(utf8_decode($_REQUEST["edicion"]));}
			if(isset($_REQUEST["lugar_Editorial"])){$ficha->getEtiquetasMARC()->setLugar_Editorial(utf8_decode($_REQUEST["lugar_Editorial"]));}
			if(isset($_REQUEST["paginasVols_Dimensiones"])){$ficha->getEtiquetasMARC()->setPaginasVols_Dimensiones(utf8_decode($_REQUEST["paginasVols_Dimensiones"]));}
			if(isset($_REQUEST["notasGenerales"])){$ficha->getEtiquetasMARC()->setNotasGenerales(utf8_decode($_REQUEST["notasGenerales"]));}
			if(isset($_REQUEST["notasDeBibliografia"])){$ficha->getEtiquetasMARC()->setNotasDeBibliografia(utf8_decode($_REQUEST["notasDeBibliografia"]));}
			if(isset($_REQUEST["notasDeVersionOriginal"])){$ficha->getEtiquetasMARC()->setNotasDeVersionOriginal(utf8_decode($_REQUEST["notasDeVersionOriginal"]));}
			if(isset($_REQUEST["encabezadosBajoTemasGenerales"])){$ficha->getEtiquetasMARC()->setEncabezadosBajoTemasGenerales(utf8_decode($_REQUEST["encabezadosBajoTemasGenerales"]));}
			if(isset($_REQUEST["asientosSecundariosBajoAutorPersonal"])){$ficha->getEtiquetasMARC()->setAsientosSecundariosBajoAutorPersonal(utf8_decode($_REQUEST["asientosSecundariosBajoAutorPersonal"]));}
			if(isset($_REQUEST["asientosSecundariosBajoAutorCorporativo"])){$ficha->getEtiquetasMARC()->setAsientosSecundariosBajoAutorCorporativo(utf8_decode($_REQUEST["asientosSecundariosBajoAutorCorporativo"]));}
			if(isset($_REQUEST["ligaDeLosRecursosElectricos"])){$ficha->getEtiquetasMARC()->setLigaDeLosRecursosElectricos(utf8_decode($_REQUEST["ligaDeLosRecursosElectricos"]));}
			if(isset($_REQUEST["tituloUniforme"])){$ficha->getEtiquetasMARC()->setTituloUniforme(utf8_decode($_REQUEST["tituloUniforme"]));}
			 
			//pre($ficha);
			$this->biblioteca->agregarFicha($ficha);
			echo bs_alerta("Se agrego correcto","success");
			$this->vwFichero($ficha);
		}catch(Exception $e){
			send_exception($e);
		}
		
	
	}
	
	public function vwAgregar(){
		try{
			$ficha=new Ficha();	
			$param["ficha"]=$ficha;
			$param['etiqueta']=$ficha->getEtiquetasMARC();
			$this->load->view("admin/Fichas/fichero",$param);
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	public function EditarEjemplar(){
		try{
			$ejemplar=new Ejemplar($_REQUEST['idEjemplar']);
			$ejemplar->setNumAdquisicion($_REQUEST["numAdquisicion"]);
			$ejemplar->setTomo($_REQUEST["tomo"]);
			$ejemplar->setVolumen($_REQUEST["volumen"]);
			$ejemplar->setEjemplar($_REQUEST["ejemplar"]);
			$ejemplar->setAccesible($_REQUEST["accesible"]);
	
	
			
			$this->biblioteca->editarEjemplar($ejemplar);
			echo bs_alerta("Se edito correcto","success");
			
			$this->biblioteca->Ejemplar($ejemplar);
			$this->vwFichero($this->biblioteca->busquedaFicha($ejemplar,"IdFicha"));
				
		}catch(Exception $e){
			send_exception($e);
		}
		
	}
	public function vwEditarEjemplar($id){
		try{
			$ejemplar=new Ejemplar($id);
			$param['funcion'] = "editarEjemplar";
			$param["ejemplar"]=$this->biblioteca->Ejemplar($ejemplar);
			$this->load->view("admin/Fichas/plantilla",$param);
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	public function AgregarEjemplar(){
		try{
			$ejemplar=new Ejemplar();
			$ejemplar->setIdFicha($_REQUEST["idFicha"]);
			$ejemplar->setNumAdquisicion($_REQUEST["numAdquisicion"]);
			$ejemplar->setTomo($_REQUEST["tomo"]);
			$ejemplar->setVolumen($_REQUEST["volumen"]);
			$ejemplar->setEjemplar($_REQUEST["ejemplar"]);
			$ejemplar->setAccesible($_REQUEST["accesible"]);
	
	
	
			$this->biblioteca->agregarEjemplar($ejemplar);
			echo bs_alerta("Se agrego correcto","success");
			
			
			$this->vwFichero($this->biblioteca->busquedaFicha($ejemplar,"IdFicha"));
			
	
		}catch(Exception $e){
			send_exception($e);
		}
		
	
	}
	public function vwAgregarEjemplar($idFicha=null,$idEjeplar=null){
		try{
			$ejemplar=new Ejemplar();
			$param['idFicha'] = $idFicha;
			$param['idEjemplar'] = $idEjeplar;
			$this->load->view("admin/Fichas/formulario",$param);
		}catch(Exception $e){
			send_exception($e);
		}
	
	}
	
	public function borrarEjemplar($id){
		$ejemplar=new Ejemplar($id);
		$this->biblioteca->borrarEjemplar($ejemplar);
		echo bs_alerta("Se Borro","danger");
		
		
	
	}
	

	

	

	
	
}
?>