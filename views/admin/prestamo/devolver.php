<?php
@$hoy=new DateTime();
@$fecha=new DateTime($prestamo->getFechaEntrega()." 23:59:00");
$vencido=$fecha<$hoy; 

?><form action="<?php echo site_url("admin/Prestamos/DevolverLibro/{$prestamo->getId()}")?>">
	
    <div class="card <?php echo $vencido?"":"";?>">
 
	   <h6 class="card-title"><?php echo $prestamo->ejemplar->getTitulo()?></h6>
	     <p class="card-text">
	       
    	 Numero Adquisición: <b>#<?=$prestamo->ejemplar->getNumAdquisicion()?></b><br> 
	     Autor: <b><?php echo $prestamo->ejemplar->getAutor()?></b><br>
	     Fecha de Prestamo: <b><?php echo $prestamo->getFechaSalida() ?></b><br>
	     Fecha de Entrega: <b><?php echo $prestamo->getFechaEntrega() ?></b>
	   	<?php if ($vencido){?>
	   		<span class="badge badge-danger">Aplica Multa</span>
	   	<?php } ?>
	     </p>
	 <div  class="row">
	  <?php if ($prestamo->getEstado()==1){ ?>
	   <div class="col-md-12">
	      <hr>
	       
		  <button class="btn btn-success btn-sm btn-block"><i class="fa fa-sign-in" aria-hidden="true" > </i> Devolver</button>
		 
		  
	   </div>
	   <?php } ?>
		
	 </div>
    </div>
	 
   </form>