<?php
$n=1;
?><div class="card" >
<div class="card-body">

<table class="table">
<thead class="thead-inverse">
 <tr>
 	<th>#</th>
 	<th>Fecha de Renovación</th>
 	<th>Usuario</th>
 </tr>
</thead>

<tbody>
<?php foreach($renovaciones as $pr){ /* @var $pr PrestamoRenovacion */ ?>
 <tr>
 	<td><?=$n++?></td>
 	<td><?=$pr->getFecha()?></td>
 	<td><?=$pr->usuario->NombreCompleto()?></td>
 	
 </tr>
<?php } ?>
</tbody>
</table>
 	 
</div>

</div>