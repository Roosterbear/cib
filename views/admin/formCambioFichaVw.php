<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">Edici&oacute;n de Ficha</h4>
    </div>
    <div class="col-md-3"></div>
    <br/>
  </div>   
  <hr/>
</div>
<!-- **************************************** -->
<!-- ****  EDICION DE FICHA PARA CAMBIO  **** -->
<!-- **************************************** -->
<div id="edicionFicha">
	<div class="container-fluid">
    <div class="row areaCaptura">
			<div class="col-md-1"></div>
    
      <!-- Titulo Ficha -->
			<div class="col-md-5">		   	
			  <label class="labelCaptura" for="inputTituloFicha">Titulo: </label>
			  <input name="inputTituloFicha" class="form-control inputBuscar" id="inputTituloFicha" 
        value="<?php echo @$titulo; ?>" onpaste="return false"/>
		  </div>
			
      <!-- Autor Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputAutorFicha">Autor: </label>
			  <input name="inputAutorFicha" class="form-control inputBuscar" id="inputAutorFicha" 
        value="<?php echo @$autor; ?>" onpaste="return false"/>
		  </div>

			<div class="col-md-1"></div>
    </div>

    <div class="row areaCaptura">
      <div class="col-md-1"></div>
			
      <!-- Clasificacion Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputClasificacionFicha">Clasificacion: </label>
			  <input name="inputClasificacionFicha" class="form-control inputBuscar" id="inputClasificacionFicha" 
        value="<?php echo @$clasificacion; ?>" onpaste="return false"/>
		  </div>


      <!-- ISBN Ficha -->
		  <div class="col-md-5">			 
			  <label class="labelCaptura" for="inputISBNFicha">ISBN: </label>
			  <input name="inputISBNFicha" class="form-control inputBuscar" id="inputISBNFicha" 
        value="<?php echo @$isbn; ?>" onpaste="return false"/>
		  </div>

       <div class="col-md-1"></div>
    </div>
    <br/>
		<div class="row areaCaptura">
      
			<div class="col-md-12 text-center">
				<button class="btn butt ok puntero text-right" id="btnGuardarCambioFicha">&nbsp;Guardar&nbsp;</button>
				<button class="btn butt war puntero text-left" id="btnRegresarCambioFicha">&nbsp;Regresar&nbsp;</button>
			</div>
      
		</div>
</div>
<div class="mensajes">
  <div class="mensaje green">
    
  </div>
</div>

<script>

const link = "<?=site_url("admin/Libros/updateFichaQuery")?>";
const btnGuardar = document.querySelector("#btnGuardarCambioFicha");
const btnRegresar = document.querySelector('#btnRegresarCambioFicha');

$(document).ready(function(){
  btnGuardar.addEventListener('click',()=>{
    const titulo = document.querySelector("#inputTituloFicha").value;
    const autor = document.querySelector("#inputAutorFicha").value;
    const clasificacion = document.querySelector("#inputClasificacionFicha").value;
    const isbn = document.querySelector("#inputISBNFicha").value;
    const query = "set titulo = '"+titulo+"', autor = '"+autor+"', clasificacion = '"+clasificacion+"', isbn = '"+isbn+"'";
    const id = <?php echo $id; ?>;
    $.post("<?=site_url("admin/Libros/updateFichaQuery")?>",{id:id,query:query},function(resp){
      $(".mensaje").html("Se ha modificado el ID: "+resp);
      setTimeout(()=>{
        $(".mensaje").html("");
        window.history.back();
      },500);
    });
  });
  
  btnRegresar.addEventListener('click',()=>{
    window.history.back();
  });
});
</script>