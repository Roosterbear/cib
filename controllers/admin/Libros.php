<?php

/* --------------------------------------------- */
/* ESTE ES EL CONTROLADOR PARA EL ABC DE LIBROS */
/* ------------------------------------------- */
class Libros extends \CI_Controller{
	
	public function __construct(){
		parent:: __construct();	
		$this->load->model("Ficha");
		/*
		$this->load->library("UsuarioSITO",null,"usuario");
		
		$this->usuario->setUsername(@$_REQUEST["uid"]);
		$this->usuario->setSitoSession(@$_REQUEST["sid"]);
		
		if(!$this->usuario->login()){
			show_error("La session ha caducado o esta entrando con un usuario no valido",500,"Acceso Denegado");		
		}
		*/
		
	}
	
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
	
	public function getFichas(){
		
		$ficha = new Ficha();
		
	
		echo 'no funciona esta mierd@';
	}
	
	
	
		
}

