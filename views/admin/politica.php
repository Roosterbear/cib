<?php
//$politica = new Politica();
?><div class="card" >
<div class="card-body">
    <h5 class="card-title"><?=$politica->getNombre()?></h5>
	
    <p class="card-text">
    	Máximo de libros: <b> <?=$politica->getLibros()?></b><br>
    	Máximo de dias por libro: <b><?=$politica->getDias()?></b><br>
    	Máximo de renovaciones:  <b><?=$politica->getRenovacion()?></b><br>
    	
    </p>
 	 
</div>

</div>