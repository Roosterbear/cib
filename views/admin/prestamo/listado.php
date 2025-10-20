<?php 
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// MODAL para mostrar los prestamos del Usuario
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
?>
<div class="card">
<div class="card-header">
	<div class="row">
		<div class="col"><h6>Libros en Prestamo</h6></div>
		<div class="col">
			<!-- BOTON "Historial" -->
			<button class="btn btn btn-secondary btn-sm " data-toggle="modal" data-target="#e_modal_lg" data-direccion="admin/Prestamos/vwHistorial/<?=$idSolicitante?>" data-objetivo="#e_modal_lg_content">
				Historial <i class="fa fa-history" aria-hidden="true"></i>
			</button>
		</div>
		<div class="col"></div>
		<div class="col">M&aacute;ximo: <b><?php echo $perfil->getLibros()?></b></div>
		<div class="col text-right">
			
			<!-- MENSAJE Si tiene Multa -->
			<?php  if ($multa){?>
				<span class="badge badge-danger">Tiene Multa</span>
			<?php } ?>
			
			<!-- EL BOTON DE "Prestar Libro" DESAPARECE SI YA ALCANZO EL MAXIMO -->
			<?php if( $nuevoPrestamo){?>
				<!-- BOTON "Prestar Libro" -->
				<button class="btn btn btn-primary btn-sm " data-toggle="modal" data-target="#e_modal" data-direccion="admin/Prestamos/vwNuevoPrestamo/<?=$idSolicitante?>/<?=$tipo?>" data-objetivo="#e_modal_content">
					Prestar Libro <i class="fa fa-book" aria-hidden="true"></i>
				</button>
			<?php } ?>
		</div>

	</div>
</div>

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<!-- ENCABEZADO DE TABLA DE PRESTAMOS -->
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
 
<!-- Se muestra independientemente si el usuario tiene prestamos o no -->
<div class="card-body">
<table class="table table-striped table-bordered">
<thead class="thead-inverse">
<tr>
	<th>No Adquisici&oacute;n</th>
	<th>T&iacute;tulo</th>
	<th>Autor</th>
	<th>Pol&iacute;tica</th>
	<th>Salida</th>
	<th>Entrega </th>
	<th>Renovaciones</th>
	<th>Acci&oacute;n</th>
</tr>
</thead>

<tbody>
<?php if(@count($prestamos)>0) foreach ($prestamos as $p){ /* @var $p Prestamo */
	@$hoy=new DateTime();
	@$fecha=new DateTime($p->getFechaEntrega()." 23:59:00");
	$vencido=$fecha<$hoy;
	?>
<tr class="<?=$vencido?"table-danger":""?>">
	<td><?php echo $p->ejemplar->getNumAdquisicion()?></td>
	<td><?php echo $p->ejemplar->getTitulo()?></td>
	<td><?php echo $p->ejemplar->getAutor()?></td>
	<td>
	 <a href="#" data-direccion="admin/Prestamos/vwPolitica/<?=$p->getIdPolitica()?>" data-objetivo="#e_modal_content" data-toggle="modal" data-target=#e_modal>
	 <?php echo $p->politica->getNombre()?></a>
	</td>
	<td><?php echo $p->getFechaSalida()?></td>
	<td>
		 <a href="#" data-direccion="admin/Prestamos/vwEditarFecha/<?=$p->getId()?>" data-objetivo="#e_modal_content" data-toggle="modal" data-target=#e_modal><?php echo $p->getFechaEntrega()?></a>
	</td>
	<td><?php if($p->getRenovaciones()<1){echo $p->getRenovaciones();} else {?>
	 <a href="#" data-direccion="admin/Prestamos/vwRenovaciones/<?=$p->getId()?>" data-objetivo="#e_modal_content" data-toggle="modal" data-target=#e_modal><?php echo $p->getRenovaciones()?></a>
	<?php }?>
	
	</td>

	<td>
	 <button class="btn btn-sm btn-primary" data-direccion="admin/Prestamos/Renovar/<?=$p->getId()."/".$p->getIdSolicitante()."/".$tipo?>"><i class="fa fa-undo" aria-hidden="true"></i> Renovar</button>
	 <button class="btn btn-sm btn-success" data-direccion="admin/Prestamos/Devolver/<?=$p->getId()."/".$p->getIdSolicitante()."/".$tipo?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Devolver</button>
	</td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>