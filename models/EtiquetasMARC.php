<?php

class EtiquetasMARC extends \CI_Model {

	private $ISBN;
	private $clasificacion_LC;
	private $autorPersonal;
	private $autorCorporativo;
	private $titulo_MencionDeResponsabilidad;
	private $edicion;
	private $lugar_Editorial;
	private $paginasVols_Dimensiones;
	private $notasGenerales;
	private $notasDeBibliografia;
	private $notasDeVersionOriginal;
	private $encabezadosBajoTemasGenerales;
	private $asientosSecundariosBajoAutorPersonal;
	private $asientosSecundariosBajoAutorCorporativo;
	private $ligaDeLosRecursosElectricos;
	private $tituloUniforme;
	
	public function __construct($marc=NULL) {
		parent::__construct ();
		if($marc!=null){
			$this->setEtiquetasMARC($marc);
		}
		
	}
	
	public function __toString(){
		return $this->getEtiquetasMARC();
	}
	
    /**
     * @return the $etiquetasMARC
     */
    public function getEtiquetasMARC()
    {
    	$etiquetasMARC="";
    	
        if($this->ISBN!=null){ $etiquetasMARC.="¦020".$this->ISBN; }
        if($this->clasificacion_LC!=null){ $etiquetasMARC.="¦050".$this->clasificacion_LC; }
        if($this->autorPersonal!=null){ $etiquetasMARC.="¦100".$this->autorPersonal; }
        if($this->autorCorporativo!=null){ $etiquetasMARC.="¦110".$this->autorCorporativo; }
        if($this->titulo_MencionDeResponsabilidad!=null){ $etiquetasMARC.="¦245".$this->titulo_MencionDeResponsabilidad; }
        if($this->edicion!=null){ $etiquetasMARC.="¦250".$this->edicion; }
        if($this->lugar_Editorial!=null){ $etiquetasMARC.="¦260".$this->lugar_Editorial; }
        if($this->paginasVols_Dimensiones!=null){ $etiquetasMARC.="¦300".$this->paginasVols_Dimensiones; }
        if($this->notasGenerales!=null){ $etiquetasMARC.="¦500".$this->notasGenerales; }
        if($this->notasDeBibliografia!=null){ $etiquetasMARC.="¦504".$this->notasDeBibliografia; }
        if($this->notasDeVersionOriginal!=null){ $etiquetasMARC.="¦534".$this->notasDeVersionOriginal; }
        if($this->encabezadosBajoTemasGenerales!=null){ $etiquetasMARC.="¦650".$this->encabezadosBajoTemasGenerales; }
        if($this->asientosSecundariosBajoAutorPersonal!=null){ $etiquetasMARC.="¦700".$this->asientosSecundariosBajoAutorPersonal; }
        if($this->asientosSecundariosBajoAutorCorporativo!=null){ $etiquetasMARC.="¦710".$this->asientosSecundariosBajoAutorCorporativo; }
        if($this->ligaDeLosRecursosElectricos!=null){ $etiquetasMARC.="¦850".$this->ligaDeLosRecursosElectricos; }
        if($this->tituloUniforme!=null){ $etiquetasMARC.="¦240".$this->tituloUniforme; }
        
        
        
        $etiquetasMARC.="Ì";
        
        return $etiquetasMARC;
    }

    protected function etiquetaDatos($etiquetasMARC,$codigo){
    	if(strpos($etiquetasMARC, "¦$codigo")!==false){
    		$inicio=strpos($etiquetasMARC, "¦$codigo")+4;
    		$fin=strpos($etiquetasMARC, "¦",$inicio);
    		if($fin===false){
    			
    			$fin=strpos($etiquetasMARC, "Ì");
    			//echo "\n$codigo : ".var_dump($fin);
    		}
    		$fin-=$inicio;
    	
    		return substr($etiquetasMARC,$inicio,$fin);
    	}
    }
    /**EL CHIDO
     * @param field_type $etiquetasMARC
     */
    public function setEtiquetasMARC($etiquetasMARC)
    {
    	
    	$this->setISBN($this->etiquetaDatos($etiquetasMARC, "020"));
    	$this->setClasificacion_LC($this->etiquetaDatos($etiquetasMARC, "050"));
    	$this->setAutorPersonal($this->etiquetaDatos($etiquetasMARC, "100"));
    	$this->setAutorCorporativo($this->etiquetaDatos($etiquetasMARC, "110"));
    	$this->setTitulo_MencionDeResponsabilidad($this->etiquetaDatos($etiquetasMARC, "245"));
    	$this->setEdicion($this->etiquetaDatos($etiquetasMARC, "250"));
    	$this->setLugar_Editorial($this->etiquetaDatos($etiquetasMARC, "260"));
    	$this->setPaginasVols_Dimensiones($this->etiquetaDatos($etiquetasMARC, "300"));
    	$this->setNotasGenerales($this->etiquetaDatos($etiquetasMARC, "500"));
    	$this->setNotasDeBibliografia($this->etiquetaDatos($etiquetasMARC, "504"));
    	$this->setNotasDeVersionOriginal($this->etiquetaDatos($etiquetasMARC, "534"));
    	$this->setEncabezadosBajoTemasGenerales($this->etiquetaDatos($etiquetasMARC, "650"));
    	$this->setAsientosSecundariosBajoAutorPersonal($this->etiquetaDatos($etiquetasMARC, "700"));
    	$this->setAsientosSecundariosBajoAutorCorporativo($this->etiquetaDatos($etiquetasMARC, "710"));
    	$this->setLigaDeLosRecursosElectricos($this->etiquetaDatos($etiquetasMARC, "850"));
    	$this->setTituloUniforme($this->etiquetaDatos($etiquetasMARC, "240"));
   
    }
	/**
	 * @return the $ISBN
	 */
	public function getISBN() {
		return $this->ISBN;
	}

