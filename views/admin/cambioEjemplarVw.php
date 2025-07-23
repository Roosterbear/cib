<!-- ******************************************** -->
<!-- ****  BUSQUEDA DE EJEMPLAR PARA CAMBIO  **** -->
<!-- ******************************************** -->
<div id="busquedaCambioEjemplar">
	<div class="container-fluid">
    <div class="row areaCaptura">
		<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-10">
			<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura">Por ID Ficha:</label>
			  <input name="inputBuscarPorIDCambioEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDCambioEjemplar"/>
		  </div>
			<div class="col-md-1"></div>
	  </div><!-- row  -->    
  </div>

	<div class="row areaCaptura">
		<div class="col-md-12 text-center">
			<button class="btn butt ok puntero" id="btnMostrarFicha">&nbsp;Mostrar&nbsp;</button>
			<button class="btn butt war puntero ocultar" id="btnRegresarCambioEjemplar">&nbsp;Regresar&nbsp;</button>
		</div>		
	</div>

	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="mensajes"></div>			
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

<script>
	$(document).ready(function(){
	
		const link_consulta = "<?=site_url("admin/Libros/showFichaEjemplaresCambiar")?>";
		const btnMostrar = document.querySelector("#btnMostrarFicha");		
		const btnRegresar = document.querySelector("#btnRegresarCambioEjemplar");
		const inputID = document.querySelector("#inputBuscarPorIDCambioEjemplar");			

		$(inputID).on("keydown", function(e){
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

		btnRegresar.addEventListener('click',()=>{
			inputID.disabled = false;					
			inputID.value = '';
			$(".mensajes").html('');
			$('#btnMostrarFicha').removeClass('ocultar');
			$('#btnRegresarCambioEjemplar').addClass('ocultar');						
		});

		function mostrarFicha(){
			value = inputID.value;

			$.post(link_consulta,{value:value},function(resp){
				if(resp != "<div class=\"mensaje tomato\">ID no encontrado</div>"){
					inputID.disabled = true;					
					$('#btnMostrarFicha').addClass('ocultar');
					$('#btnRegresarCambioEjemplar').removeClass('ocultar');
				}

				$(".mensajes").html(resp);			
			});			
		}

	});

</script>

