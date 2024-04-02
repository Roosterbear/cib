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
			  <input name="inputBuscarPorISBNBajaFicha" class="form-control inputBuscar" id="inputBuscarPorISBNBajaFicha" onpaste="return false"/>
		   </div>
			 <div class="col-md-1"></div>
	    </div><!-- row  -->
    <div id="contenidoData"></div>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-primary puntero" id="btnBajaFicha">&nbsp;Mostrar&nbsp;</button>
			</div>
		</div>
	</div>
</div>
<div class="mensajes">
	<div id="data"></div>
	<div id="mensaje"></div>
</div>
<script>

	
$(document).ready(function(){
	const link = "<?=site_url("admin/Libros/deleteFicha")?>";
	const id = document.querySelector("#inputBuscarPorIDBajaFicha");
	const isbn = document.querySelector("#inputBuscarPorISBNBajaFicha");
	const data = document.querySelector("#data");
	const mensaje = document.querySelector("#mensaje");
	
	const btnBajaFicha = document.querySelector("#btnBajaFicha");
	let byID = 0;
	let value = '';

	$(inputBuscarPorIDBajaFicha).on("keydown", function(e){
		isbn.value = '';
		byID = 1;		
		let tecla = e.key;
		justDigits(tecla,e);
	});

	$(inputBuscarPorISBNBajaFicha).on("keydown", function(e){
		id.value = '';
		byID = 2;
		let tecla = e.key;
		blockey(tecla,e);
	});

	btnBajaFicha.addEventListener('click', ()=>{
		value = byID==1?id.value:isbn.value;
		$.post(link,{byID:byID,value:value},function(resp){
			$("#mensaje").html(resp);
		});
	});
});
</script>