<div id="busquedaEjemplar"><!-- DIV DE TODA LA PAGINA -->
	
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

	<!-- AREA DE ETIQUETADO -->
	<div id="areaEtiquetado" class="row imprimirEtiquetas text-center">
		<div class="col-md-8 margin-bottom">
			<small id="mensajeOjito">El contenido de etiquetas esta oculto</small>
		</div>
		<div class="col-md-4 text-right margin-bottom">
			<span class="tab-ocultar"><i class="fa fa-eye-slash ojito" aria-hidden="true"></i></span></div>
		<div id="addEjemplarEtiquetas" class="col-md-9 mostrarResultadosById">
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
			<!-- Aqui van a ir los resultados de las fichas -->
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
		</div>

		<div id="cuadricula" class="col-md-3">
			
			<div class="text-right">
				
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
				<div class="ceiling"><button class="btn butt ok puntero">&nbsp;Imprimir&nbsp;</button></div>
			</div>
		</div>
	</div>

	<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
	<!-- RESULTADOS BUSQUEDA AVANZADA -->
	<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
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
		const $ADQs = ['','','','','','','','','','','','','','','',''];		

		const addTable = document.querySelector("#add-table");

		/* -----------++ BUSCADOR POR FICHA ++---------------- */	
		const link_consulta = "<?=site_url("admin/Libros/showFichaMostrarEjemplares")?>";

		/* ---------++ BUSCADOR POR TEXTO ++------------------ */	
		const link_ejemplares = "<?=site_url("admin/Libros/bigSearchOfBooks")?>";		

		const btnRegresar = document.querySelector("#btnRegresarMostrarEjemplar");
		const inputID = document.querySelector("#inputBuscarPorIDFichaMostrarEjemplar");
		const inputPalabra = document.querySelector("#inputBuscarPorPalabrasMostrarEjemplar");

		/* ---------++ CUADRICULA DE ETIQUETAS ++------------------ */	
		const cuadricula = document.querySelector("#cuadricula");
		
		/* ---------++ AREA DE EJEMPLARES A AGREGAR ++------------------ */	
		const addEjemplarEtiquetas = document.querySelector("#addEjemplarEtiquetas");

		/* --------++ OCULTAR / MOSTRAR AREA EJEMPLARES A ETIQUETAR ++----------- */	
		const tabOcultar = document.querySelector(".tab-ocultar");
		const ojito = document.querySelector(".ojito");
		const mensajeOjito = document.querySelector("#mensajeOjito");
		let oculto = false; /* POR DEFAULT NO ESTA OCULTO */

		/* --------++ DETECTA EL EJEMPLAR A AGREGAR !! ++----------- */	
		addEjemplarEtiquetas.addEventListener('click', function(e){
			let add = e.target.closest('.add-sign')
			alert(add.dataset.adq);
		});

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

		function agregarADQ($adq){
			$ADQs[contador] = $adq;
			console.log($ADQs);
		}

		tabOcultar.addEventListener('click', ()=>{
			if(oculto){				
				oculto = !oculto;
				cuadricula.style.display = 'block';
				addEjemplarEtiquetas.style.display = 'block';
				ojito.classList.add('fa-eye-slash');
				ojito.classList.remove('fa-eye');
				mensajeOjito.style.display = 'none';
			}else{				
				oculto = !oculto;
				cuadricula.style.display = 'none';
				addEjemplarEtiquetas.style.display = 'none';
				ojito.classList.remove('fa-eye-slash');
				ojito.classList.add('fa-eye');
				mensajeOjito.style.display = 'inline';
			}
		});
	});
</script>







