<?php
?>


<div>
<table class="table table-bordered">
<thead class="thead-inverse ">
<tr>
	<th>Id</th>
	<th width="40%">Fecha</th>
	<th>Acción</th>
</tr>
</thead>
<tbody>
<?php if (count(@$lista)>0){ foreach ($lista as $l){?>
<tr>
<td><?php echo $l->getId();?></td>
<td><?php echo $l->getFecha();?></td>
<td>
<?php  if ($l->getEsBorrable()){?>
		<button class="btn btn-danger btn-sm" data-direccion="admin/DiasLaborados/borrar/<?php echo $l->getId()?>">
		
			<i class="fa fa-trash" aria-hidden="true"></i> Borrar 
		</button>
		<?php } ?>
		</td>
 


</tr>
<?php }}?>
<tr>
	<td></td>
	<td> <input class="form-control input-sm" type="text" name="fecha">
	 </td>
	<td>
     <button type="button" class="btn btn-primary btn-sm" data-agregar >
     <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Nuevo
     </button>
    </td>
</tr>
</tbody>
</table>
</div>
<script type="text/javascript">
$("[data-agregar]").on("click",function(){
	var fecha = $("[name='fecha']").val();

	if($.trim(fecha) != ""){
	
    	$.post("<?=site_url()?>/admin/DiasLaborados/agregar", {fecha: $("[name='fecha']").val()}, function(resp){
        	$("#modulo").html(resp);
    	});	
	
	}
});

$("[name='fecha']").datepicker({
    startView: 3,
    format: "yyyy-mm-dd",
    language: "es",
    weekStart: 0,
    autoclose: true,
    orientation: "top auto",
    todayHighlight: true,
    keyboardNavigation: false,
    daysOfWeekDisabled: [0,6]
});


</script>