	/**
	 * @return the $clasificacion_LC
	 */
	public function getClasificacion_LC() {
		return $this->clasificacion_LC;
	}

	/**
	 * @return the $autorPersonal
	 */
	public function getAutorPersonal() {
		return $this->autorPersonal;
	}

	/**
	 * @return the $autorCorporativo
	 */
	public function getAutorCorporativo() {
		return $this->autorCorporativo;
	}

	/**
	 * @return the $titulo_MencionDeResponsabilidad
	 */
	public function getTitulo_MencionDeResponsabilidad() {
		return $this->titulo_MencionDeResponsabilidad;
	}

	/**
	 * @return the $edicion
	 */
	public function getEdicion() {
		return $this->edicion;
	}

	/**
	 * @return the $lugar_Editorial
	 */
	public function getLugar_Editorial() {
		return $this->lugar_Editorial;
	}

	/**
	 * @return the $paginasVols_Dimensiones
	 */
	public function getPaginasVols_Dimensiones() {
		return $this->paginasVols_Dimensiones;
	}

	/**
	 * @return the $notasGenerales
	 */
	public function getNotasGenerales() {
		return $this->notasGenerales;
	}

	/**
	 * @return the $notasDeBibliografia
	 */
	public function getNotasDeBibliografia() {
		return $this->notasDeBibliografia;
	}

	/**
	 * @return the $notasDeVersionOriginal
	 */
	public function getNotasDeVersionOriginal() {
		return $this->notasDeVersionOriginal;
	}

	/**
	 * @return the $encabezadosBajoTemasGenerales
	 */
	public function getEncabezadosBajoTemasGenerales() {
		return $this->encabezadosBajoTemasGenerales;
	}

	/**
	 * @return the $asientosSecundariosBajoAutorPersonal
	 */
	public function getAsientosSecundariosBajoAutorPersonal() {
		return $this->asientosSecundariosBajoAutorPersonal;
	}

	/**
	 * @return the $asientosSecundariosBajoAutorCorporativo
	 */
	public function getAsientosSecundariosBajoAutorCorporativo() {
		return $this->asientosSecundariosBajoAutorCorporativo;
	}

	/**
	 * @return the $ligaDeLosRecursosElectricos
	 */
	public function getLigaDeLosRecursosElectricos() {
		return $this->ligaDeLosRecursosElectricos;
	}

	/**
	 * @return the $tituloUniforme
	 */
	public function getTituloUniforme() {
		return $this->tituloUniforme;
	}

	/**
	 * @param string $ISBN
	 */
	public function setISBN($ISBN) {
		if(strlen($ISBN)>200){ Throw new Exception("El ISBN debe ser maximo de 200 caracteres"); }
		$this->ISBN = $ISBN;
	}

	/**
	 * @param string $clasificacion_LC
	 */
	public function setClasificacion_LC($clasificacion_LC) {
		if(strlen($clasificacion_LC)<1){ Throw new Exception("Clasificación LC no puede estar vacío"); }
		if(strlen($clasificacion_LC)>300){ Throw new Exception("Clasificación LC debe ser maximo de 300 caracteres"); }
		$this->clasificacion_LC = $clasificacion_LC;
	}

	/**
	 * @param string $autorPersonal
	 */
	public function setAutorPersonal($autorPersonal) {
		if(strlen($autorPersonal)>300){ Throw new Exception("el autor personal debe ser maximo de 300 caracteres"); }
		$this->autorPersonal = $autorPersonal;
	}

	/**
	 * @param string $autorCorporativo
	 */
	public function setAutorCorporativo($autorCorporativo) {
	    
		if(strlen($autorCorporativo)>300){ Throw new Exception("El autor corporativo debe ser maximo de 300 caracteres"); }
		$this->autorCorporativo = $autorCorporativo;
	}

