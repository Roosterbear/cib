<?php 
class CIB {
	public $db;
	
	public function __construct() {
		// Para utilizar las bases de datos en librerias
		//$this->db = &get_instance()->db;
		
		// Funciones utiles
		// $rs=$this->db->Execute($sql);
        // $rs->getArray();
        // $rs->fields['descripcion'];
	}
	
	
	// Regresar datos de libro como tabla HTML para DETALLE
	public function getBook($array){
			
		$consecutivo = 0;
		// No | Titulo | Autor | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th>No.</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th></tr></thead>";
		
		$tabla .= "<tbody>";
		
		foreach ($array as $a){
			$consecutivo++;			
			$titulo = $a['titulo'];
			$autor = $a['autor'];
			$clasificacion = $a['clasificacion'];
			
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$consecutivo}</td>";
			$tabla .= "<td>{$titulo}</td>";
			$tabla .= "<td>{$autor}</td>";
			$tabla .= "<td>{$clasificacion}</td>";
			$tabla .= "</tr>";
			
		}
		
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		return $tabla;		
	}
	
	// Regresar datos de libro como tabla HTML para CAMBIO
	public function getBookCambio($array){
		/* VIENE DE /model/Ficha/buscarLibroCambio($busqueda,$autor)*/	
		$consecutivo = 0;
		// No | Titulo | Autor | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th>No.</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th>";
		$tabla .= "<th><i class=\"fa fa-pencil-square\" aria-hidden=\"true\"></i> EDITAR</th></tr></thead>";
		$tabla .= "<tbody>";
	
		foreach ($array as $a){
			$consecutivo++;
			$id = $a['id'];
			$titulo = $a['titulo'];
			$autor = $a['autor'];
			$clasificacion = $a['clasificacion'];
			$isbn = $a['isbn'];
				
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$consecutivo}</td>";
			$tabla .= "<td>{$titulo}</td>";
			$tabla .= "<td>{$autor}</td>";
			$tabla .= "<td>{$clasificacion}</td>";
			$tabla .= "<td class=\"text-center lapicito\"><a href=\"updateFicha/{$id}\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";
			$tabla .= "</tr>";
				
		}
	
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		return $tabla;
	}
	
	
	/* ABC */
	public function getFicha($array){
		
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th>Id</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ISBN</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th></tr></thead>";
		$tabla .= "<tbody>";
		foreach ($array as $a){			
			$id = $a['id'];
			$titulo = $a['titulo'];
			$autor = $a['autor'];
			$isbn = $a['isbn'];
			$clasificacion = $a['clasificacion'];
				
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$id}</td>";
			$tabla .= "<td>{$titulo}</td>";
			$tabla .= "<td>{$autor}</td>";
			$tabla .= "<td>{$isbn}</td>";
			$tabla .= "<td>{$clasificacion}</td>";
			$tabla .= "</tr>";
				
		}
		
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		return $tabla;
		
	}
	
	public function getOneFicha($ficha){
		//return "<pre>".var_dump($ficha)."</pre>";
		
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th>Id</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ISBN</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th></tr></thead>";
		$tabla .= "<tbody>";
		
		if(isset($ficha[0]['Id'])){
			$id = $ficha[0]['Id'];
			$titulo = $ficha[0]['titulo'];
			$autor = $ficha[0]['autor'];
			$isbn = $ficha[0]['ISBN'];
			$clasificacion = $ficha[0]['clasificacion'];
		
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$id}</td>";
			$tabla .= "<td>{$titulo}</td>";
			$tabla .= "<td>{$autor}</td>";
			$tabla .= "<td>{$isbn}</td>";
			$tabla .= "<td>{$clasificacion}</td>";
			$tabla .= "</tr>";
		}else{
			return "<div class=\"mensaje tomato\">ID no encontrado</div>";
		}
		
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		
		return $tabla;
	}
	
	
	public function getEjemplar($array){
	
		// IdFicha | numAdquisicion | titulo | autor | clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th> FICHA </th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ADQ</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";		
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th></tr></thead>";
		$tabla .= "<tbody>";
		foreach ($array as $a){
			$idFicha = $a['idFicha'];
			$adquisicion = $a['numAdquisicion'];
			$titulo = $a['titulo'];
			$autor = $a['autor'];			
			$clasificacion = $a['clasificacion'];
	
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$idFicha}</td>";
			$tabla .= "<td>{$adquisicion}</td>";
			$tabla .= "<td>{$titulo}</td>";
			$tabla .= "<td>{$autor}</td>";			
			$tabla .= "<td>{$clasificacion}</td>";
			$tabla .= "</tr>";
	
		}
	
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		return $tabla;
	
	}
	
	
	
}
?>