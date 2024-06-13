<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" />
      <h4 class="bib-titulo">Edici&oacute;n de Ejemplar <?php echo $accesible;?></h4>
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
				<input name="inputAdquisicionEjemplar" class="form-control inputBuscar" 
				value = "<?php echo @$adq; ?>" id="inputAdquisicionEjemplar"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de Tomo del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">Tomo:</label>
				<input name="inputTomoEjemplar" class="form-control inputBuscar" 
				value = "<?php echo @$tomo == 0?'':$tomo; ?>" id="inputTomoEjemplar" onpaste="return false"/>
			</div>
			<!-- Captura de Volumen del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Volumen:</label>
				<input name="inputVolumenEjemplar" class="form-control inputBuscar" 
				value = "<?php echo $volumen == 0?'':$volumen; ?>" id="inputVolumenEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<br/>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<label class="labelCaptura">Se presta</label> <input type="checkbox" name="checkSePrestaEjemplar" 
				<?php echo $accesible == 1?'checked':''; ?> id="checkSePrestaEjemplar" />
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

const link = "<?=site_url("admin/Libros/updateEjemplarQuery")?>";
const btnGuardar = document.querySelector("#btnGuardarCambioEjemplar");
const btnRegresar = document.querySelector('#btnRegresarCambioEjemplar');

$(document).ready(function(){
  
	
	btnGuardar.addEventListener('click',()=>{
		
		const adq = document.querySelector("#inputAdquisicionEjemplar").value;
		const tomo = document.querySelector("#inputTomoEjemplar").value;
		const volumen = document.querySelector("#inputVolumenEjemplar").value;

		$.post(link,{adq:adq,tomo:tomo,volumen:volumen},function(resp){
			$(".mensaje").html("Se ha modificado el Ejemplar: "+resp);
		});
	});

  btnRegresar.addEventListener('click',()=>{
    window.history.back();
  });
});
</script>