	/**
	 * @param string $titulo_MencionDeResponsabilidad
	 */
	public function setTitulo_MencionDeResponsabilidad($titulo_MencionDeResponsabilidad) {
		if(strlen($titulo_MencionDeResponsabilidad)<1){ Throw new Exception("El titulo no puede estar vacío"); }
	    if(strlen($titulo_MencionDeResponsabilidad)>300){ Throw new Exception("El titulo de librio debe ser maximo de 300 caracteres"); }
		$this->titulo_MencionDeResponsabilidad = $titulo_MencionDeResponsabilidad;
	}

	/**
	 * @param string $edicion
	 */
	public function setEdicion($edicion) {
		
		if(strlen($edicion)>300){ Throw new Exception("Edición debe ser maximo de 300 caracteres"); }
		$this->edicion = $edicion;
	}

	/**
	 * @param string $lugar_Editorial
	 */
	public function setLugar_Editorial($lugar_Editorial) {
		if(strlen($lugar_Editorial)<1){ Throw new Exception("Lugar/Editorial no puede estar vacío"); }
		if(strlen($lugar_Editorial)>300){ Throw new Exception("Lugar/Editorial debe ser maximo de 300 caracteres"); }
		$this->lugar_Editorial = $lugar_Editorial;
	}

	/**
	 * @param string $paginasVols_Dimensiones
	 */
	public function setPaginasVols_Dimensiones($paginasVols_Dimensiones) {
		if(strlen($paginasVols_Dimensiones)<1){ Throw new Exception("Paginas no puede estar vacío"); }
		if(strlen($paginasVols_Dimensiones)>300){ Throw new Exception("Paginas debe ser maximo de 300 caracteres"); }
		$this->paginasVols_Dimensiones = $paginasVols_Dimensiones;
	}

	/**
	 * @param string $notasGenerales
	 */
	public function setNotasGenerales($notasGenerales) {
		if(strlen($notasGenerales)>300){ Throw new Exception("Notas generales debe ser maximo de 300 caracteres"); }
		$this->notasGenerales = $notasGenerales;
	}

	/**
	 * @param string $notasDeBibliografia
	 */
	public function setNotasDeBibliografia($notasDeBibliografia) {
		if(strlen($notasDeBibliografia)>300){ Throw new Exception("Notas de bibliografia debe ser maximo de 300 caracteres"); }
		$this->notasDeBibliografia = $notasDeBibliografia;
	}

	/**
	 * @param string $notasDeVersionOriginal
	 */
	public function setNotasDeVersionOriginal($notasDeVersionOriginal) {
		if(strlen($notasDeVersionOriginal)>300){ Throw new Exception("Notas versión original debe ser maximo de 300 caracteres"); }
		$this->notasDeVersionOriginal = $notasDeVersionOriginal;
	}

	/**
	 * @param string $encabezadosBajoTemasGenerales
	 */
	public function setEncabezadosBajoTemasGenerales($encabezadosBajoTemasGenerales) {
		if(strlen($encabezadosBajoTemasGenerales)>300){ Throw new Exception("El encabezado bajo temas generales debe ser maximo de 300 caracteres"); }
		$this->encabezadosBajoTemasGenerales = $encabezadosBajoTemasGenerales;
	}

	/**
	 * @param string $asientosSecundariosBajoAutorPersonal
	 */
	public function setAsientosSecundariosBajoAutorPersonal($asientosSecundariosBajoAutorPersonal) {
		if(strlen($asientosSecundariosBajoAutorPersonal)>300){ Throw new Exception("Asientos secundarios bajo autor peronsl debe ser maximo de 300 caracteres"); }
		$this->asientosSecundariosBajoAutorPersonal = $asientosSecundariosBajoAutorPersonal;
	}

	/**
	 * @param string $asientosSecundariosBajoAutorCorporativo
	 */
	public function setAsientosSecundariosBajoAutorCorporativo($asientosSecundariosBajoAutorCorporativo) {
		if(strlen($asientosSecundariosBajoAutorCorporativo)>300){ Throw new Exception("Asientos secundarios bajo autor corporativo debe ser maximo de 300 caracteres"); }
		$this->asientosSecundariosBajoAutorCorporativo = $asientosSecundariosBajoAutorCorporativo;
	}

	/**
	 * @param string $ligaDeLosRecursosElectricos
	 */
	public function setLigaDeLosRecursosElectricos($ligaDeLosRecursosElectricos) {
		if(strlen($ligaDeLosRecursosElectricos)>300){ Throw new Exception("Liga a los recursos electricos debe ser maximo de 300 caracteres"); }
		$this->ligaDeLosRecursosElectricos = $ligaDeLosRecursosElectricos;
	}

	/**
	 * @param string $tituloUniforme
	 */
	public function setTituloUniforme($tituloUniforme) {
		if(strlen($tituloUniforme)>300){ Throw new Exception("El titulo uniforme debe ser maximo de 300 caracteres"); }
		$this->tituloUniforme = $tituloUniforme;
	}



}

?>