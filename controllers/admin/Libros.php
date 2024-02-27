<?php

class Libros extends \CI_Controller{

	
	
	public function __construct(){
		parent:: __construct();	
	
		
	}
	
	public function index(){			
		$this->load->view("header");		
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/fichaVw");
		$this->load->view("/admin/altaFichaVw");
		$this->load->view("/admin/bajaFichaVw");
		$this->load->view("/admin/cambioFichaVw");
		$this->load->view("/admin/ejemplarVw");
		$this->load->view("/admin/altaEjemplarVw");
		$this->load->view("/admin/bajaEjemplarVw");
		$this->load->view("/admin/cambioEjemplarVw");
		$this->load->view("footer");
	}
	
		
}

