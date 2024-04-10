<?php

class BuscadorFicha extends \CI_Controller{
	private $_author = 0;
	
	public function __construct(){
		parent:: __construct();
		$this->load->model("Ficha");
	}
	
	public function buscar(){
		$_autor = 0;
		$_busqueda = $_POST['busqueda'];
		$ficha = new Ficha();
		$libros = $ficha->buscarLibro($_busqueda, $_autor);
	
		echo $libros;
	}
	
	public function buscarAutor(){
		$_autor = 1;
		$_busqueda = $_POST['busqueda'];
		$ficha = new Ficha();
		$libros = $ficha->buscarLibro($_busqueda,$_autor);
	
		echo $libros;
	}
}
