<?php
?>
<div class="card">
<div class="card-header">
	<div class="row">
		<div class="col">Historial de Prestamos</div>
		<div class="col text-right">
			
		</div>
	</div>
</div>
<div class="card-body">
<table class="table table-striped table-bordered">
<thead class="thead-inverse">
<tr>
	<th>No Adquisición</th>
	<th>Título</th>
	<th>Autor</th>
	<th>Política</th>
	<th>Salida</th>
	<th>Entrada </th>
	<th>Renovaciones</th>
	<th>Multa</th>

</tr>
</thead>

<tbody>
<?php if(@count($prestamos)>0) foreach ($prestamos as $p){ /* @var $p Prestamo */?>
<tr>
	<td><?php echo $p->ejemplar->getNumAdquisicion()?></td>
	<td><?php echo $p->ejemplar->getTitulo()?></td>
	<td><?php echo $p->ejemplar->getAutor()?></td>
	<td><?php echo $p->politica->getNombre()?></td>
	<td><?php echo $p->getFechaSalida()?></td>
	<td><?php echo $p->getFechaEntrada()?></td>
	<td><?php if($p->getRenovaciones()<1){echo $p->getRenovaciones();} else {?>
	 <a href="#" data-direccion="admin/Prestamos/vwRenovaciones/<?=$p->getId()?>" data-objetivo="#e_modal_content" data-toggle="modal" data-target=#e_modal><?php echo $p->getRenovaciones()?></a>
	<?php }?>

	</td>
	
	<td><?php echo $p->getEstado()?></td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>