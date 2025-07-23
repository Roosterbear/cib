<?php
$bm=new BibliotecaMenus();
$bm->setClass("form-control input-sm");
$bm->setRequerdio(true);
$bm->setBlank1stItem(false);
/* @var $ejemplar Ejemplar */
$ejemplar;

//$idPerfil=2;
?>
<div class="card">
 
 <div class="card-body">
 <h6 class="card-title"><?=$ejemplar->getTitulo()?></h6>
 <p class="card-text">
 	Autor: <b><?php echo $ejemplar->getAutor()?></b><br>
 	Clasificación: <b><?php echo $ejemplar->getClasificacion()?></b><br>
 	Adquisición: <b>#<?=$ejemplar->getNumAdquisicion()?></b>
 </p>

 

 	<div class="row">
	 	<?php if(true/*$ejemplar->esPrestable()*/){	 	
		 	if($ejemplar->getEnPrestamo()){ ?>
			<div class="col-sm-12 text-right">
				<b class="text-success">Actualmente en Prestamo</b>
			</div>
			<?php }else{ ?> 
	 	<div class="col-sm-8"><label>Politica de Prestamo:</label><?php echo $bm->PoliticaPefil($idPerfil);?></div>
	 	<div class="col-sm-4">
	 		<br><button class="btn btn-success " id="btn_prestar">Prestar <i class="fa fa-book" aria-hidden="true"></i> </button>
	 		<input type="hidden" name="idEjemplar" value="<?=$ejemplar->getId()?>"/>
	 	</div>
	 			
		<?php } }else{ ?>
		<div class="col-sm-12 text-right">
			<b class="text-danger">No disponible para Prestamo</b>
		</div>
		<?php } ?>

		</div>

 </div>
 
</div>
<script type="text/javascript">
$("#btn_prestar").click(function(e){ $("#e_modal").modal("hide"); });
</script>