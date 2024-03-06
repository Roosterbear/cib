<!-- ******************************************** -->
<!-- **  BUSQUEDA DE FICHA PARA ALTA EJEMPLAR  ** -->
<!-- ******************************************** -->
<div id="busquedaFichaAltaEjemplar">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-5">
		   	<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura">Por ID:</label>
			  <input name="inputBuscarPorIDAltaEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDAltaEjemplar" onpaste="return false"/>
		   </div>
			
      <!-- Busqueda de Ficha por ISBN -->
		  <div class="col-md-5">
			  <i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-user-circle iconoBuscar"></i>
			  <label class="labelCaptura">Por ISBN:</label>
			  <input name="inputBuscarPorISBNAltaEjemplar" class="form-control inputBuscar" id="inputBuscarPorISBNAltaEjemplar" onpaste="return false"/>
		   </div>
			 <div class="col-md-1"></div>
	    </div><!-- row  -->
    <div id="contenidoData"></div>
  </div>
</div>
<br/>

<!-- ***************************************************** -->
<!-- ** AREA PARA MOSTRAR FICHA Y EJEMPLARES CAPTURADOS ** -->
<!-- ***************************************************** -->
<div id="mostrarFichaConEjemplares"></div>
<br/>
<hr/>
<br/>
<!-- ************************* -->
<!-- ** CAPTURA DE EJEMPLAR ** -->
<!-- ************************* -->
<div id="altaEjemplar">
	<div class="container-fluid">
		<div class="row areaCaptura">
			<!-- Captura de No de Adquisicion -->
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura">No. de Adquisicion:</label>
				<input name="inputAdquisicionEjemplar" class="form-control inputBuscar" id="inputAdquisicionEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de ISBN del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">Tomo:</label>
				<input name="inputISBNEjemplar" class="form-control inputBuscar" id="inputISBNEjemplar" onpaste="return false"/>
			</div>
			<!-- Captura de Clasificacion del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Volumen:</label>
				<input name="inputClasificacionEjemplar" class="form-control inputBuscar" id="inputClasificacionEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<br/>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<label class="labelCaptura">Se presta</label> <input type="checkbox" name="checkSePrestaEjemplar" id="checkSePrestaEjemplar" />
			</div>
		</div>

		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-primary" id="btnGuardarAltaEjemplar">&nbsp;Guardar&nbsp;</button>
			</div>
		</div>
  
	</div>
</div>