<?php include_once('documentoDeclaracion.php');?>
<div class="row">
<div class="jumbotron">
  <h1 class="display-4">¡Hasta pronto <?php echo $nombre ?>!</h1>
  
  <hr class="my-4">
  
  <a class="btn btn-primary btn-lg" href="<?php echo site_url("/login");?>" role="button">Iniciar Sesión</a>
</div>
</div>

<?php include_once('documentoCierre.php');?>