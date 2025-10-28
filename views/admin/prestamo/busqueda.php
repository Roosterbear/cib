<?php
// @@@@@@@@@@@@@@@@@@@@@@@@@@@
// MODAL PARA BOTON "Devolver"
// @@@@@@@@@@@@@@@@@@@@@@@@@@@
?>
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel">Regresar Ejemplar</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="<?php echo site_url("admin/Prestamos/BuscarLibro")?>" data-objetivo="#response_devolver" >
<div class="form-row align-items-center">
<label for="adquisicion" class="col-auto"># de Adquisici&oacute;n:</label>

<div class="col-auto">
<input type="text" class="form-control mr-sm-2" name="numAdquisicion" required="required">

</div>
<div class="col-auto">
<button class="btn btn-primary btn-sm mr-sm-2" style="cursor:pointer;">Buscar</button>
</div>
</div>

</form>
<br>
<div id="response_devolver"></div>

</div>
<div class="modal-footer"></div>
<script type="text/javascript">
</script>