<small class="constr">No me veas asi, aun estoy <strong>en construccion</strong> ;'( </small>
<br/>

<!-- ********************** -->
<!-- ** CAPTURA DE FICHA ** -->
<!-- ********************** -->
<div id="capturaFicha">
	<div class="container-fluid">
		<div class="row areaCaptura">
			<!-- Captura de TITULO del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura">Titulo:</label>
				<input name="inputTituloLibro" class="form-control inputBuscar altaLibro" id="inputTituloLibro" onpaste="return false"/>
			</div>
			<!-- Captura de AUTOR del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-user iconoCaptura"></i>
				<label class="labelCaptura">Autor:</label>
				<input name="inputAutorLibro" class="form-control inputBuscar altaLibro" id="inputAutorLibro" onpaste="return false"/>
			</div>
		</div>

		<div class="row areaCaptura">
			<!-- Captura de ISBN del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">ISBN:</label>
				<input name="inputISBN" class="form-control inputBuscar altaLibro" id="inputISBN" onpaste="return false"/>
			</div>
			<!-- Captura de Clasificacion del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Clasificacion:</label>
				<input name="inputClasificacion" class="form-control inputBuscar altaLibro" id="inputClasificacion" onpaste="return false"/>
			</div>
		</div>

		<div class="row areaCaptura">
			<!-- Captura de Lugar del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-map-marker iconoCaptura"></i>
				<label class="labelCaptura">Lugar:</label>
				<input name="inputLugar" class="form-control inputBuscar altaLibro" id="inputLugar" onpaste="return false"/>
			</div>
			<!-- Captura de Area del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-users iconoCaptura"></i>
				<label class="labelCaptura">Area:</label>
				<input name="inputArea" class="form-control inputBuscar altaLibro" id="inputArea" onpaste="return false"/>
			</div>
		</div>

		<div class="row areaCaptura">
			<!-- Captura de Descripcion -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-commenting iconoCaptura"></i>
				<label class="labelCaptura">Descripcion:</label>
				<input name="inputDescripcion" class="form-control inputBuscar altaLibro" id="inputDescripcion" onpaste="return false"/>
			</div>
			<!-- Captura de Edicion -->
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<i class="fa fa-pencil-square-o iconoCaptura"></i>
				<label class="labelCaptura">Edicion:</label>
				<input name="inputEdicion" class="form-control inputBuscar altaLibro" id="inputEdicion" onpaste="return false"/>
			</div>
		</div>

		<br/>	
		<div class="row areaCaptura">
			<!-- Captura de Imagen -->
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<i class="fa fa-commenting iconoCaptura"></i>
				<label class="labelCaptura">Imagen:</label>
				<input name="inputImagen" class="form-control inputBuscar altaLibro" id="inputImagen" onpaste="return false"/>
			</div>
		</div>

		<div class="row areaCaptura">

			<button>Guardar</button>
			<button>Salir</button>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

	const altaLibro = document.querySelectorAll(".altaLibro");
	const constr = document.querySelector(".constr");
	setTimeout(()=>{
		constr.style.color = "#555";
	},3000);

	altaLibro.forEach(function(libro){
		libro.addEventListener('keydown', function(e){
			blockey(e.key,e);
		});	
	});
});
</script>