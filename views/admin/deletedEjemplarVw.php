<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" />
      <h4 class="bib-titulo">Eliminar Ejemplar</h4>
    </div>
    <div class="col-md-3"></div>
    <br/>
  </div>   
  <hr/>
</div>
<!-- ************************************ -->
<!-- ****  ELIMINACION DE EJEMPLAR   **** -->
<!-- ************************************ -->

<h2 class="gray text-center">Seguro que desea eliminar el ejemplar <?php echo $ide; ?> ?</h2>
<div class="row areaCaptura">
		<div class="col-md-12 text-center">
			<button class="btn butt cancel puntero" id="btnBajaEjemplar">&nbsp;Eliminar Ejemplar?&nbsp;</button>
			<br/><br/>
			<button class="btn butt war puntero"  id="btnRegresarBajaEjemplar">&nbsp;Regresar&nbsp;</button>
		</div>
		
		<div class="col-md-12 mensajes text-center">
			<div id="data"></div>
		</div>

	</div>
</div>

<script>

$(document).ready(function(){
	const link_borrar = "<?=site_url("admin/Libros/borrarEjemplar")?>";
	const value = <?php echo $ide; ?>;	
	const btnBaja = document.querySelector("#btnBajaEjemplar");
	const btnRegresar = document.querySelector("#btnRegresarBajaEjemplar");

	btnBaja.addEventListener('click', ()=>{
		deletation();
	});

	function deletation(){
		$.post(link_borrar,{value:value},function(resp){
			$("#data").html(resp);
		});	
		btnBaja.style = ("display:none");
		$('#btnRegresarBajaEjemplar').removeClass('ocultar');
	}

	btnRegresar.addEventListener('click',()=>{
		window.location.href = "<?=site_url('admin/Libros/bajaEjemplar')?>"; 
	});

});

</script>