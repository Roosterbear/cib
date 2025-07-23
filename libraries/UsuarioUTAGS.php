<?php
header('Content-Type: text/html; charset=iso-8859-1');
require_once __DIR__."/adldap/adLDAP.php";
$pre="";
try{
	$adldap= new adLDAP();
	$adldap->connect();
	echo $usuario="12409";
	$pre=$adldap->user()->info($usuario);
	//$adldap->user()->password($usuario, "hola_mundos");
	//$adldap->user()->create($attributes);

	
	

}catch(Exception $e){
	echo $e->getMessage();
	echo "<br><pre>".$e->getTraceAsString()."</pre>";
	$adldap->close();
}
?>
<pre><?php echo utf8_decode(print_r($pre,true))?></pre>
<h2><?php echo $adldap->authenticate($usuario, "hola_mundo")?"SI":"NO";?></h2>
<h2><?php echo $adldap->authenticate($usuario, "hola_mundos")?"SI":"NO";?></h2>
