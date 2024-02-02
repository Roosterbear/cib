<?php
?><!DOCTYPE html>
<html>
<head>
	<title>Catalogo de Servicios</title>
	<link rel="stylesheet" href="/css/font-awesome.css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/bootstrap.4.css/bootstrap.min.css">
<!-- 	<link rel="stylesheet" href="/css/sito.css"> -->
	<link rel="stylesheet" href="/css/lobibox.min.css">
	<link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
	
	<script type="text/javascript" src="/js/jquery-3.1.1.min.js" ></script>
	<script type="text/javascript" src="/js/popper-1.12.js" ></script>
	<script type="text/javascript" src="/js/bootstrap.4.min.js" ></script>
	<script type="text/javascript" src="/js/lobibox-master/lobibox.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-datepicker.es.min.js"></script>
	
	<style type="text/css">
		body{ font-size: 12px;}
		select,input{
			padding: 1px !important;
			height:auto !important;
		}
	</style>
	
</head>
<body>
<div class="container-fluid">
<h4>Catalogo de Servicios</h4>
<br>
<div >
	<div>
		<input type ="text" name="buscar" value="" required="required" >
		
		<button  type="button" class="btn btn-primary btn-sm" data-buscar class="btn btn-search" >
		  <i class="fa fa-search" aria-hidden="true"></i> Buscar
		</button>
		
		<button class="btn btn-danger btn-sm "  data-direccion="admin/ServicioTipos/vwCatalogo/" class="btn btn-ban"  >
		  <i class="fa fa-ban" aria-hidden="true"></i> Cancelar
		</button>
   
	</div>	
</div>
<br>
<?php 
//get_instance()->load->view("admin/politicas/edicion",array("funcion"=>"agregar","politica"=>new Politica()));
?>


<hr>
<div class="row">
	<div class="col-sm-12" id="modulo">
		<?php get_instance()-> vwCatalogo()?>
	</div>
</div>


            
        <!-- Modales Generales De Ayuda  -->				 
		<!-- Modal (Grande)  -->
		<div class="modal" tabindex="-1" role="dialog" id="e_modal_lg" aria-labelledby="e_modal_lg">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content" id="e_modal_lg_content"></div>
		  </div>
		</div>
		<!-- Modal Normal (mediana)  -->
		<div class="modal" tabindex="-2" role="dialog" id="e_modal" aria-labelledby="e_modal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content" id="e_modal_content"></div>
		  </div>
		</div>
		<!-- Modal (Chica)  -->
		<div class="modal" tabindex="-3" role="dialog" id="e_modal_sm" aria-labelledby="e_modal_sm">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content" id="e_modal_sm_content"></div>
		  </div>
		</div>
   		<!-- FIN de Modales Generales De Ayuda  -->	



</div>
<script type="text/javascript">
$("body").on("submit","form",function(e){
	var objetivo = $(this).data("objetivo");

	
	$.post($(this).attr("action"),$(this).serialize(), function(resp){

		if(typeof objetivo !== typeof undefined){
				$(objetivo).html(resp);
		}else{
			$("#modulo").html(resp);
		}
		
		$("#modulo").html(resp);
	}).fail(function(resp){
        notificacion("error",resp.responseText);
    });
	return false;
});

$("#filtro").on("change","select",function(e){
	$("#modulo").html("");
});

$("body").on("click","[data-direccion]",function(e){
	var dir = $(this).data("direccion");
	var objetivo = $(this).data("objetivo");

	if(typeof dir !== typeof undefined && dir !== false && dir !== ""){
		if(typeof objetivo !== typeof undefined){
			$.post("<?=site_url()?>/"+dir,function(resp){
				$(objetivo).html(resp);
			}).fail(function(resp){
		        notificacion("error",resp.responseText);
		    });    
		}else{
			$.post("<?=site_url()?>/"+dir,function(resp){
				$("#modulo").html(resp);
			}).fail(function(resp){
		        notificacion("error",resp.responseText);
		    });
			  
		}

	}
});



function notificacion(tipo,msg){
	Lobibox.notify(tipo, {
		msg: msg,
		iconSource: "fontAwesome",
		size: 'mini',
		width: 500,
		rounded: true,
		position: 'center top',
		sound: false,
		delay: 5000,
		delayIndicator: false
	});
}

$("[data-buscar]").on("click",function(){
	var nombre =$("[name='buscar']").val();
	      if($.trim(nombre) != ""){ 
	          $.post("<?=site_url()?>/admin/ServicioTipos/buscar", {nombre: $("[name='buscar']").val()}, function(resp){
                $("#modulo").html(resp);
		          });
	         }
});






</script>
</body>
</html>