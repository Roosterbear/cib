<div class="container-fluid">
	<div class="row areaCaptura">
		<div class="col-md-12 text-center">
			<button class="btn butt ok puntero" id="btnGuardarMostrarFicha">&nbsp;Mostrar Fichas&nbsp;</button>
		</div>
	</div>
	<!-- CONTENIDO -->
	<div id="mostrarListadoFichas"></div>
	<!--  ******** -->
</div>

<script>
const link = "<?=site_url("admin/Libros/getFichas")?>";

$(document).ready(function(){
	const btnGuardarMostrarFicha = document.querySelector("#btnGuardarMostrarFicha");
	btnGuardarMostrarFicha.addEventListener("click", ()=>{
		$.post(link,function(resp){
			$("#mostrarListadoFichas").html(resp);
		});
	});
});
</script>
