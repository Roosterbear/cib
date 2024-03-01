<!-- ************************* -->
<!-- **  BUSQUEDA DE FICHA  ** -->
<!-- ************************* -->
<div id="busquedaFichaCapturaEjemplar">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-5">
		   	<i class="fa fa-search iconoBuscar rhino"></i>
			  <i class="fa fa-book iconoBuscar color-icono"></i>
			  <label class="labelBuscarPorID">Por ID:</label>
			  <input name="inputBuscarPorID" class="form-control inputBuscarPorID" id="inputBuscarPorID" onpaste="return false"/>
		   </div>
			
      <!-- Busqueda de Ficha por ISBN -->
		  <div class="col-md-5">
			  <i class="fa fa-search iconoBuscar rhino"></i>
			  <i class="fa fa-user-circle iconoBuscar color-icono"></i>
			  <label class="labelBuscarAutor">Por ISBN:</label>
			  <input name="inputBuscarAutor" class="form-control inputBuscar" id="inputBuscarAutor" onpaste="return false"/>
		   </div>
			 <div class="col-md-1"></div>
	    </div><!-- row  -->
    <div id="contenidoData"></div>
  </div>
</div>


<!-- ***************************************************** -->
<!-- ** AREA PARA MOSTRAR FICHA Y EJEMPLARES CAPTURADOS ** -->
<!-- ***************************************************** -->
<div id="mostrarFichaConEjemplares"></div>

<!-- ************************* -->
<!-- ** CAPTURA DE EJEMPLAR ** -->
<!-- ************************* -->
<div id="capturaEjemplar">
	<div class="container-fluid">
		<div class="row areaCaptura">
			<!-- Captura de No de Adquisicion -->
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura">No. de Adquisicion:</label>
				<input name="inputAdquisicion" class="form-control inputBuscar altaLibro" id="inputAdquisicion" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de ISBN del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">Tomo:</label>
				<input name="inputISBN" class="form-control inputBuscar altaLibro" id="inputISBN" onpaste="return false"/>
			</div>
			<!-- Captura de Clasificacion del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Volumen:</label>
				<input name="inputClasificacion" class="form-control inputBuscar altaLibro" id="inputClasificacion" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
  </div>
</div>