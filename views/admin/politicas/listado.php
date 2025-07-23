<?php

?>
<table class="table table-bordered">
<thead class="thead-inverse ">
<tr>
	<th>Nombre</th>
	<th>Libros</th>
	<th>Días</th>
	<th>Renovaciones</th>
	<th>Acción</th>
</tr>
</thead>

<tbody>
<?php foreach ($politicas as $p){ /* @var $p Politica */ ?>
<tr>
	<td><?php echo $p->getNombre();?></td>
	<td><?php echo $p->getLibros();?></td>
	<td><?php echo $p->getDias();?></td>
	<td><?php echo $p->getRenovacion();?></td>
	<td>
	     <?php  if ($p->getEsBorrable()){?>
		<button class="btn btn-danger" data-direccion="admin/Politicas/borrar/<?php echo $p->getId()?>">
		
			<i class="fa fa-trash" aria-hidden="true"></i> Borrar 
			
		</button>
		<?php } ?>
		<button class="btn btn-primary"  data-direccion="admin/Politicas/vwEditar/<?php echo $p->getId()?>" data-objetivo="#e_modal_content" data-toggle="modal" data-target="#e_modal">
			<i class="fa fa-pencil" aria-hidden="true"></i> Editar 
		</button>
		
	</td>

</tr>
<?php } ?>
</tbody>
</table>
<script type="text/javascript">
<!--
$("#e_modal").modal('hide');
//-->
</script>
	