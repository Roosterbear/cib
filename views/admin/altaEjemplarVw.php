<!-- ******************************************** -->
<!-- **  BUSQUEDA DE FICHA PARA ALTA EJEMPLAR  ** -->
<!-- ******************************************** -->
<div id="busquedaFichaAltaEjemplar">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
      <!-- Busqueda de Ficha por ID -->
			<div class="col-md-10">
				<i class="fa fa-search iconoBuscar"></i>
			  <i class="fa fa-book iconoBuscar"></i>
			  <label class="labelCaptura">Por ID Ficha:</label>
			  <input name="inputBuscarPorIDAltaEjemplar" class="form-control inputBuscarPorID" id="inputBuscarPorIDAltaEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>

		<!-- +++++++++++++++++++++++++++++++++++++++++ -->
		<!-- BOTON PARA MOSTRAR EJEMPLARES DE LA FICHA -->
		<!-- +++++++++++++++++++++++++++++++++++++++++ -->
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn butt ok puntero" id="btnMostrarFicha">&nbsp;Mostrar&nbsp;</button>
			</div>		
		</div>


		<div class="row areaCaptura">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="mensajes">
					<div id="data"></div>
				</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<div class="mensajes">
		<div class="mensaje"></div>
	</div>
<!-- ************************* -->
<!-- ** CAPTURA DE EJEMPLAR ** -->
<!-- ************************* -->
<div id="altaEjemplar" class="ocultar">
	<div class="container-fluid">
		<div class="row areaCaptura">
			<!-- Captura de No de Adquisicion -->
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<i class="fa fa-address-book iconoCaptura"></i>
				<label class="labelCaptura">No. de Adquisicion: <span class="tomato">*</span></label>
				<input name="inputAdquisicionEjemplar" class="form-control inputBuscar" id="inputAdquisicionEjemplar"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<div class="row areaCaptura">
			<!-- Captura de Tomo del Libro -->
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<i class="fa fa-archive iconoCaptura"></i>
				<label class="labelCaptura">Tomo:</label>
				<input name="inputTomoEjemplar" class="form-control inputBuscar" id="inputTomoEjemplar" onpaste="return false"/>
			</div>
			<!-- Captura de Volumen del Libro -->
			<div class="col-md-5">
				<i class="fa fa-tag iconoCaptura"></i>
				<label class="labelCaptura">Volumen:</label>
				<input name="inputVolumenEjemplar" class="form-control inputBuscar" id="inputVolumenEjemplar" onpaste="return false"/>
			</div>
			<div class="col-md-1"></div>
		</div>
		
		<br/>
		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<label class="labelCaptura">Se presta</label> <input type="checkbox" name="checkSePrestaEjemplar" id="checkSePrestaEjemplar" />
			</div>
		</div>

		<div class="row areaCaptura">
			<div class="col-md-12 text-center">
				<button class="btn butt ok puntero text-right" id="btnGuardarAltaEjemplar">&nbsp;Guardar&nbsp;</button>
				<button class="btn butt war puntero text-left" id="btnRegresarAltaEjemplar">&nbsp;Regresar&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<div class="espaciado"></div>
<script>
	$(document).ready(function(){

		const link_consulta = "<?=site_url("admin/Libros/showFichaEjemplares")?>";
		const link_alta = "<?=site_url("admin/Libros/addEjemplar")?>";
		const inputIDFicha = document.querySelector("#inputBuscarPorIDAltaEjemplar");
		const btnMostrarFicha = document.querySelector("#btnMostrarFicha");
		const btnGuardar = document.querySelector("#btnGuardarAltaEjemplar");		
		const btnRegresar = document.querySelector('#btnRegresarAltaEjemplar');
		
		const inputADQ = document.querySelector("#inputAdquisicionEjemplar");
		const inputTomo = document.querySelector("#inputTomoEjemplar");
		const inputVolumen = document.querySelector("#inputVolumenEjemplar");
		const checkSePresta = document.querySelector("#checkSePrestaEjemplar");
		
		let value = '';

		$(inputIDFicha).on("keydown", function(e){
			let tecla = e.key;
			justDigits(tecla,e);
		});
				
		$(inputIDFicha).on("keyup", function(e){						
			if(e.keyCode === 13){
				mostrarFicha();
			}			
		});

		btnMostrarFicha.addEventListener('click', ()=>{
				mostrarFicha();			
		});

		function mostrarFicha(){
			value = inputIDFicha.value;

			// Libros -> addEjemplar
			$.post(link_consulta,{value:value},function(resp){
				if(resp != "<div class=\"mensaje alert\">ID no encontrado</div>"){
					inputIDFicha.disabled = true;
					$('#altaEjemplar').removeClass('ocultar');
					$('#btnMostrarFicha').addClass('ocultar');
				}

				$("#data").html(resp);			
			});			
		}

		inputADQ.addEventListener('input', function(){
			var inputValue = this.value;
			var upperCaseValue = inputValue.toUpperCase();
			this.value = upperCaseValue;
		});

		btnGuardar.addEventListener('click', ()=>{
			
			const idFicha = inputIDFicha.value;
			const adq = inputADQ.value;
			const tomo = inputTomo.value;
			const volumen = inputVolumen.value;
			const accesible = checkSePresta.checked?1:0;

			const adq0k = validarMayorATres(adq);

			if(adq0k){
				$.post(link_alta,{idFicha:idFicha,
												adq:adq,
												tomo:tomo,
												volumen:volumen,
												accesible:accesible
											},function(resp){
											// AQUI PONER ERROR SI ES ADQ REPETIDO
											if(resp == 0){
												$('.mensaje').addClass('tomato').html("Numero de ADQUISICION repetido !");
												setTimeout(()=>{
													$('.mensaje').removeClass('tomato').html("");
												},2000);
											}else{
												$('.mensaje').addClass('green').html("Ejemplar generado con el ID: "+resp);
												setTimeout(()=>{
													$('.mensaje').removeClass('green').html("");
													resetDataAltaEjemplar();			
													inputIDFicha.disabled = false;
													inputIDFicha.value = '';
													$('#altaEjemplar').addClass('ocultar');
													$('#btnMostrarFicha').removeClass('ocultar');
												},2000);	
												$("#data").html('');
											}
				});
			}else{
				$('.mensaje').addClass('alert').html("Faltan campos por llenar");
				setTimeout(()=>{
					$('.mensaje').removeClass('alert').html("");
				},2000);
			}			
		});

		btnRegresar.addEventListener('click',()=>{
			inputIDFicha.disabled = false;
			$('#altaEjemplar').addClass('ocultar');
			$('#btnMostrarFicha').removeClass('ocultar');
			$("#data").html('');
			inputIDFicha.value = '';
		});

	});

function resetDataAltaEjemplar(){
	var a = document.querySelector("#inputAdquisicionEjemplar");
	var t = document.querySelector("#inputTomoEjemplar");
	var v = document.querySelector("#inputVolumenEjemplar");
	//var p = document.querySelector("#checkSePrestaEjemplar");
	a.value = '';
	t.value = '';
	v.value = '';
	//p.value = '';	
}
</script>