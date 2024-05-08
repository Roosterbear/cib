<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">Edici&oacute;n de Ficha</h4>
    </div>
    <div class="col-md-3"></div>
    <br/>
  </div>   
  <hr/>
</div>
<!-- **************************************** -->
<!-- ****  EDICION DE FICHA PARA CAMBIO  **** -->
<!-- **************************************** -->
<div id="edicionFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
    
      <!-- Titulo Ficha -->
			<div class="col-md-5">		   	
			  <label class="labelCaptura" for="inputTituloFicha">Titulo: </label>
			  <input name="inputTituloFicha" class="form-control inputBuscar" id="inputTituloFicha" 
        value="<?php echo $titulo; ?>" onpaste="return false"/>
		  </div>
			
      <!-- Autor Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputAutorFicha">Autor: </label>
			  <input name="inputAutorFicha" class="form-control inputBuscar" id="inputAutorFicha" 
        value="<?php echo $autor; ?>" onpaste="return false"/>
		  </div>

			<div class="col-md-1"></div>
    </div>

    <div class="row areaCaptura">
      <div class="col-md-1"></div>
			
      <!-- Clasificacion Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputClasificacionFicha">Clasificacion: </label>
			  <input name="inputClasificacionFicha" class="form-control inputBuscar" id="inputClasificacionFicha" 
        value="<?php echo $clasificacion; ?>" onpaste="return false"/>
		  </div>


      <!-- ISBN Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputISBNFicha">ISBN: </label>
			  <input name="inputISBNFicha" class="form-control inputBuscar" id="inputISBNFicha" 
        value="<?php echo $isbn; ?>" onpaste="return false"/>
		  </div>

       <div class="col-md-1"></div>
    </div>
    <br/>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-success puntero" id="btnGuardarCambioFicha">&nbsp;Guardar&nbsp;</button>
			</div>
		</div>

</div>