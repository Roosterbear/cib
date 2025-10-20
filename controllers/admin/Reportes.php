<?php

/** 
 * @author jguerrero
 * 
 */
class Reportes extends \CI_Controller {
	
	/**
	 * 
	 * @var Biblioteca
	 */
	public $biblioteca;
	
	/**
	 * 
	 * @var PHPExcel
	 */
	public $excel;

	/**
	 *
	 * @return void
	 *
	 */
	public function __construct() {
		
		parent::__construct ();
		$this->load->library("Biblioteca");
		//$this->load->library("PHPExcel");
		$this->load->helper("alerta");

	}
	
	public function index(){
		$this->load->view("admin/reportes/index");
	}
	
	protected function toExcel($array,$reporteNombre="Reporte"){
		// Create new PHPExcel object
		//$objPHPExcel = new PHPExcel();
		// Set document properties

		// Set document properties
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Sistema CIB")
									 ->setLastModifiedBy("Sistema CIB")
									 ->setTitle("$reporteNombre")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Report Generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php CIB Reporte")
									 ->setCategory("CIB Reportes Archivo");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Reporte');
		// Add some data
		
		ArrayToPHPExcel($objPHPExcel, $array);
		
		//Limpiamos el buffer de salida
		ob_end_clean();
		// Redirect output to a client�s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$reporteNombre.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	

	public function RptLibrosEnPrestamo($tipo="html"){
		try {
			$array=$this->biblioteca->ArrayLibrosEnPrestamo();
			if($tipo=="html"){
				echo $this->arrayToTable($array,"table table-bordered");
				exit;
			}elseif($tipo=="xlsx"){
				//$this->toExcel($array,"Libros_en_prestamo");
				
			}
			throw new Exception("Metodo de Exportacion desconocido.");
				
				
		}catch(Exception $e){
			echo show_error($e->getMessage());
		}
	}
	
	public function RptActivosEnPrestamo($tipo="html"){
		try {
			$array=$this->biblioteca->ArrayActivosEnPrestamo();
			
			if($tipo=="html"){
				echo $this->arrayToTable($array,"table table-bordered");
				exit;
			}elseif($tipo=="xlsx"){
				$this->toExcel($array,"Libros_en_prestamo");
			
			}
			throw new Exception("Metodo de Exportaci�n desconocido.");;

		}catch(Exception $e){
			echo show_error($e->getMessage());
		}
	}
	
	public function RptActivosHistorico($tipo="html"){
		try {
			$array=$this->biblioteca->ArrayActivosHistorico();
				
			if($tipo=="html"){
				echo $this->arrayToTable($array,"table table-bordered");
				exit;
			}elseif($tipo=="xlsx"){
				//$this->toExcel($array,"Libros_en_prestamo");
					
			}
			throw new Exception("Metodo de Exportaci�n desconocido.");;
	
		}catch(Exception $e){
			echo show_error($e->getMessage());
		}
	}
	
	public function RptLibrosEnPrestamoVencidos($tipo="html"){
		try {
			$array=$this->biblioteca->ArrayLibrosEnPrestamoVencidos();
				
			if($tipo=="html"){
				echo $this->arrayToTable($array,"table table-bordered");
				exit;
			}elseif($tipo=="xlsx"){
				//$this->toExcel($array,"Libros_en_prestamo");
					
			}
			throw new Exception("Metodo de Exportaci�n desconocido.");
	
	
		}catch(Exception $e){
			echo show_error($e->getMessage());
		}
	}
	
	protected function arrayToTable($array,$class="",$recursive = false, $return = false, $null = '&nbsp;'){
		// Sanity check
		if(empty($array) || !is_array($array)){ return false; }
		if(!isset($array[0]) || !is_array($array[0])){ $array = array($array); }
	
		// Start the table
		$table = "<table class=\"$class\">\n";
		// The header
		$table .= "\t<tr>";
		// Take the keys from the first row as the headings
		foreach (array_keys($array[0]) as $heading) {
			$table .= '<th>' . $heading . '</th>';
		}
		$table .= "</tr>\n";
	
		// The body
		foreach ($array as $row) {
			$table .= "\t<tr>" ;
			foreach ($row as $cell) {
				$table .= '<td>';
	
				// Cast objects
				if (is_object($cell)) { $cell = (array) $cell; }
				if ($recursive === true && is_array($cell) && !empty($cell)) {
					// Recursive mode
					$table .= "\n" . $this->arrayTotable($cell, true, true) . "\n";
				} else {
					$table .= (strlen($cell) > 0) ?
					$cell :
					$null;
				}
				$table .= '</td>';
			}
			$table .= "</tr>\n";
		}
		// End the table
		$table .= '</table>';
		// Method of output
		if ($return === false) {
			echo $table;
		} else {
			return $table;
		}
	}
	
	
	
}

?>