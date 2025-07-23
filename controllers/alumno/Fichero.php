<?php

class Fichero extends \CI_Controller{

	public function __construct(){
		parent:: __construct();	
	}
	
	public function index(){	
		$this->load->view("header");
		$this->load->view("alumno/ficheroVw");
		$this->load->view("footer");
	}	
}



