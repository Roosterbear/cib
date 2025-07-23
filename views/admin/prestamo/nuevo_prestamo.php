<?php
/* MODAL DE VENTANITA NUEVO PRESTAMO - BUSCAR LIBRO */
?><div class="modal-header">
	<h6 class="modal-title" id="exampleModalLabel">Nuevo Prestamo</h6>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
<form action="<?php echo site_url("admin/Prestamos/BuscarEjemplar")?>" data-objetivo="#response_adquisicion" >
    <input type="hidden" name="idSolicitante" value="<?=$usuario->getId() ?>"/>
    <input type="hidden" name="tipo" value="<?=$usuario->getTipo()?>"/>
    <input type="hidden" name="idPerfil" value="<?=$usuario->getIdPerfil()?>"/>
    <div class="form-row align-items-center">
        <label for="adquisicion" class="col-auto"># de Adquisicion:</label>
        <div class="col-auto">
            <input type="text" class="form-control mr-sm-2" name="adquisicion" id="adquisicion" required="required">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary btn-sm mr-sm-2">Buscar</button>
        </div>
    </div>
</form>
<br>

<form action="<?php echo site_url("admin/Prestamos/nuevo")?>"  novalidate>
	<input type="hidden" name="idSolicitante" value="<?=$usuario->getId()?>"/>
	<input type="hidden" name="tipo" value="<?=$usuario->getTipo()?>"/>
	<div id="response_adquisicion"></div>
</form>	
</div>
<div class="modal-footer"></div>
