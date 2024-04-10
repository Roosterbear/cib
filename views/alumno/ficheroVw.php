<div class="container-fluid">
<img src="/cib/assets/img/world-book.png" class="icono" /><h4 class="bib-titulo">Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row areaBuscar">
		
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar rhino"></i>
			<i class="fa fa-book iconoBuscar color-icono"></i>
			<label class="labelBuscar">Por Titulo:</label>
			<input name="inputBuscar" class="form-control inputBuscar" id="inputBuscar" onpaste="return false"/>
		</div>
			
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<i class="fa fa-search iconoBuscar rhino"></i>
			<i class="fa fa-user-circle iconoBuscar color-icono"></i>
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
		let value = '';

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
		  value = quitarGuiones(inputBuscar.value);
			$.post("<?=site_url("admin/BuscadorFicha/buscar")?> ",{busqueda:value}, function(resp){
				$("#contenidoData").html( resp );
			});
		});


		$(inputBuscarAutor).on("keyup",function(){
		  value = quitarGuiones(inputBuscarAutor.value);
			$.post("<?=site_url("admin/BuscadorFicha/buscarAutor")?> ",{busqueda:value}, function(resp){
				$("#contenidoData").html( resp );
			});
		});

	});



</script>