<?php
$tamaño=12/count($modulos);
?><div class="row">
<?php foreach ($modulos as $mod){?>
	<div class="col-lg-<?=$tamaño?>">
	<?php echo $mod?>
	</div>
<?php } ?>

</div>