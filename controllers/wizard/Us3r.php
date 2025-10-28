<?php

class Us3r extends \CI_Controller{
	public function __construct(){
		parent:: __construct();	
	}
	
	public function index(){
		$this->load->model("AccesoBD");

		// 
		$matriculas = $this->AccesoBD->test();
		foreach($matriculas as $m){
			echo $m."<br/>";
		}
		
	}
}