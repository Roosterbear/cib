<h1><?php echo $id; ?></h1>
<h1><?php echo $titulo; ?></h1>
<h1><?php echo $autor; ?></h1>
<h1><?php echo $isbn; ?></h1>
<h1><?php echo $clasificacion; ?></h1>
<hr>
<?php
foreach($ejemplar as $e){
  echo "<h3>".$e['adq']." - ".$e['volumen']." - ".$e['tomo']." - ".$e['accesible']."</h3>";
}
?>