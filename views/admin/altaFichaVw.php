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
			<!-- Captura de Lugar del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-map-marker iconoCaptura"></i>
				<label class="labelCaptura" for="selectLugarFicha">Lugar:</label>
				<select name="selectLugarFicha" class="form-control inputCaptura altaFicha" id="selectLugarFicha">
					<option value="mexico">M&eacute;xico</option>
					<option value="usa">Estados Unidos</option>
					<option value="japon">Jap&oacute;n</option>
				</select>
			</div>
			<!-- Captura de Area del Libro -->
			<div class="col-md-5">
				<i class="fa fa-users iconoCaptura"></i>
				<label class="labelCaptura" for="selectAreaFicha">Area:</label>
				<select name="selectAreaFicha" class="form-control inputCaptura altaFicha" id="selectAreaFicha"/>
					<option value="general">General</option>
					<option value="basicas">Ciencias B&aacute;sicas</option>
				</select>
			</div>
			<div class="col-md-1"></div>
		</div>

		<div class="row areaCaptura">
			<!-- Captura de Descripcion -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-commenting iconoCaptura"></i>
				<label class="labelCaptura" for="inputDescripcionFicha">Descripcion:</label>
				<input name="inputDescripcionFicha" class="form-control inputCaptura altaFicha" id="inputDescripcionFicha" onpaste="return false"/>
			</div>
			<!-- Captura de Edicion -->
			<div class="col-md-5">
				<i class="fa fa-pencil-square-o iconoCaptura"></i>
				<label class="labelCaptura" for="inputEdicionFicha">Edicion:</label>
				<input type="text" name="inputEdicionFicha" class="form-control inputCaptura altaFicha" id="inputEdicionFicha" 
				onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>

		<br/>	
		<div class="row areaCaptura">
			<!-- Captura de Imagen -->
		</div>

		
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn btn-lg btn-primary" id="btnGuardarAltaFicha">&nbsp;Guardar&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<div id="data"></div>

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

	$(inputEdicionFicha).on("keydown", function(e){
		let tecla = e.key;
		blockeyEdicion(tecla,e);
	});

	btnGuardarAltaFicha.addEventListener('click', function(){
		const titulo = $('#inputTituloFicha').val();
		const autor = $('#inputAutorFicha').val();
		const isbn = $('#inputISBNFicha').val();
		const clasificacion = $('#inputClasificacionFicha').val();
		const lugar = document.querySelector('#selectLugarFicha').value;
		const area = document.querySelector('#selectAreaFicha').value;
		const descripcion = $('#inputDescripcionFicha').val();
		const edicion = $('#inputEdicionFicha').val();
		
		$.post(link,{titulo:titulo,
								autor:autor,
								isbn:isbn,
								clasificacion:clasificacion,
								lugar:lugar,
								area:area,
								descripcion:descripcion,
								edicion:edicion},function(resp){
			$("#data").html(resp);
		});
	});
});
</script>