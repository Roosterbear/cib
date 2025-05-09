<!-- ***************************************** -->
<!-- **  BUSQUEDA DE FICHA PARA DAR DE BAJA ** -->
<!-- ***************************************** -->
<div id="busquedaBajaFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-10">
		   	<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura" for="inputBuscarPorIDBajaFicha">Por ID Ficha:</label>
			  <input name="inputBuscarPorIDBajaFicha" class="form-control inputBuscar" id="inputBuscarPorIDBajaFicha" onpaste="return false"/>
		  </div>
			<div class="col-md-1"></div>
		</div><!-- row -->

			<div class="row areaCaptura">
				<div class="col-md-12 text-center">
					<button class="btn butt ok puntero" id="btnMostrarFichaBajaFicha">&nbsp;Mostrar Ficha&nbsp;</button>
					<button class="btn butt war puntero" id="btnRegresarBajaFicha">&nbsp;Regresar&nbsp;</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="mensajes">
			<div id="data"></div>
			</div>
		<div class="col-md-1"></div>
		<br/>
		<div class="col-md-12 text-center">
			<button class="btn butt cancel puntero" id="btnBajaFicha">&nbsp;Eliminar Ficha?&nbsp;</button>
		</div>
	</div>
</div>
<script>

	
$(document).ready(function(){
	const link_consulta = "<?=site_url("admin/Libros/showFicha")?>";
	const link_borrar = "<?=site_url("admin/Libros/deleteFicha")?>";
	
	const inputID = document.querySelector("#inputBuscarPorIDBajaFicha");
	
	const data = document.querySelector("#data");
	const mensaje = document.querySelector("#mensaje");
	
	const btnBajaFicha = document.querySelector("#btnBajaFicha");
	const btnMostrarFicha = document.querySelector("#btnMostrarFichaBajaFicha");
	const btnRegresar = document.querySelector("#btnRegresarBajaFicha");

	let value = '';
	
	$(inputBuscarPorIDBajaFicha).on("keydown", function(e){			
		let tecla = e.key;
		justDigits(tecla,e);
	});
	
	$(inputID).on("keyup", function(e){			
		if(e.keyCode === 13){			
			mostrarFicha();	
		}	
	});

	btnMostrarFicha.addEventListener('click', ()=>{
		mostrarFicha();
	});

	btnBajaFicha.addEventListener('click', ()=>{
		$.post(link_borrar,{value:value},function(resp){
			$("#data").html(resp);
		});	
		btnBajaFicha.style = ("display:none");
		inputID.value = '';
	});

	function mostrarFicha(){		
			value = $("#inputBuscarPorIDBajaFicha").val();
			value = quitarGuiones(value);
			btnRegresar.style = ("display:block");
			btnMostrarFicha.style = ("display:none");			

			$.post(link_consulta,{value:value},function(resp){
				if(resp != "<div class=\"mensaje alert\">ID no encontrado</div>"){
					inputID.disabled = true;
					btnBajaFicha.style = ("display:block");
				}
				$("#data").html(resp);	
			});	
	}

	btnRegresar.addEventListener('click', ()=>{
		inputID.disabled = false;
		btnBajaFicha.style = ("display:none");
		$("#data").html('');	
		btnMostrarFicha.style = ("display:block");			
		btnRegresar.style = ("display:none");
	});
});



</script>