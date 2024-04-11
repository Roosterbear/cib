<!-- ***************************************** -->
<!-- ****  BUSQUEDA DE FICHA PARA CAMBIO  **** -->
<!-- ***************************************** -->
<div id="busquedaCambioFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por Titulo -->
			<div class="col-md-5">
		   	<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura" for="inputBuscarPorTituloCambioFicha">Por Titulo:</label>
			  <input name="inputBuscarPorTituloCambioFicha" class="form-control inputBuscar" id="inputBuscarPorTituloCambioFicha" onpaste="return false"/>
		   </div>
			
      <!-- Busqueda de Ficha por Autor -->
		  <div class="col-md-5">
			  <i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-user-circle iconoBuscar"></i>
			  <label class="labelBuscar" for="inputBuscarPorAutorCambioFicha">Por Autor:</label>
			  <input name="inputBuscarAutorCambioFicha" class="form-control inputBuscar" id="inputBuscarAutorCambioFicha" onpaste="return false"/>
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

<script>
	
	$(document).ready(function(){
		const inputBuscar = document.querySelector("#inputBuscarPorTituloCambioFicha");
		const inputBuscarAutor = document.querySelector("#inputBuscarAutorCambioFicha");

		/* PERMITE SOLO LETRAS Y NUMEROS */
		$(inputBuscar).on("keydown", function(e){
			let tecla = e.key;
			inputBuscarAutor.value = '';
			blockey(tecla,e);
		});

		$(inputBuscarAutor).on("keydown", function(e){
			let tecla = e.key;
			inputBuscar.value = '';
			blockey(tecla,e);
		});

		$(inputBuscar).on("keyup",function(){
			$.post("<?=site_url("admin/BuscadorFicha/buscar")?> ",{busqueda:$(inputBuscar).val()}, function(resp){
				$("#contenidoData").html( resp );
			});
		});


		$(inputBuscarAutor).on("keyup",function(){
			$.post("<?=site_url("admin/BuscadorFicha/buscarAutor")?> ",{busqueda:$(inputBuscarAutor).val()}, function(resp){
				$("#contenidoData").html( resp );
			});
		});

	});

</script>
