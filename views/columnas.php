<?php
$tama�o=12/count($modulos);
?><div class="row">
<?php foreach ($modulos as $mod){?>
	<div class="col-lg-<?=$tama�o?>">
	<?php echo $mod?>
	</div>
<?php } ?>

</div>