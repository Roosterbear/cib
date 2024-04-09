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
			  <input name="inputBuscarPorISBNBajaFicha" class="form-control inputBuscar" id="inputBuscarPorISBNBajaFicha"/>
		   </div>
			 <div class="col-md-1"></div>
	    </div><!-- row  -->
    <div id="contenidoData"></div>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-success puntero" id="btnMostrarFichaBajaFicha">&nbsp;Mostrar Ficha&nbsp;</button>
			</div>
		</div>
	</div>
</div>
<div class="mensajes">
	<div id="data"></div>
</div>

<div class="row areaCaptura">
	<div class="col-md-12 text-center">
		<button class="btn btn-lg btn-danger puntero" id="btnBajaFicha">&nbsp;Eliminar Ficha?&nbsp;</button>
	</div>
</div>
<script>

	
$(document).ready(function(){
	const link_consulta = "<?=site_url("admin/Libros/showFicha")?>";
	const link_borrar = "<?=site_url("admin/Libros/deleteFicha")?>";
	
	const id = document.querySelector("#inputBuscarPorIDBajaFicha");
	const isbn = document.querySelector("#inputBuscarPorISBNBajaFicha");
	
	const data = document.querySelector("#data");
	const mensaje = document.querySelector("#mensaje");
	
	const btnBajaFicha = document.querySelector("#btnBajaFicha");
	const btnMostrarFichaBajaFicha = document.querySelector("#btnMostrarFichaBajaFicha");

	let byID = 0;
	let byID_a_borrar = 0;
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
	
	btnMostrarFichaBajaFicha.addEventListener('click', ()=>{
		value = byID==1?$("#inputBuscarPorIDBajaFicha").val():$("#inputBuscarPorISBNBajaFicha").val();
		byID_a_borrar = byID;
		btnBajaFicha.style = ("display:block");
		if(byID === 2) value = quitarGuiones(value);
		$.post(link_consulta,{byID:byID,value:value},function(resp){
				$("#data").html(resp);
		});
	});

	btnBajaFicha.addEventListener('click', ()=>{
		$.post(link_borrar,{byID:byID_a_borrar,value:value},function(resp){
			$("#data").html(resp);
		});	
		btnBajaFicha.style = ("display:none");
	});
});
</script>