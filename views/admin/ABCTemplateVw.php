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
    <a href="<?php echo base_url('cib.php/admin/Libros/getFicha')?>" id="ficha" class="abc-tab--padre food">Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/getEjemplar')?>" id="ejemplar" class="abc-tab--padre">Ejemplar</a>
  </section>
  <section id="abc-ficha" class="padre">
    <a href="<?php echo base_url('cib.php/admin/Libros/altaFicha')?>" id="alta-ficha" class="abc-tab--child">Alta Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/bajaFicha')?>" id="baja-ficha" class="abc-tab--child">Baja Ficha</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/cambioFicha')?>" id="cambio-ficha" class="abc-tab--child">Cambio Ficha</a>
  </section>

  <section id="abc-ejemplar" class="padre">
    <a href="<?php echo base_url('cib.php/admin/Libros/altaEjemplar')?>" id="alta-ejemplar" class="abc-tab--child">Alta Ejemplar</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/bajaEjemplar')?>" id="baja-ejemplar" class="abc-tab--child">Baja Ejemplar</a>
    <a href="<?php echo base_url('cib.php/admin/Libros/cambioEjemplar')?>" id="cambio-ejemplar" class="abc-tab--child">Cambio Ejemplar</a>
  </section>
</div>
<hr/>
