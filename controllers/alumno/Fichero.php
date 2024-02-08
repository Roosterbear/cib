<?php

class Fichero extends \CI_Controller{

	public function index(){
	
		$this->load->view("header");
		$this->load->view("alumno/ficheroVw");
		$this->load->view("footer");
	}
	

	public function buscar(){
		
		$_busqueda = $_POST['busqueda'];
		echo "<h1>{$_busqueda}<h1>";
	}
}



