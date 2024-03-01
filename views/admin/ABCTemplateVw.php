<i class="fa fa-cog" aria-hidden="true"></i>
<small>Este sitio esta a modo de construcci&oacute;n</small>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-4 centrado">
      <img src="/cib/assets/img/biblioteca.png" class="icono" /><h4 class="bib-titulo">ABC Libros</h4>
    </div>
    <div class="col-md-3"></div>
    <br/>
  </div>   
  <hr/>
</div>

<div class ="container-fluid">
  <section id="ficha-ejemplar" class="padre">
    <a href="<?php echo base_url('cib.php/admin/Libros/getFicha')?>" id="ficha"  
    class="abc-tab--padre <?=@$ficha?$ficha:'';?>">Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/getEjemplar')?>" id="ejemplar" 
    class="abc-tab--padre <?=@$ejemplar?$ejemplar:'';?>">Ejemplar</a>
  </section>
  <section id="abc-ficha" class="padre <?= @$ocultarFicha?'ocultar':'';?>">
    <a href="<?php echo base_url('cib.php/admin/Libros/altaFicha')?>" id="alta-ficha" 
    class="abc-tab--child <?=@$altaFicha?$altaFicha:'';?>">Alta Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/bajaFicha')?>" id="baja-ficha" 
    class="abc-tab--child <?=@$bajaFicha?$bajaFicha:'';?>">Baja Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/cambioFicha')?>" id="cambio-ficha" 
    class="abc-tab--child <?=@$cambioFicha?$cambioFicha:'';?>">Cambio Ficha</a>
  </section>

  <section id="abc-ejemplar" class="padre <?= @$ocultarEjemplar?'ocultar':'';?>">
    <a href="<?php echo base_url('cib.php/admin/Libros/altaEjemplar')?>" id="alta-ejemplar" 
    class="abc-tab--child <?=@$altaEjemplar?$altaEjemplar:'';?>">Alta Ejemplar</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/bajaEjemplar')?>" id="baja-ejemplar" 
    class="abc-tab--child <?=@$bajaEjemplar?$bajaEjemplar:'';?>">Baja Ejemplar</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/cambioEjemplar')?>" id="cambio-ejemplar" 
    class="abc-tab--child <?=@$cambioEjemplar?$cambioEjemplar:'';?>">Cambio Ejemplar</a>
  </section>
</div>
<hr/>
