<!-- ***************************************** -->
<!-- **  BUSQUEDA DE FICHA PARA DAR DE BAJA ** -->
<!-- ***************************************** -->
<div id="busquedaBajaFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-5">
		   	<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura" for="inputBuscarPorIDBajaFicha">Por ID:</label>
			  <input name="inputBuscarPorIDBajaFicha" class="form-control inputBuscar" id="inputBuscarPorIDBajaFicha" onpaste="return false"/>
		   </div>
			
      <!-- Busqueda de Ficha por ISBN -->
		  <div class="col-md-5">
			  <i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-user-circle iconoBuscar"></i>
			  <label class="labelBuscar" for="inputBuscarPorISBNBajaFicha">Por ISBN:</label>
			  <input name="inputBuscarISBNBajaFicha" class="form-control inputBuscar" id="inputBuscarISBNBajaFicha" onpaste="return false"/>
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