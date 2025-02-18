<div id="busquedaEjemplar">

	<div id="getEjemplarByFicha">
		
			<div class="row areaCaptura">
				<div class="col-md-1"></div>
				<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
				<!-- Busqueda por ID Ficha    -->
				<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
				<div class="col-md-10">
					<i class="fa fa-book iconoBuscar"></i>
					<label class="labelCaptura">Agregar <strong>Etiqueta</strong> por ID Ficha:</label>
					<input name="inputBuscarPorIDFichaMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDFichaMostrarEjemplar"/>
				</div>
				<div class="col-md-1"></div>
			</div><!-- row  -->    
		
	</div> <!-- getEjemplarByFicha -->

	<!-- BUSQUEDA AVANZADA -->	
	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
		<!-- Busqueda por Texto Ejemplar -->
		<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
		<div class="col-md-10">
		<i class="fa fa-search iconoBuscar"></i>
			<label class="labelCaptura"><strong>B&uacute;squeda avanzada:</strong> <small><em>(T&iacute;tulo, Autor, Adquisici&oacute;n)</em></small></label>
			<input name="inputBuscarPorPalabrasMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorPalabrasMostrarEjemplar"/>
		</div>
		<div class="col-md-1"></div>
	</div><!-- row  -->   

	<!-- ETIQUETADO -->
	<div class="row etiquetas imprimirEtiquetas text-center">
		<div class="col-md-9 etiquetar">
			<!-- Aqui van a ir los resultados de las fichas -->
		</div>
		<div class="col-md-3">
			<!-- Aqui va a ir una tabla de las etiquetas -->
			<div class="cuadricula text-right">
				<div><small>AREA DE IMPRESION</small></div>
				<div class="filaCuadricula">
					<div id="box-01"></div>
					<div id="box-02"></div>
					<div id="box-03"></div>
					<div id="box-04"></div>
					<div id="box-05"></div>
					<div id="box-06"></div>
					<div id="box-07"></div>
				</div>
				<div class="filaCuadricula">
					<div id="box-08"></div>
					<div id="box-09"></div>
					<div id="box-10"></div>
					<div id="box-11"></div>
					<div id="box-12"></div>
					<div id="box-13"></div>
					<div id="box-14"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- RESULTADOS BUSQUEDA AVANZADA -->
	<div class="container-fluid">
		<div class="row areaCaptura">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="mensajes">
			</div>
			<div class="col-md-1"></div>
		</div>
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

		/* Para ID Ficha */
		$(inputID).on("keydown", function(e){
			let tecla = e.key;
			justDigits(tecla,e);
		});
				
		$(inputID).on("keyup", function(e){						
			if(e.keyCode === 13){
				mostrarFicha();
			}			
		});
		/* ---------------- */

		$(inputPalabra).on("keyup", function(e){		
			const texto = (inputPalabra.value).length;				
			$(".mensajes").html('');
			if(texto>1)	mostrarEjemplares();	
		});

		
		btnMostrarFicha.addEventListener('click', ()=>{
			mostrarFicha();			
		});	

		
		function mostrarFicha(){
			value = inputID.value;

			$.post(link_consulta,{value:value},function(resp){
				$(".etiquetar").html(resp);			
			});			
		}

		function mostrarEjemplares(){
			const texto = (inputPalabra.value).trim();
			
			$.post(link_ejemplares,{texto:texto},function(resp){
				$(".mensajes").html(resp);
			});
			
		}

	});
	
</script>







