<?php

class Fichero extends \CI_Controller{

	public function __construct(){
		parent:: __construct();	
		$this->load->model("Ficha");
	}
	
	public function index(){
	
		$this->load->view("header");
		$this->load->view("alumno/ficheroVw");
		$this->load->view("footer");
	}
	

	public function buscar(){
		
		$_busqueda = $_POST['busqueda'];
		$ficha = new Ficha();
		
		echo "<h1>{$_busqueda} {$ficha->buscarLibro()}<h1>";
	}
}



