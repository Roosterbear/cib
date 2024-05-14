<div class="container-fluid">
	<div class="row areaCaptura">
		<div class="col-md-12 text-center">
			<button class="btn butt ok puntero" id="btnGuardarMostrarEjemplar">&nbsp;Mostrar Ejemplares&nbsp;</button>
		</div>
	</div>
	<!-- CONTENIDO -->
	<div id="mostrarListadoEjemplares"></div>
	<!--  ******** -->
</div>

<script>
const link = "<?=site_url("admin/Libros/getEjemplares")?>";

$(document).ready(function(){
	const btnGuardarMostrarEjemplar = document.querySelector("#btnGuardarMostrarEjemplar");
	btnGuardarMostrarEjemplar.addEventListener("click", ()=>{
		$.post(link,function(resp){
			$("#mostrarListadoEjemplares").html(resp);
		});
	});
});
</script>


