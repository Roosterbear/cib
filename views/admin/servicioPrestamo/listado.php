<?php /* @var $perfil Perfil */
$bm= new BibliotecaMenus();
$bm->setRequerdio(true);
$bm->setVacio(true);
$bm->setBlank1stItem(true);
$bm->setClass("form-control");

?>
<div class="card">
<div class="card-header">
	<div class="row">
		<div class="col-md-12">
		  <h6>Activos Prestamo</h6>
		        <button class="btn btn btn-secondary btn-sm " data-toggle="modal" data-target="#e_modal_lg" data-direccion="admin/ServicioPrestamos/vwHistorial/<?=$idSolicitante?>" data-objetivo="#e_modal_lg_content">
			          Historial <i class="fa fa-history" aria-hidden="true"></i>
			    </button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<label>Servicios</label>
			<?php echo $bm->Servicios()?>
		</div>
		<div class="col-md-3">
			<label>Activos</label>
			<?php echo $bm->ServicioActivosSinPrestamo(12);?>
		</div>
		
		<div>
	     <br> 	    
		  <button  type="button" class="btn btn-block btn-primary btn-lg"data-agregar>
		  <i class="fa fa-plus-square-o" aria-hidden="true"> Agregar Prestamo</i>
		  </button>
	   </div>
	</div>
</div>
<div class="card-body">
	<table class="table table-striped table-bordered">
	  <thead class="thead-inverse">
	     <tr>
			<th>Tipo</th>
			<th>Activo</th>
			<th>Salida</th>
			<th>Acci�n</th>		
		 </tr>
	 </thead>
		
	<tbody>
	 <?php if(@count($prestamos)>0) foreach ($prestamos as $p){ /* @var $p Prestamo */?>
	  <tr>
		<td><?php echo $p->getServicio();?></td>
		<td><?php echo $p->getActivo();?></td>
		<td><?php echo $p->getFechaSalida();?></td>
		<td><?php echo $p->getEstado();?></td>
	  </tr>
	<?php } ?>
   </tbody>
	
   </table>

</div>
</div>
<script type="text/javascript">
$("select[name=idServicio]").change(function ()){
	$.post("<?=base_url() ?> index.php/ServicioPrestamo/Listado", {nombre: $("[name='nombre']").val(),idServicio: $("[name='idServicio']").val()}, function(resp){
    	$("#modulo").html(resp);
	});
}

</script>