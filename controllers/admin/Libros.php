<?php

class Libros extends \CI_Controller{

	
	
	public function __construct(){
		parent:: __construct();	
	
		
	}
	
	public function index(){			
		$this->load->view("header");		
		$this->load->view("/admin/ABCTemplateVw");								
		$this->load->view("footer");
	}
	
	/* ------- FICHA ------- */
	public function getFicha(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");		
		$this->load->view("/admin/fichaVw");
		$this->load->view("footer");
	}
	
	public function altaFicha(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/altaFichaVw");
		$this->load->view("footer");
	}
	
	public function bajaFicha(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/bajaFichaVw");
		$this->load->view("footer");
	}
	
	public function cambioFicha(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/cambioFichaVw");
		$this->load->view("footer");
	}
	
	/* ----- EJEMPLAR ----- */
	public function getEjemplar(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/ejemplarVw");
		$this->load->view("footer");
	}
	
	public function altaEjemplar(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/altaEjemplarVw");
		$this->load->view("footer");
	}
	
	public function bajaEjemplar(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/bajaEjemplarVw");
		$this->load->view("footer");
	}
	
	public function cambioEjemplar(){
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/cambioEjemplarVw");
		$this->load->view("footer");
	}
	
	
	
		
}

