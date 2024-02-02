<?php
?><html>
<head>
	<title>Reportes</title>
	<link rel="stylesheet" href="/css/font-awesome.css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/bootstrap.4.css/bootstrap.min.css">
<!-- 	<link rel="stylesheet" href="/css/sito.css"> -->
	<link rel="stylesheet" href="/css/lobibox.min.css">
	
	
	<script type="text/javascript" src="/js/jquery-3.1.1.min.js" ></script>
	<script type="text/javascript" src="/js/popper-1.12.js" ></script>
	<script type="text/javascript" src="/js/bootstrap.4.min.js" ></script>
	<script type="text/javascript" src="/js/lobibox-master/lobibox.min.js"></script>
	
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
<br>
<h4>Reportes</h4>






<hr>

<table></table>

<div class="row">
	<div class="col-sm-3" >
	<table clasS="table table-condensed table-bordered">
	<thead>
		<tr>
			<th>Reporte</th>
			<th colspan="2">Accion</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Libros en Prestamo</td>
			<td><button data-direccion="admin/Reportes/RptLibrosEnPrestamo" class="btn btn-primary btn-sm" >Ver</button></td>
			<td>
				<a href="<?=site_url("admin/Reportes/RptLibrosEnPrestamo/xlsx")?>" class="btn btn-success btn-sm"  title="Excel">
					Descargar <i class="fa fa-file-excel-o" aria-hidden="true"></i>
				</a>
			</td>
		</tr>
		<tr>
			<td>Libros en Prestamo Vencidos</td>
			<td><button data-direccion="admin/Reportes/RptLibrosEnPrestamoVencidos" class="btn btn-primary btn-sm" >Ver</button></td>
			<td>
				<a href="<?=site_url("admin/Reportes/RptLibrosEnPrestamoVencidos/xlsx")?>" class="btn btn-success btn-sm"  title="Excel">
					Descargar <i class="fa fa-file-excel-o" aria-hidden="true"></i>
				</a>
			</td>
		</tr>
		<tr>
			<td>Activos en Prestamo</td>
			<td><button data-direccion="admin/Reportes/RptActivosEnPrestamo" class="btn btn-primary btn-sm" >Ver</button></td>
			<td>
				<a href="<?=site_url("admin/Reportes/RptActivosEnPrestamo/xlsx")?>" class="btn btn-success btn-sm"  title="Excel">
					Descargar <i class="fa fa-file-excel-o" aria-hidden="true"></i>
				</a>
			</td>

		</tr>
		
		<tr>
			<td>Activos Histórico</td>
			<td><button data-direccion="admin/Reportes/RptActivosHistorico" class="btn btn-primary btn-sm" >Ver</button></td>
			<td>
				<a href="<?=site_url("admin/Reportes/RptActivosHistorico/xlsx")?>" class="btn btn-success btn-sm"  title="Excel">
					Descargar <i class="fa fa-file-excel-o" aria-hidden="true"></i>
				</a>
			</td>

		</tr>
	</tbody>
	</table>

	</div>
	<div class="col-sm-9" id="modulo">

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
		
		//$("#modulo").html(resp);
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

</script>
</body>
</html>