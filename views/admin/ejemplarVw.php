<div id="busquedaEjemplar">
	<div id="getEjemplarByFicha">
		<div class="container-fluid">		
			<div class="row areaCaptura">
				<div class="col-md-1"></div>
				<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
				<!-- Busqueda por ID Ficha    -->
				<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
				<div class="col-md-10">
					<h3><strong>Etiquetas</strong></h3>
					<i class="fa fa-book iconoBuscar"></i>
					<label class="labelCaptura">Agregar ID Ficha:</label>
					<input name="inputBuscarPorIDFichaMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDFichaMostrarEjemplar"/>
				</div>
				<div class="col-md-1"></div>
			</div><!-- row  -->    
		</div>

		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn butt ok puntero" id="btnMostrarFicha">&nbsp;Mostrar&nbsp;</button>
				<button class="btn butt war puntero ocultar" id="btnRegresarMostrarEjemplar">&nbsp;Regresar&nbsp;</button>
			</div>		
		</div>
	</div> <!-- getEjemplarByFicha -->

	<div class="row etiquetas imprimirEtiquetas text-center">
		<div class="col-md-6">
			Aqui van a ir los resultados de las fichas
		</div>
		<div class="col-md-6">
			aqui va a ir una tabla de las etiquetas
		</div>
	</div>

	<div class="container-fluid">
		<div class="row areaCaptura">
			<div class="col-md-1"></div>
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
      <!-- Busqueda por Texto Ejemplar -->
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
			<div class="col-md-10">
			<i class="fa fa-search iconoBuscar"></i>
			  <label class="labelCaptura">B&uacute;squeda: <small><em>(T&iacute;tulo, Autor, Adquisici&oacute;n)</em></small></label>
			  <input name="inputBuscarPorPalabrasMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorPalabrasMostrarEjemplar"/>
		  </div>
			<div class="col-md-1"></div>
	  </div><!-- row  -->    
  </div>

	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="mensajes">
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

<script>
	$(document).ready(function(){
	
		const link_consulta = "<?=site_url("admin/Libros/showFichaMostrarEjemplares")?>";
		const link_ejemplares = "<?=site_url("admin/Libros/bigSearchOfBooks")?>";
		const btnMostrar = document.querySelector("#btnMostrarFicha");		
		const btnRegresar = document.querySelector("#btnRegresarMostrarEjemplar");
		const inputID = document.querySelector("#inputBuscarPorIDFichaMostrarEjemplar");
		const inputPalabra = document.querySelector("#inputBuscarPorPalabrasMostrarEjemplar");

		$(inputID).on("keydown", function(e){
			let tecla = e.key;
			justDigits(tecla,e);
		});
				
		$(inputID).on("keyup", function(e){						
			if(e.keyCode === 13){
				mostrarFicha();
			}			
		});


		$(inputPalabra).on("keyup", function(e){						
			mostrarEjemplares();
		});

		
		btnMostrarFicha.addEventListener('click', ()=>{
				mostrarFicha();			
		});	

		btnRegresar.addEventListener('click',()=>{
			inputID.disabled = false;					
			inputID.value = '';
			$(".mensajes").html('');
			$('#btnMostrarFicha').removeClass('ocultar');
			$('#btnRegresarMostrarEjemplar').addClass('ocultar');
		});

		function mostrarFicha(){
			value = inputID.value;

			$.post(link_consulta,{value:value},function(resp){
				if(resp != "<div class=\"mensaje tomato\">ID no encontrado</div>"){
					inputID.disabled = true;					
					$('#btnMostrarFicha').addClass('ocultar');
					$('#btnRegresarMostrarEjemplar').removeClass('ocultar');
				}

				$(".mensajes").html(resp);			
			});			
		}

		function mostrarEjemplares(){
			texto = inputPalabra.value;
			$.post(link_ejemplares,{texto:texto},function(resp){
				$(".mensajes").html(resp);
			});
		}

	});
	
</script>







