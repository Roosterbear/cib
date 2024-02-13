<div class="container-fluid">
<img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row areaBuscar">
		
		<div class="col-md-2">
			<label>Buscar:</label><br>
			<input name="inputBuscar" class="form-control" id="inputBuscar" onpaste="return false"/>
		</div>

		<div class="col-md-2"><br>
			<button id="botonBuscar" class="btn btn-block btn-primary btn-sm">Buscar <i class="fa fa-search" aria-hidden="true"></i>
			</button>
		</div>

	</div><!-- row  -->

	
</form>
<div class="contenedorData">
	<div id="contenidoData">contenido</div>
</div>

<script>
	
	
	$(document).ready(function(){
		const botonBuscar = document.querySelector("#botonBuscar");
		const inputBuscar = document.querySelector("#inputBuscar");
		
		botonBuscar.addEventListener("click", ()=>{
			console.log("BOTON APRETADO CORRECTAMENTE");
 		});

		/* PERMITE SOLO LETRAS Y NUMEROS */
		$(inputBuscar).on("keydown", function(e){
			let tecla = e.key;
			let regex = /[a-zA-Z0-9\s]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
		});

		$(inputBuscar).on("keyup",function(){
			$.post("<?=site_url("alumno/Fichero/buscar")?> ",{busqueda:$(inputBuscar).val()}, function(resp){
				$("#contenidoData").html( resp );
			});
		});
	});
</script>