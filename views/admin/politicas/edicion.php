<?php
/* @var $politica Politica */
?>
<div class="card"> 
 <h4 class="card-header"><?=ucfirst($funcion)?></h4>
 <div class="card-body">
<form id="formDinamico" action="<?php echo site_url("admin/Politicas/$funcion")?>">
<input type="hidden" name="id" value="<?php echo  @$politica->getId()?>">
<label>Nombre
<input type ="text" name="nombre" value="<?php echo  @$politica->getNombre()?>" class="form-control" required="required">
</label>
<label>Libros Maximos
<input type ="text" name="libros" value="<?php echo  @$politica->getLibros()?>" class="form-control" required="required">
</label>
<label>Dias
<input type ="text" name="dias" value="<?php echo  @$politica->getDias()?>" class="form-control" required="required">
</label>
<label>Renovaciones
<input type ="text" name="renovacion" value="<?php echo  @$politica->getRenovacion()?>" class="form-control" required="required">
</label>
<button type="submit"   class="btn btn-primary">
<i class="fa fa-reply-all"  aria-hidden="true"></i>
Enviar</button>
</form>	
</div>
</div>

<script type="text/javascript">
	
</script>