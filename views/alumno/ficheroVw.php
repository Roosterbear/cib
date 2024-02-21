<div class="container-fluid">
<img src="/cib/assets/img/world-book.png" class="icono" /><h4 class="bib-titulo">Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row areaBuscar">
		
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar rhino"></i>
			<i class="fa fa-book iconoBuscar real"></i>
			<label class="labelBuscar">Por Titulo:</label>
			<input name="inputBuscar" class="form-control inputBuscar" id="inputBuscar" onpaste="return false"/>
		</div>
			
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar rhino"></i>
			<i class="fa fa-user-circle iconoBuscar real"></i>
			<label class="labelBuscarAutor">Por Autor:</label>
			<input name="inputBuscarAutor" class="form-control inputBuscar" id="inputBuscarAutor" onpaste="return false"/>
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
			inputBuscarAutor.value = '';
			if(!regex.test(tecla)){
				e.preventDefault();
				return false;
			}
		});

		$(inputBuscarAutor).on("keydown", function(e){
			let tecla = e.key;
			let regex = /[a-zA-Z0-9\+\#\:\.\s]/;
			inputBuscar.value = '';
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