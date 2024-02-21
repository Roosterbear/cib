<?php

class Libros extends \CI_Controller{

	
	
	public function __construct(){
		parent:: __construct();	
	
		
	}
	
	public function index(){	
		$this->load->view("header");
		$this->load->view("/admin/ABCTemplateVw");
		$this->load->view("/admin/librosVw");
		$this->load->view("footer");
	}
	

	
}

