<div class="container-fluid">
<h4>Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row">
		
	<div class="col-md-2">
			<label>Buscar:</label><br>
			<input name="inputBuscar" class="form-control" id="inputBuscar">
		</div>

		<div class="col-md-2"><br>
			<button id="buscarTitulo" class="btn btn-block btn-primary btn-sm">Buscar <i class="fa fa-search" aria-hidden="true"></i>
			</button>
		</div>

	</div><!-- row  -->

	<div class="row checks">
		<label class="checkbox-container">Author
			<input type="checkbox">
			<span class="checkmark"></span>
		</label>
		<label class="checkbox-container">Titulo
			<input type="checkbox" checked>
			<span class="checkmark"></span>
		</label>
	</div>
</form>
<div id="contenidoData"></div>

<script>
	
	
	$(document).ready(function(){
		const botonBuscar = document.querySelector("#buscarTitulo");
		const inputBuscar = document.querySelector("#inputBuscar");
		
		botonBuscar.addEventListener("click", ()=>{
			console.log("BOTON APRETADO CORRECTAMENTE");
 		});
		
		$(inputBuscar).on("keyup",function(){
			$.post("<?=site_url("alumno/Fichero/buscar")?> ",{busqueda:$(inputBuscar).val()}, function(resp){
				$("#contenidoData").html( resp );
			});
		});
	});
</script>