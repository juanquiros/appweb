<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	<title><?php  if (isset($title) && !empty($title)) echo $title . ' - '   ?> Taller de Aplicaciones Web</title>
    
    <link rel="icon" href="<?php if(isset($sub) && $sub) echo '../'?>img/fabicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php if(isset($sub) && $sub) echo '../'?>css/style.css">    
    <link rel="stylesheet" type="text/css" href="<?php if(isset($sub) && $sub) echo '../'?>css/registro.css">  
      
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script src="https://apis.google.com/js/api.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php if(isset($sub) && $sub) echo '../'?>css/home.css">
    <script>
            var base_url = '<?php echo base_url() ?>';
            var usuario_session = <?php echo json_encode(session()->get('user'))?>;
            var subRuta = <?php if(isset($sub) && $sub){ echo 'true'; }else{ echo 'false'; }?>;
            var ruta = <?php echo json_encode(explode('/',current_url()))?>;
    </script>
    </head>
    <body>

    <header>
       <a href="<?php echo site_url("/");?>"><img src="<?php if(isset($sub) && $sub) echo '../'?>img/VideoTrend.png" alt="VideoTrend">
       <h1>VideoTrend</h1></a>
       <h3>Mira tus videos de YouTube como quieras</h3>
       
   </header>
   
   <?php 
   //Navbar con datos de usuarios o no
   if(session()->get('user') != null){
       $Usersession = session()->get('user');
       include_once('navSession.php');
   }else include_once('nav.php'); ?>