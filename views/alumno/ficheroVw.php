<div class="container-fluid">
<img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
	<div class="row areaBuscar">
		
		<div class="col-md-12">
			<i class="fa fa-search iconoBuscar"></i>
			<label class="labelBuscar">Buscar:</label>
			<input name="inputBuscar" class="form-control" id="inputBuscar" onpaste="return false"/>
		</div>

	</div><!-- row  -->

	
</form>
<div id="contenidoData"></div>

<script>
	
	
	$(document).ready(function(){
		const inputBuscar = document.querySelector("#inputBuscar");

		/* PERMITE SOLO LETRAS Y NUMEROS */
		$(inputBuscar).on("keydown", function(e){
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
	});
</script>