<?php 
$bm= new BibliotecaMenus();
$bm->setRequerdio(true);
$bm->setVacio(true);
$bm->setBlank1stItem(true);
$bm->setClass("form-control");
?><div class="card">
<div class="card-header">
<h6>Activos Prestamo</h6>
</div>
<div class="card-body">
<form action="<?php echo site_url("admin/ServicioPrestamos/DevolverActivo")?>" id="servicio_prestamo_devolverActivo">
<input type="hidden" name="id" value="<?php echo $prestamos->getIdUsuario()?>"/>
 
<br>

<div class="row">
<div class="col-md-6">
<label>Servicios</label>
			<?php echo $bm->Servicios(null,"idServicioDevuelto")?>
		</div>
		<div class="col-md-6">
			<label>Activos</label>
			<?php echo $bm->ServicioActivosEnPrestamo(0,null,"idServicioActivoDevuelto");?>
			
		<br>	
		</div>
	    <?php  ?>
	 
	  <div class="col-md-6">
	  <button class="btn btn-success btn-sm col-md-5"><i class="fa fa-save " aria-hidden="true" > </i> Devolver</button>
	  </div>
	  <br>
	  <div class="col-md-6">
	  <button class="btn btn-danger btn-sm col-md-5" type="button"class="close panelTitleTxt glyphicon glyphicon-remove landing-icon" data-dismiss="modal" aria-hidden="true"><i class="fa fa-ban" aria-hidden="true" ></i> Cerrar</button>
	  </div>
	</div>
</form>
</div></div>
<script type="text/javascript">
$("select[name=idServicioDevuelto]").change(function(){
	$.post("<?=site_url("admin/ServicioPrestamos/menu/devolver")?> ",{idServicio:$("select[name=idServicioDevuelto").val()}, function(resp){
		$("select[name=idServicioActivoDevuelto]").replaceWith( resp );
	});
});
</script>