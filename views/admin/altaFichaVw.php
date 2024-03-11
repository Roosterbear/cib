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
				<input name="inputTituloFicha" class="form-control inputBuscar altaFicha" id="inputTituloFicha" onpaste="return false" required/>
			</div>
			
			<!-- Captura de AUTOR del Libro -->
			<div class="col-md-5">
				<i class="fa fa-user iconoCaptura"></i>
				<label class="labelCaptura" for="inputAutorFicha">Autor:</label>
				<input name="inputAutorFicha" class="form-control inputBuscar altaFicha" id="inputAutorFicha" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de ISBN del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura" for="inputISBNFicha">ISBN:</label>
				<input name="inputISBNFicha" class="form-control inputBuscar altaFicha" id="inputISBNFicha" onpaste="return false"/>
			</div>
			<!-- Captura de Clasificacion del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura" for="inputClasificacionFicha">Clasificacion:</label>
				<input name="inputClasificacionFicha" class="form-control inputBuscar altaFicha" id="inputClasificacionFicha" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>

		<div class="row areaCaptura">
			<!-- Captura de Lugar del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-map-marker iconoCaptura"></i>
				<label class="labelCaptura" for="selectLugarFicha">Lugar:</label>
				<select name="selectLugarFicha" class="form-control inputBuscar altaFicha" id="selectLugarFicha">
					<option value="mexico">M&eacute;xico</option>
					<option value="usa">Estados Unidos</option>
					<option value="japon">Jap&oacute;n</option>
				</select>
			</div>
			<!-- Captura de Area del Libro -->
			<div class="col-md-5">
				<i class="fa fa-users iconoCaptura"></i>
				<label class="labelCaptura" for="selectAreaFicha">Area:</label>
				<select name="selectAreaFicha" class="form-control inputBuscar altaFicha" id="selectAreaFicha"/>
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
				<input name="inputDescripcionFicha" class="form-control inputBuscar altaFicha" id="inputDescripcionFicha" onpaste="return false"/>
			</div>
			<!-- Captura de Edicion -->
			<div class="col-md-5">
				<i class="fa fa-pencil-square-o iconoCaptura"></i>
				<label class="labelCaptura" for="selectEdicionFicha">Edicion:</label>
				<input type="number" name="selectEdicionFicha" class="form-control inputBuscar altaFicha" id="selectEdicionFicha" 
				min="1" max="32"/>
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
		data.innerText = inputTituloFicha.value+' - ';
		data.innerText += inputAutorFicha.value+' - ';	
		data.innerText += inputISBNFicha.value+' - ';	
		data.innerText += inputClasificacionFicha.value+' - ';	
	});
});
</script>