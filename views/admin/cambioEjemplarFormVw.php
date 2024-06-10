<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" />
      <h4 class="bib-titulo">Edici&oacute;n de Ejemplar <?php echo $ide;?></h4>
    </div>
    <div class="col-md-3"></div>
    <br/>
  </div>   
  <hr/>
</div>
<!-- ******************************************* -->
<!-- ****  EDICION DE EJEMPLAR PARA CAMBIO  **** -->
<!-- ******************************************* -->
<div id="edicionEjemplar">
	<div class="container-fluid">
    <div class="row areaCaptura">
      <!-- Captura de No de Adquisicion -->
      <div class="col-md-1"></div>
			<div class="col-md-10">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura">No. de Adquisicion:</label>
				<input name="inputAdquisicionEjemplar" class="form-control inputBuscar" id="inputAdquisicionEjemplar"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de Tomo del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">Tomo:</label>
				<input name="inputTomoEjemplar" class="form-control inputBuscar" id="inputTomoEjemplar" onpaste="return false"/>
			</div>
			<!-- Captura de Volumen del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Volumen:</label>
				<input name="inputVolumenEjemplar" class="form-control inputBuscar" id="inputVolumenEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<br/>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<label class="labelCaptura">Se presta</label> <input type="checkbox" name="checkSePrestaEjemplar" id="checkSePrestaEjemplar" />
			</div>
		</div>

    <br/>
		<div class="row areaCaptura">
      
			<div class="col-md-12 text-center">
				<button class="btn butt ok puntero text-right" id="btnGuardarCambioEjemplar">&nbsp;Guardar&nbsp;</button>
				<button class="btn butt war puntero text-left" id="btnRegresarCambioEjemplar">&nbsp;Regresar&nbsp;</button>
			</div>
      
		</div>
</div>
<div class="mensajes">
  <div class="mensaje green">
    
  </div>
</div>

<script>

const link = "<?=site_url("admin/Libros/updateFichaQuery")?>";
const btnGuardar = document.querySelector("#btnGuardarCambioEjemplar");
const btnRegresar = document.querySelector('#btnRegresarCambioEjemplar');

$(document).ready(function(){
  
  btnRegresar.addEventListener('click',()=>{
    window.history.back();
  });
});
</script>