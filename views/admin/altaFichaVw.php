<!-- ********************** -->
<!-- ** CAPTURA DE FICHA ** -->
<!-- ********************** -->
<div id="altaFicha">
	<div class="container-fluid">
		<div class="row areaCaptura">
			<!-- Captura de TITULO del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura" for="inputTituloFicha">Titulo:</label>
				<input name="inputTituloFicha" class="form-control inputCaptura altaFicha" id="inputTituloFicha" onpaste="return false" required/>
			</div>
			
			<!-- Captura de AUTOR del Libro -->
			<div class="col-md-5">
				<i class="fa fa-user iconoCaptura"></i>
				<label class="labelCaptura" for="inputAutorFicha">Autor:</label>
				<input name="inputAutorFicha" class="form-control inputCaptura altaFicha" id="inputAutorFicha" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de ISBN del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura" for="inputISBNFicha">ISBN:</label>
				<input name="inputISBNFicha" class="form-control inputCaptura altaFicha" id="inputISBNFicha" onpaste="return false"/>
			</div>
			<!-- Captura de Clasificacion del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura" for="inputClasificacionFicha">Clasificacion:</label>
				<input name="inputClasificacionFicha" class="form-control inputCaptura altaFicha" id="inputClasificacionFicha" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>

		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-primary" id="btnGuardarAltaFicha">&nbsp;Guardar&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<div class="mensajes">
	<div id="data"></div>
</div>

<script>

const link = "<?=site_url("admin/Libros/addFicha")?>";

$(document).ready(function(){
	const data = document.querySelector("#data");

	const btnGuardarAltaFicha = document.querySelector("#btnGuardarAltaFicha");

	$(inputTituloFicha).on("keydown", function(e){
		let tecla = e.key;
		blockey(tecla,e);
	});

	$(inputAutorFicha).on("keydown", function(e){
		let tecla = e.key;
		blockey(tecla,e);
	});

	$(inputISBNFicha).on("keydown", function(e){
		let tecla = e.key;
		blockey(tecla,e);
	});

	$(inputClasificacionFicha).on("keydown", function(e){
		let tecla = e.key;
		blockey(tecla,e);
	});

	btnGuardarAltaFicha.addEventListener('click', function(){
		const titulo = $('#inputTituloFicha').val().trim();
		const autor = $('#inputAutorFicha').val().trim();
		const isbn = $('#inputISBNFicha').val().trim();
		const clasificacion = $('#inputClasificacionFicha').val().trim();

		const titulo0k = validarTituloAltaFicha(titulo);
		const autor0k = validarAutorAltaFicha(autor);
		const isbn0k = validarISBNAltaFicha(isbn);
		const clasificacion0k = validarClasificacionAltaFicha(clasificacion);

		const altaFichaValidada = (titulo0k&&autor0k&&isbn0k&&clasificacion0k)?true:false;	

		if (altaFichaValidada){
			$.post(link,{titulo:titulo,
									autor:autor,
									isbn:isbn,
									clasificacion:clasificacion
				},function(resp){
				$("#data").html(resp);
			});//post
		}else{
			$("#data").html("Faltan campos por llenar");
		}
	});
});
</script>