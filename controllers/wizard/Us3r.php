<?php
header('Content-Type: text/html; charset=UTF-8');
class Us3r extends \CI_Controller{
    /**
     * 
     * @var Correo
     */
    public $correo;

	public function __construct(){
		parent:: __construct();	
		$this->load->library("Correo","correo");
	}
	
	public function index(){
		$this->load->model("AccesoBD");
		$this->load->view("header");

		$listado = $this->AccesoBD->listadoAlumnosConLibrosaCaducar();

		foreach($listado as $matricula=>$data){
			$titulos = array_column($data, 'titulo');
			$nombre = $data[0]['nombre'];
			$titulosEjemplares = implode(", ", $titulos);

			//$para = $matricula."@utags.edu.mx";
			$para = "luis.perea@utags.edu.mx";
			$asunto = "Recordatorio: Fecha límite de devolución de tu prestamo de libro";
			
			$mensaje = "Estimado(a) <strong>{$nombre}</strong>:";
            $mensaje .= "<br/><br/>Te recordamos que el periodo de préstamo de tu(s) libro(s):<br/>[<strong>";
			$mensaje .= $titulosEjemplares;
			$mensaje .= "</strong>] está por concluir.<br/>";
			$mensaje .= "Por favor, asegúrate de realizar la devolución a más tardar el día de mañana para evitar cargos adicionales.";
			$mensaje .= "<br/>En caso de no devolver el material en el tiempo establecido, se aplicara una multa de ";
			$mensaje .= "<strong>$10.00 pesos por <u>cada día</u> de retraso</strong>, ";
			$mensaje .= "conforme al reglamento del servicio de préstamo a domicilio.";
			$mensaje .= "<br/><br/>Agradecemos tu atención y tu compromiso para mantener en buen estado ";
			$mensaje .= "y disponible el material bibliográfico para todos los usuarios.";
            $mensaje .= "<br/>Si ya realizaste la devolución, por favor ignora este mensaje.";
			
			$log = "CORREO enviado a ".$para." de los libros: ".$titulosEjemplares;
			if($this->correo->Enviar($para, $asunto, $mensaje)){
				$this->AccesoBD->grabarLogEnvioCorreo($log,false);
;			}else{
				$this->AccesoBD->grabarLogEnvioCorreo($log,true);
			}
			pre($mensaje);
		}

		
	}
}