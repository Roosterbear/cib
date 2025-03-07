<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<!-- @@@@@@@@@@@@@@@@@@@@@@@@ +++ PREVIEW +++ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<div id="preview" class="ocultar">
	<h1>Demonios!, que hice...</h1>
	<button id="btn-preview-regresar">Regresame por favor</button>
</div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<div id="busquedaEjemplar"><!-- DIV DE TODA LA SECCION DE EJEMPLAR -->
	
	<div id="getEjemplarByFicha">
		<div class="row areaCaptura">
			
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
			<!-- Busqueda por ID Ficha    -->
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@ -->
			<div class="col-md-4">
				<i class="fa fa-book iconoBuscar"></i>
				<label class="labelCaptura"><strong>Etiqueta</strong> por ID Ficha:</label>
				<input name="inputBuscarPorIDFichaMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDFichaMostrarEjemplar"/>
			</div>
			
			<div id="cuadricula" class="col-md-8">
				<div class="text-center">
					<div><strong class="dark-rhino">AREA ETIQUETAS</strong></div>
					<div class="filaCuadricula">
						<div id="s01"></div>
						<div id="s02"></div>
						<div id="s03"></div>
						<div id="s04"></div>
						<div id="s05"></div>
						<div id="s06"></div>
						<div id="s07"></div>
						<div id="s08"></div>
					</div>
					<div class="filaCuadricula">
						<div id="s09"></div>
						<div id="s10"></div>
						<div id="s11"></div>
						<div id="s12"></div>
						<div id="s13"></div>
						<div id="s14"></div>
						<div id="s15"></div>
						<div id="s16"></div>
					</div>
				</div>
			</div>
		</div><!-- row  -->    
	</div> <!-- getEjemplarByFicha -->

	
	<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
	<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
	<div id="btn-preview-area"><button id="btn-preview" class="btn butt war puntero">Previsualizar</button></div>
	<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


	<!-- AREA DE ETIQUETADO -->
	<div id="areaEtiquetado" class="row imprimirEtiquetas text-center">
		<div id="addEjemplarEtiquetas" class="col-md-12 mostrarResultadosById">
			<!-- Aqui van a ir los resultados de las fichas -->
		</div>
	</div>

	<hr class="line-space"/>

	<!-- BUSQUEDA AVANZADA -->	
	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<!-- Busqueda por Texto Ejemplar -->
		<div class="col-md-10">
		<i class="fa fa-search iconoBuscar"></i>
			<label class="labelCaptura"><strong>B&uacute;squeda avanzada:</strong> <small><em>(T&iacute;tulo, Autor, Adquisici&oacute;n)</em></small></label>
			<input name="inputBuscarPorPalabrasMostrarEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorPalabrasMostrarEjemplar"/>
		</div>
		<div class="col-md-1"></div>
	</div><!-- row  -->   

	<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
	<!-- RESULTADOS BUSQUEDA AVANZADA -->
	<!-- ++++++++++++++++++++++++++++ -->
	<div class="row areaCaptura">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="mensajes">
		</div>
		<div class="col-md-1"></div>
	</div>
	<!-- +++ RESULTADOS BUSQUEDA AVANZADA +++ -->
	
</div><!-- DIV BusquedaEjemplar -->
<script>
	$(document).ready(function(){
		let contador = 0;
		const $ejemplares = ['','','','','','','','','','','','','','','',''];	// 16 elementos
		const $ADQs = ['','','','','','','','','','','','','','','',''];	// 16 elementos
		const $seats = ['s01','s02','s03','s04','s05','s06','s07','s08'
									,'s09','s10','s11','s12','s13','s14','s15','s16'];	


		const $all_ejemplares = document.querySelector("#busquedaEjemplar");
		const $preview = document.querySelector("#preview");

		const addTable = document.querySelector("#add-table");

		/* -----------++ BUSCADOR POR FICHA ++---------------- */	
		const link_consulta = "<?=site_url("admin/Libros/showFichaMostrarEjemplares")?>";

		/* ---------++ BUSCADOR POR TEXTO ++------------------ */	
		const link_ejemplares = "<?=site_url("admin/Libros/bigSearchOfBooks")?>";		

		/* ---------++ IMPRIMIR ETIQUETAS DE EJEMPLARES ++------------------ */	
		const link_etiquetas_ejemplares = "<?=site_url("admin/Libros/imprimirEtiquetasEjemplares")?>";		

		
		/* ---++ ELEMENTOS DE BUSQUEDA EN IMPRESION DE ETIQUETAS DE EJEMPLARES ++--- */	
		//const btnRegresar = document.querySelector("#btnRegresarMostrarEjemplar");
		const btnPreview = document.querySelector("#btn-preview");
		const btnPreviewRegresar = document.querySelector("#btn-preview-regresar"); // PERTENECE AL PREVIEW OCULTO
		const inputID = document.querySelector("#inputBuscarPorIDFichaMostrarEjemplar");
		inputID.value = '';
		const inputPalabra = document.querySelector("#inputBuscarPorPalabrasMostrarEjemplar");

		/* ---------++ CUADRICULA DE ETIQUETAS ++------------------ */	
		const cuadricula = document.querySelector("#cuadricula");
		
		/* ---------++ AREA DE EJEMPLARES A AGREGAR ++------------------ */	
		const addEjemplarEtiquetas = document.querySelector("#addEjemplarEtiquetas");

		/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
		/* ++++++++++++++ AGREGAR EJEMPLARES PARA ETIQUETAS (+) ++++++++++++++++++++ */
		/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
		addEjemplarEtiquetas.addEventListener('click', function(e){
			/* Detecta el ejemplar a agregar que se le dio click */	
			let add = e.target.closest('.add-sign');

			// Verificar que no se haya dado click en elemento vacio!
			if (add != null){
				// AGREGAR A CUADRICULA
				agregarADQ(add.dataset.ejemplar);



			}
		});
		/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

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

		function mostrarFicha(){
			value = inputID.value;

			$.post(link_consulta,{value:value},function(resp){
				$(".mostrarResultadosById").html(resp);			
			});			
		}

		function mostrarEjemplares(){
			const texto = (inputPalabra.value).trim();
			
			$.post(link_ejemplares,{texto:texto},function(resp){
				$(".mensajes").html(resp);
			});
			
		}

		function agregarADQ($ejemplar){
			$ejemplares[contador] = $ejemplar;			
			document.querySelector("#"+$seats[contador]).innerHTML = $ejemplar;
			console.log($ejemplares);
			if(contador<15){
				contador++;
			}else{
				contador = 0;
			}
		}


		btnPreview.addEventListener('click', function(){
			$all_ejemplares.classList.add("ocultar");
			$preview.classList.remove("ocultar");
		});

		btnPreviewRegresar.addEventListener('click', function(){
			$all_ejemplares.classList.remove("ocultar");
			$preview.classList.add("ocultar");
		});

	});
</script>







