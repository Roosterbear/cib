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
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
	const link_borrar = "<?=site_url("admin/Libros/deleteEjemplar")?>";
	const value = <?php echo $ide; ?>;	
	const btnBaja = document.querySelector("#btnBajaEjemplar");
	

	btnBaja.addEventListener('click', ()=>{
    /*
		$.post(link_borrar,{value:value},function(resp){
			$("#data").html(resp);
		});	
		btnBaja.style = ("display:none");
    */
		alert(value);
	});

	function mostrarFicha(){		
			value = $("#inputBuscarPorIDBajaFicha").val();
			value = quitarGuiones(value);
			$.post(link_consulta,{value:value},function(resp){
				if(resp != "<div class=\"mensaje tomato\">ID no encontrado</div>"){
					btnBajaFicha.style = ("display:block");
				}

				$("#data").html(resp);			
			});				
	}

});



</script>