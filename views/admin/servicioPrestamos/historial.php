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
			<th>Entrada</th>	
		 </tr>
	 </thead>
		
	<tbody>
	 <?php if(@count($prestamos)>0) foreach ($prestamos as $p){ /* @var $p Prestamo */?>
	  <tr>
		<td><?php echo $p->getServicio();?></td>
		<td><?php echo $p->getActivo();?></td>
		<td><?php echo $p->getFechaSalida();?></td>
		<td><?php echo $p->getFechaEntrada();?></td>
	  </tr>
	<?php } ?>
   </tbody>
	
   </table>

</div>
</div>