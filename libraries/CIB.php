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
		$tabla .= "<th><i class=\"fa fa-id-badge\" aria-hidden=\"true\"></i> ID</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th></tr></thead>";
		
		$tabla .= "<tbody>";
		
		foreach ($array as $a){
			$consecutivo++;			
			$id = $a['id'];
			$titulo = $a['titulo'];
			$autor = $a['autor'];
			$clasificacion = $a['clasificacion'];
			
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\">{$consecutivo}</td>";
			$tabla .= "<td class=\"text-center\">{$id}</td>";			
			$tabla .= "<td><a href=\"../../admin/Libros/detalleFichero/{$id}\">{$titulo}</a></td>";
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
		$tabla .= "<tr><th> No. </th>";		
		$tabla .= "<th> TITULO </th>";
		$tabla .= "<th> AUTOR </th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION </th>";
		$tabla .= "<th> EDITAR </th></tr></thead>";
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
			$tabla .= "<td class=\"text-center lapicito\"> <a href=\"updateFicha/{$id}\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a> </td>";
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
		$tabla .= "<tr><th class=\"text-center\">Id</th>";
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
			return "<div class=\"mensaje alert\">ID no encontrado</div>";
		}
		
		$tabla .= "</tbody>";
		$tabla .= "</table>";
		
		return $tabla;
	}
	
	public function getFichaEjemplares($ficha){
		//return "<pre>".var_dump($ficha)."</pre>";
	
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th class=\"text-center\">Id</th>";
		$tabla .= "<th><i class=\"fa fa-book\" aria-hidden=\"true\"></i> TITULO</th>";
		$tabla .= "<th><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i> AUTOR</th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ISBN</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th>";
		$tabla .= "<th class=\"text-center\"><i class=\"fa fa-archive\" aria-hidden=\"true\"></i>	ADQUISICION</th></tr></thead>";
		$tabla .= "<tbody>";
	
		if(isset($ficha[0]['Id'])){			
			foreach($ficha as $f){				
					$id = $f['Id'];
					$titulo = $f['titulo'];
					$autor = $f['autor'];
					$isbn = $f['ISBN'];
					$clasificacion = $f['clasificacion'];
					$adquisicion = $f['adquisicion'] == ''?' N/A':$f['adquisicion'];
			
					$tabla .= "<tr>";
					$tabla .= "<td class=\"text-center\">{$id}</td>";
					$tabla .= "<td>{$titulo}</td>";
					$tabla .= "<td>{$autor}</td>";
					$tabla .= "<td>{$isbn}</td>";
					$tabla .= "<td>{$clasificacion}</td>";
					$tabla .= "<td class=\"text-center\">{$adquisicion}</td>";
					$tabla .= "</tr>";
			}			
		}else{
			return "<div class=\"mensaje alert\">ID no encontrado</div>";							
		}	
		$tabla .= "</tbody>";
		$tabla .= "</table>";
	
		return $tabla;
	}
	
	public function getFichaEjemplaresBorrar($ficha){
	
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th class=\"text-center\">Id</th>";
		$tabla .= "<th> TITULO </th>";
		$tabla .= "<th> AUTOR </th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ISBN</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th>";
		$tabla .= "<th class=\"text-center\"><i class=\"fa fa-archive\" aria-hidden=\"true\"></i>	ADQUISICION</th>";
		$tabla .= "<th class=\"text-center\"> ELIMINAR</th></tr></thead>";
		$tabla .= "<tbody>";
	
		if(isset($ficha[0]['Id'])){
			foreach($ficha as $f){
				$id = $f['Id'];
				$titulo = $f['titulo'];
				$autor = $f['autor'];
				$isbn = $f['ISBN'];
				$clasificacion = $f['clasificacion'];
				$adquisicion = $f['adquisicion'] == ''?' N/A':$f['adquisicion'];
				$ide = $f['ide'];
				
				$tabla .= "<tr>";
				$tabla .= "<td class=\"text-center\">{$id}</td>";
				$tabla .= "<td>{$titulo}</td>";
				$tabla .= "<td>{$autor}</td>";
				$tabla .= "<td>{$isbn}</td>";
				$tabla .= "<td>{$clasificacion}</td>";
				$tabla .= "<td class=\"text-center\">{$adquisicion}</td>";
				$tabla .= "<td class=\"text-center\"><a href=\"deleteEjemplar/{$ide}\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>";				
				$tabla .= "</tr>";
			}
		}else{
			return "<div class=\"mensaje alert\">ID no encontrado</div>";
		}
		$tabla .= "</tbody>";
		$tabla .= "</table>";
	
		return $tabla;
	}
	
	public function getFichaEjemplaresCambiar($ficha){
	
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th class=\"text-center\">Id</th>";
		$tabla .= "<th> TITULO </th>";
		$tabla .= "<th> AUTOR </th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i> ISBN</th>";
		$tabla .= "<th><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	CLASIFICACION</th>";
		$tabla .= "<th><i class=\"fa fa-archive\" aria-hidden=\"true\"></i>	ADQUISICION</th>";
		$tabla .= "<th class=\"text-center\"> EDITAR</th></tr></thead>";
		$tabla .= "<tbody>";
	
		if(isset($ficha[0]['Id'])){
			foreach($ficha as $f){
				$id = $f['Id'];
				$titulo = $f['titulo'];
				$autor = $f['autor'];
				$isbn = $f['ISBN'];
				$clasificacion = $f['clasificacion'];
				$adquisicion = $f['adquisicion'] == ''?' N/A':$f['adquisicion'];
				$ide = $f['ide'];
	
				$tabla .= "<tr>";
				$tabla .= "<td class=\"text-center\">{$id}</td>";
				$tabla .= "<td>{$titulo}</td>";
				$tabla .= "<td>{$autor}</td>";
				$tabla .= "<td>{$isbn}</td>";
				$tabla .= "<td>{$clasificacion}</td>";
				$tabla .= "<td>{$adquisicion}</td>";
				$tabla .= "<td class=\"text-center\"><a href=\"updateEjemplar/{$ide}\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";
				$tabla .= "</tr>";
			}
		}else{
			return "<div class=\"mensaje alert\">ID no encontrado</div>";
		}
		$tabla .= "</tbody>";
		$tabla .= "</table>";
	
		return $tabla;
	}
	
	public function getFichaEjemplaresMostrar($ficha){
	
		// Id | Titulo | Autor | ISBN | Clasificacion
		$tabla = "<table class=\"cib-table\"><thead>";		
		$tabla .= "<th class=\"text-center\"> <small>TITULO</small> </th>";		
		$tabla .= "<th class=\"text-center\"><i class=\"fa fa-barcode\" aria-hidden=\"true\"></i>	<small>CLASIFICACION</small></th>";
		$tabla .= "<th class=\"text-center\"><i class=\"fa fa-archive\" aria-hidden=\"true\"></i>	<small>ADQUISICION</small></th>";
		$tabla .= "<th class=\"text-center\"> <small>AGREGAR</small></th></tr></thead>";
		$tabla .= "<tbody>";
	
		if(isset($ficha[0]['Id'])){
			foreach($ficha as $f){				
				$titulo = $f['titulo'];
				$clasificacion = $f['clasificacion'];
				$adquisicion = $f['adquisicion'] == ''?' N/A':$f['adquisicion'];
				$ide = $f['ide'];	
				$tabla .= "<tr>";				
				$tabla .= "<td><small>{$titulo}</small></td>";								
				$tabla .= "<td><small>{$clasificacion}</small></td>";
				$tabla .= "<td><small>{$adquisicion}</small></td>";
				$tabla .= "<td class=\"text-center\"><button class=\"add-sign\" data-ejemplar=\"{$ide}\"><i class=\"fa fa-plus-circle fa-2x green add\" aria-hidden=\"true\"></i></button></td>";
				$tabla .= "</tr>";
			}
		}else{
			return "<div class=\"mensaje alert\">ID no encontrado</div>";
		}
		$tabla .= "</tbody>";
		$tabla .= "</table>";
	
		return $tabla;
	}

	
	public function getBigSearch($array){		
		
		// titulo, autor, fecha, isbn, clasificacion, numAdquisicion, ejemplar, volumen, tomo, accesible
		$tabla = "<table class=\"cib-table\"><thead>";
		$tabla .= "<tr><th><small> No. </small></th>";
		$tabla .= "<th class=\"text-center\"><small> FICHA </small></th>";
		$tabla .= "<th class=\"text-center\"><small> TITULO </small></th>";
		$tabla .= "<th class=\"text-center\"><small> AUTOR </small></th>";		
		$tabla .= "<th class=\"text-center\"><small> ISBN </small></th>";
		$tabla .= "<th class=\"text-center\"><small> CLASIFICACION </small></th>";
		$tabla .= "<th class=\"text-center\"><small> ADQUISICION </small></th>";
		$tabla .= "<th class=\"text-center\"><small> EJEMPLAR </small></th>";
		$tabla .= "<th class=\"text-center\"><small> VOLUMEN </small></th>";
		$tabla .= "<th class=\"text-center\"><small> TOMO </small></th>";		
		$tabla .= "<tbody>";
		
		$contador = 0;
		foreach ($array as $a){
			$contador = $contador+1;
			$ficha = $a['ficha'];
			$titulo = $a['titulo'];
			$autor = $a['autor'];			
			$isbn = $a['isbn'];
			$clasificacion = $a['clasificacion'];
			$adquisicion = $a['numAdquisicion'];
			$ejemplar = $a['ejemplar'];
			$volumen = $a['volumen'];
			$tomo = $a['tomo'];
			//$accesible = $a['accesible'];
	
			$tabla .= "<tr>";
			$tabla .= "<td class=\"text-center\"><small>{$contador}</small></td>";			
			$tabla .= "<td class=\"text-center\"><small><strong>{$ficha}</strong></small></td>";
			$tabla .= "<td><small>{$titulo}</small></td>";
			$tabla .= "<td><small>{$autor}</small></td>";			
			$tabla .= "<td class=\"text-center\"><small>{$isbn}</small></td>";
			$tabla .= "<td><small>{$clasificacion}</small></td>";
			$tabla .= "<td class=\"text-center\"><small>{$adquisicion}</small></td>";
			$tabla .= "<td class=\"text-center\"><small>{$ejemplar}</small></td>";
			$tabla .= "<td class=\"text-center\"><small>{$volumen}</small></td>";
			$tabla .= "<td class=\"text-center\"><small>{$tomo}</small></td>";			
			$tabla .= "</tr>";
	
		}
	
		$tabla .= "</tbody>";
		$tabla .= "</table>";
	
		return $tabla;
	
	}
	
		
	public function getEjemplar($array){
		/* ESTA FUNCION YA NO LA VOY A UTILIZAR */
	
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