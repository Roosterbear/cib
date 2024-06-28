  <div class="row ficha">
    <div class="col-md-12">
      <h1 class="fichero text-center"><?php echo $titulo; ?></h1>
    </div>
    <div class="col-md-12"><hr/></div>
    <div class="col-md-12">
      <h2 class="fichero"><span class="id">Autor: </span><span class="autor"><?php echo $autor; ?></h2>
    </div>
    
    <div class="col-md-12">
      <h3 class="fichero"><span class="id">ISBN: </span><span class="isbn"><?php echo $isbn; ?></span></h3>
    </div>
    <div class="col-md-12">
      <h3 class="fichero"><span class="id">Clasificaci&oacute;n: </span><span class="clasificacion"><?php echo $clasificacion; ?></span></h1>
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