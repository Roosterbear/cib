<?php /* @var $perfil Perfil */
$bm= new BibliotecaMenus();
$bm->setRequerdio(true);
$bm->setVacio(true);
$bm->setBlank1stItem(true);
$bm->setClass("form-control");

?>
<div class="card">
<div class="card-header">
<h6>Activos Prestamo</h6>
<form action="<?=site_url("admin/ServicioPrestamos/agregar")?>" id="sevicio_prestamo_agregar">
	<input type="hidden" name="idSolicitante" value="<?=$idSolicitante?>" />
	<input type="hidden" name="tipo" value="<?=$tipo?>" />
	<div class="row">

		<div class="col-md-3">
			<label>Servicios</label>
			<?php echo $bm->Servicios()?>
		</div>
		<div class="col-md-3">
			<label>Activos</label>
			<?php echo $bm->ServicioActivosSinPrestamo(0);?>
		</div>
		
		<div class="col-md-3">
	     <br> 	    
		  <button  type="submit" class="btn btn-block btn-primary btn-md"data-agregar>
		  <i class="fa fa-plus" aria-hidden="true"> Agregar Prestamo</i>
		  </button>
	   </div>
	   
	   		<div class="col-md-3">
		  		 <br> 	 
		        <button type="button" class="btn btn btn-secondary btn-sm " data-toggle="modal" data-target="#e_modal_lg" data-direccion="admin/ServicioPrestamos/vwHistorial/<?=$idSolicitante?>" data-objetivo="#e_modal_lg_content">
			          Historial <i class="fa fa-history" aria-hidden="true"></i>
			    </button>
		</div>
	</div>
	
</form>
</div>
<div class="card-body">
	
	<table class="table table-striped table-bordered">
	  <thead class="thead-inverse">
	     <tr>
			<th>Tipo</th>
			<th>Activo</th>
			<th>Salida</th>
			<th>Acción</th>		
		 </tr>
	 </thead>
		
	<tbody>
	 <?php if(@count($prestamos)>0) foreach ($prestamos as $p){ /* @var $p Prestamo */?>
	  <tr>
		<td><?php echo $p->getServicio();?></td>
		<td><?php echo $p->getActivo();?></td>
		<td><?php echo $p->getFechaSalida();?></td>
		<td><button class="btn btn-primary"  data-direccion="admin/ServicioPrestamos/Devolver/<?=$p->getId()?>/<?=$idSolicitante?>/<?=$tipo?>">Devolver</button></td>
	  </tr>
	<?php } ?>
   </tbody>
	
   </table>

</div>
</div>
<script type="text/javascript">
$("select[name=idServicio]").change(function(){
	$.post("<?=site_url("admin/ServicioPrestamos/menu/prestamo")?> ",$("#sevicio_prestamo_agregar").serialize(), function(resp){
		$("select[name=idServicioActivo]").replaceWith( resp );
	});
});
</script>