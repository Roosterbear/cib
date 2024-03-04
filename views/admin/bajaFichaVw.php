<!-- ***************************************** -->
<!-- **  BUSQUEDA DE FICHA PARA DAR DE BAJA ** -->
<!-- ***************************************** -->
<div id="busquedaFichaBajaFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-5">
		   	<i class="fa fa-search iconoBuscar rhino"></i>
			  <i class="fa fa-book iconoBuscar color-icono"></i>
			  <label class="labelBuscarPorIDBajaFicha">Por ID:</label>
			  <input name="inputBuscarPorID" class="form-control inputBuscarPorID" id="inputBuscarPorID" onpaste="return false"/>
		   </div>
			
      <!-- Busqueda de Ficha por ISBN -->
		  <div class="col-md-5">
			  <i class="fa fa-search iconoBuscar rhino"></i>
			  <i class="fa fa-user-circle iconoBuscar color-icono"></i>
			  <label class="labelBuscarAutorBajaFicha">Por ISBN:</label>
			  <input name="inputBuscarAutorBajaFicha" class="form-control inputBuscar" id="inputBuscarAutorBajaFicha" onpaste="return false"/>
		   </div>
			 <div class="col-md-1"></div>
	    </div><!-- row  -->
    <div id="contenidoData"></div>
  </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<small>Aqui se van a mostrar dos campos de busqueda: ID y ISBN y el resultado tendra un icono para borrar</small>
<br/>
<small>Mostrar un mensaje de si esta seguro borrar</small>
<br/>
<small>Por seguridad solo buscar por los campos especificos menionados</small>
<br>
<small>Es <strong>IMPORTANTE</strong> que NO se pueda borrar una ficha si existen ejemplares de esa ficha</small>
<br/>