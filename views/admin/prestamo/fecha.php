<?php
?><div class="modal-card">

<div class="card-body">
<form action="<?php echo site_url("admin/Prestamos/editarFecha/")?>">
<input type="hidden" name="id" value="<?php echo $prestamos->getId()?>"/>
<h6 class="card-title">Nueva Fecha</h6>
<div class="row">
<input type="text" name="fechaEntrega"   class="col-md-6" placeholder="aaaa-mm-dd" required="required" id="fecha_entraga_libro">
<button class="btn btn-success btn-sm col-md-3"><i class="fa fa-save " aria-hidden="true" > </i> Guardar</button>
<button class="btn btn-danger btn-sm col-md-3" type="button"class="close panelTitleTxt glyphicon glyphicon-remove landing-icon" data-dismiss="modal" aria-hidden="true"><i class="fa fa-ban" aria-hidden="true" ></i> Cancelar</button>
 
</div>
</form>

</div>
</div>
<script type="text/javascript">
$('#fecha_entraga_libro').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
</script>