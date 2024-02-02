<?php
/* @var $usuario Alumno */

?><div class="card" style="width: 26rem;">

<div class="card-body">
    <h5 class="card-title"><?=$usuario->NombreCompleto()?></h5>


<div class="media" ><div class="media-body">
	    <h6 class="card-subtitle mb-2 text-muted"><span><?=$usuario->getTipo()?></span></h6>
    <p class="card-text"> 
    <?php if($usuario->getTipo()=="Alumno"){?>
    	Matricula:<b> <?php echo $usuario->getMatricula();?></b><br/>
    	Estatus:<b> <?php echo $usuario->getStatus();?></b><br/>
    	Grupo:<b> <?php echo $usuario->getGrupo();?></b><br/>
    	Ultimo Cuatrimestre:<b> <?php echo $usuario->getCuatrimestre();?></b><?php $usuario->getFechaBaja()!==null?"Baja {$usuario->getFechaBaja()}":"" ?><br>
    <?php }else { ?>
    	Numero de empleado: <b><?php echo $usuario->getUsuario() ?></b> <br/>
    	Departamento: <b><?php echo $usuario->getDepartamento() ?></b>
    <?php } ?>
    </p>
    </div>
	    <div class="align-self-center mr-3">
			<div style="height:90px; width: 70px;background-image:url('http<?php echo is_https()?'s':""?>://fotos.ds.utags.edu.mx/<?=($usuario->getTipo()=="Alumno"?"alumno":"personal")."/".$usuario->getUsuario()?>.jpg');background-position:center;background-size:cover;"></div>
		</div>
	</div>
	
</div>
<div class="card-footer text-right">
   <div class="row">
	
   <?php if($usuario->getActivo()){   ?>
   <div class="col">
   	<span class="text-success"> Activo</span>
   	<?php if($seleccionable){?>
		<button class="btn btn-primary btn-sm" data-direccion="admin/<?=get_instance()->router->fetch_class();?>/vwPrestamoUsuario<?php echo "/{$usuario->getId()}/{$usuario->getTipo()}";?>">
			Seleccionar	<i class="fa fa-hand-o-left" aria-hidden="true"></i>
		</button>
	<?php } ?>
   </div>
   <?php } else {?>
   <div class="col text-danger"> Inactivo</div>
   <?php } ?>
   </div>
</div>

</div>