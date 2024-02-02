<?php

$bm= new BibliotecaMenus();
$bm->setRequerdio(true);
$bm->setVacio(true);
$bm->setBlank1stItem(true);
$bm->setClass("form-control");
?>
<div>
  <table class="table table-bordered" >
   <thead class="thead-inverse ">
   
     <tr>
        <th class="col-md-1">Id</th>
        <th>Tipo Servicio</th>
        <th>Nombre</th>
        <th>Acción</th>
        
     </tr>
     
   </thead>
      <tbody>
	   
	    <?php if(count(@$servicioActivos)>0){ foreach ($servicioActivos as $s){/* @var $s ServicioActivo */?>
	    
	     <tr>
	     
	       <td><?php echo $s->getId();?></td>
	        <td><?php echo $s->getServicio();?></td>
	       <td><?php echo $s->getNombre();?></td> 
	       <td><?php if ($s->getEsBorrable()){?>
		       <button class="btn btn-danger btn-sm" data-direccion="admin/ServicioActivos/borrar/<?php echo $s->getId()?>">
		         <i class="fa fa-trash" aria-hidden="true"></i> Borrar 
		      </button>
		      <?php } ?>
		   </td>   
	          
	     </tr>
	      <?php } }?>
	      
	     <tr>
	     <td></td>
	     <td> <?php echo $bm->Servicios()?> </td>
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
		var nombre= $("[name='nombre']").val();

		if($.trim(nombre) != ""){
		
	    	$.post("<?=site_url()?>/admin/ServicioActivos/agregar", {nombre: $("[name='nombre']").val(),idServicio: $("[name='idServicio']").val()}, function(resp){
	        	$("#modulo").html(resp);
	    	});	
		
		}
	});
 

</script>
 
 