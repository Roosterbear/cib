<?php
?>
<div>
  <table class="table table-bordered" >
   <thead class="thead-inverse ">
   
     <tr>
        <th class="col-md-1">ID</th>
        <th>Nombre</th>
        <th>Acci�n</th>
        
     </tr>
     
   </thead>
      <tbody>
	   
	    <?php  foreach ($servicioTipos as $s){?>
	    
	     <tr>
	     
	       <td><?php echo $s->getId();?></td>
	       <td><?php echo $s->getNombre();?></td> 
	       <td><?php if ($s->getEsBorrable()){?>
		       <button class="btn btn-danger btn-sm" data-direccion="admin/ServicioTipos/borrar/<?php echo $s->getId()?>">
		         <i class="fa fa-trash" aria-hidden="true"></i> Borrar 
		      </button>
		      <?php } ?>
		   </td>   
	          
	     </tr>
	      <?php }?>
	      
	     <tr>
	     
	     <td> <input class="form-control input-sm" type="text" name="nombre"></td>
	
          <td> <button type="button" class="btn btn-primary btn-sm" data-agregar >
                   <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Nuevo
               </button>
          </td> 
          
	    </tr> 
	   
	   </tbody>
   </table>
</div>
 
 
 <script type="text/javascript">
 $("[data-agregar]").on("click",function(){
		var  nombre= $("[name='nombre']").val();

		if($.trim(nombre) != ""){
		
	    	$.post("<?=site_url()?>/admin/ServicioTipos/agregar", {nombre: $("[name='nombre']").val()}, function(resp){
	        	$("#modulo").html(resp);
	    	});	
		
		}
	});
 

</script>
 
 