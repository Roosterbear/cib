<div class="container">
  <div class="row ficha">
    <div class="col-md-11">
      <h1 class="fichero"><?php echo $titulo; ?></h1>
    </div>
    <div class="col-md-1 id">ID: <u><?php echo $id; ?></u></div>
    <div class="col-md-12">
      <h2>Autor: <?php echo $autor; ?></h2>
    </div>
    <div class="col-md-12">
      <h3>ISBN: <?php echo $isbn; ?></h3>
    </div>
    <div class="col-md-12">
      <h3>Clasificaci&oacute;n: <?php echo $clasificacion; ?></h1>
    </div>  
    <div class="col-md-12"><hr/></div>
    <div class="col-md-12">
      <table class="cib-table">
        <thead>
          <th class="text-center"> ADQUISICION </th>
          <th class="text-center"> VOLUMEN </th>
          <th class="text-center"> TOMO </th>
          <th class="text-center"> ACCESIBLE </th>
        </thead>
        <tbody>
        <?php
          foreach($ejemplar as $e){
            echo "<tr>";
            echo "<td class=\"text-center\">".$e['adq']."</td>";
            echo "<td class=\"text-center\">".$e['volumen']."</td>";
            echo "<td class=\"text-center\">".$e['tomo']."</td>";
            echo "<td class=\"text-center\">".$e['accesible']."</td>";
            echo "</tr>";
          }
          ?>
        </tbody>  
      </table>
    </div>
  </div>
</div>