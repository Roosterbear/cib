<!DOCTYPE html>
<html>
<head>
	<title>Prestamo y Recepci�n</title>
	<link rel="stylesheet" href="/css/font-awesome.css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/bootstrap.4.css/bootstrap.min.css">
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
<h4>Consulta de libros</h4>
<br>
<form id="buscar" action="#" method="post" >
<div class="row">
	<div class="col-md-2">
		<label>Buscar:</label><br>
		<input name="usuario" class="form-control" required="required">
	</div>
	<div class="col-md-2"><br>
		<button id="buscarTitulo" class="btn btn-block btn-primary btn-sm">Buscar <i class="fa fa-search" aria-hidden="true"></i>
		</button>
	</div>
</form>

<script>
  const botonBuscar = document.querySelector("#buscarTitulo");
  botonBuscar.addEventListener("click", ()=>{
    console.log("BOTON APRETADO CORRECTAMENTE");
  });
</script>