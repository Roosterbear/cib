<div class="container-fluid">
<img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row areaBuscar">
		
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar"></i>
			<i class="fa fa-book iconoBuscar"></i>
			<label class="labelBuscar">Buscar por titulo:</label>
			<input name="inputBuscar" class="form-control" id="inputBuscar" onpaste="return false"/>
		</div>
			
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar"></i>
			<i class="fa fa-user-circle iconoBuscar"></i>
			<label class="labelBuscarAutor">Buscar por autor:</label>
			<input name="inputBuscarAutor" class="form-control" id="inputBuscarAutor" onpaste="return false"/>
		</div>
	</div><!-- row  -->

	
</form>
<div id="contenidoData"></div>

<script>
	
	
	$(document).ready(function(){
		const inputBuscar = document.querySelector("#inputBuscar");
		const inputBuscarAutor = document.querySelector("#inputBuscarAutor");

		/* PERMITE SOLO LETRAS Y NUMEROS */
		$(inputBuscar).on("keydown", function(e){
			let tecla = e.key;
			let regex = /[a-zA-Z0-9\+\#\:\.\s]/;
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
		});

		$(inputBuscarAutor).on("keydown", function(e){
			let tecla = e.key;
			let regex = /[a-zA-Z0-9\+\#\:\.\s]/;
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


		$(inputBuscarAutor).on("keyup",function(){
			$.post("<?=site_url("alumno/Fichero/buscarAutor")?> ",{busqueda:$(inputBuscarAutor).val()}, function(resp){
				$("#contenidoData").html( resp );
			});
		});

	});



</script>