<h1>Estamos cambiando la ficha: <?php echo $id?></h1>
<!-- **************************************** -->
<!-- ****  EDICION DE FICHA PARA CAMBIO  **** -->
<!-- **************************************** -->
<div id="edicionFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
    
      <!-- Titulo Ficha -->
			<div class="col-md-4">		   	
			  <label class="labelCaptura" for="inputTituloFicha">Titulo: </label>
			  <input name="inputTituloFicha" class="form-control inputBuscar" id="inputTituloFicha" onpaste="return false"/>
		  </div>
			
      <!-- Autor Ficha -->
		  <div class="col-md-3">			 
			  <label class="labelCaptura" for="inputAutorFicha">Autor: </label>
			  <input name="inputAutorFicha" class="form-control inputBuscar" id="inputAutorFicha" onpaste="return false"/>
		  </div>
			
      <!-- Clasificacion Ficha -->
		  <div class="col-md-3">			 
			  <label class="labelCaptura" for="inputClasificacionFicha">Clasificacion: </label>
			  <input name="inputClasificacionFicha" class="form-control inputBuscar" id="inputClasificacionFicha" onpaste="return false"/>
		  </div>
       <div class="col-md-1"></div>
    </div>

		<div class="row areaCaptura">
			<div class="col-md-1"></div>
			<div class="col-md-10">
  			<div id="contenidoData"></div>
			</div>
			<div class="col-md-1"></div>
		</div>
</div>