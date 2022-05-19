

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	<title>Registro - Taller de Aplicaciones Web</title>
    
    <link rel="icon" href="img/fabicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <link rel="stylesheet" type="text/css" href="css/registro.css">  
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script>
            var base_url = '<?php echo base_url() ?>';
            var usuario_session = <?php echo json_encode(session()->get('user'))?>;
    </script>
    </head>
    <body>
    
    
        <header>
            <a href="/"><img src="img/VideoTrend.png" alt="VideoTrend">
            <h1>VideoTrend</h1></a>
            <h3>Mira tus videos de YouTube como quieras</h3>
        </header>
        <nav><a href="<?php echo site_url("/login");?>" target="_blank">Iniciar Sesión</a>|
         <a href="" target="_blank">Olvide mi contraseña</a>|
         <a href="" target="_blank">Acerca de Nosotros</a></nav>
        <div class="row registro-row">
            <section class="item">
                <div class="text-center">
                    <h1>Actualizar Datos de Usuario</h1>
                    <hr>
                </div>
                
                <form method="PUT" onSubmit="actualizarUsuario(event)">
                    <h2>Datos de Inicio de Sesión</h2>                    
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input data-toggle="tooltip"  title="Ingrese su Email" type="email" name="email" id="email" onblur="email_available()">
                    </div>
                    <div class="form-item">
                        <div class="alert alert-danger" role="alert" id="email_alert">                        
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="password">Contraseña</label>
                        <input data-toggle="tooltip"  title="Ingrese su contraseña" type="password" name="password" id="password">
                    </div>
                    <div class="form-item">
                        <label for="re-password">Repetir Contraseña</label>
                        <input data-toggle="tooltip"  title="Repita su contraseña" type="password" name="re-password" id="re-password">
                    </div>
                    <h2>Datos Personales</h2>
                    <div class="form-item">
                        <label for="nombre">Nombre</label>
                        <input data-toggle="tooltip"  title="Ingrese su nombre" type="text" name="nombre" id="nombre" maxlength="60">
                    </div>
                    <div class="form-item">
                        <label for="apellido">Apellido</label>
                        <input data-toggle="tooltip"  title="Ingrese su apellido" type="text" name="apellido" id="apellido" maxlength="60">
                    </div>
                    <div class="form-item">
                        <label for="genero">Genero</label>
                        <div id="genero" data-toggle="tooltip"  title="Seleccione una opción">
                            <input type="radio" name="genero" id="femenino" value="Femenino">
                            <label for="femenino" >Femenino</label>
                            <input type="radio" name="genero" id="masculino" value="Masculino">
                            <label for="masculino" >Masculino</label>
                        </div>                        
                    </div>
                   
                    <div class="form-item">
                        <label for="tel">Telefono</label>
                        <input data-toggle="tooltip"  title="Ingrese su Teléfono" type="tel" name="tel" id="tel">
                    </div>
                    <div class="form-item">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input data-toggle="tooltip"  title="Ingrese su fecha de nacimiento" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
                    </div>
                    <div class="form-item">
                        <label for="pagina_web">Página Web</label>
                        <input data-toggle="tooltip"  title="Ingrese su página web" type="url" name="pagina_web" id="pagina_web">
                    </div>
                    <h2>Datos de localización</h2>
                    <div class="form-item">
                        <label for="pais">País</label>
                       <select data-toggle="tooltip"  title="Seleccione su país" name="pais" id="pais" onChange="getProvinces(event)">
                            <option value="0" selected>Seleccione un Pais</option>            
                            <?php   
                                    foreach($countries as $key => $country){
                                        echo '<option value="' . $country->id . '">' . $country->pais . '</option>';
                                    }
                            ?>
                       </select>
                    </div>
                    <div class="form-item">
                        <label for="provincia">Provincia/Estado</label>
                        <select data-toggle="tooltip"  title="Seleccione su provincia"  name="provincia" id="provincia" onChange="getLocalities(event)">
                        <option value="0" selected>Seleccione una provincia</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="ciudad">Ciudad</label>
                        <select data-toggle="tooltip"  title="Seleccione su ciudad"  name="ciudad" id="ciudad" onchange="start()">
                            <option value="0" selected>Seleccione una localidad</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label   for="calle">Calle</label>
                        <input data-toggle="tooltip" value="jauretche y lopez" title="Ingrese su calle" type="text" name="calle" id="calle" oninput ="start()">
                    </div>
                    <div class="form-item">
                        <label for="altura">Altura (número)</label>
                        <input data-toggle="tooltip"  title="Ingrese altura del domicilio" type="number" name="altura" id="altura" onchange ="start()">
                    </div>
                    <div class="form-item">
                        <label for="coordenadas">Coordenadas</label>
                        <div  id="coordenadas" data-toggle="tooltip"  title="Ingrese sus coordenadas" >
                            <input type="number" name="lat" id="lat" readonly>
                            <label for="lat">Lat</label>
                            <input type="number" name="long" id="long" readonly>
                            <label for="long">Long</label>
                        </div>
                    </div>
                    <div class="form-item">
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="obtenerUbicacion()">Obtener Ubicación</button>                        
                    </div>
                    <div class="from-item">
                        <div id="map"></div>
                    </div>
                    <div class="form-item">
                        <button class="btn btn-outline-danger" id="btnsubmit">Actualizar datos</button>
                    </div>
                    <div class="form-item">
                        <div class="alert alert-danger" role="alert" id="alert">                        
                        </div>
                    </div>
                    <div class="form-item">
                    <a href="<?php echo site_url("/");?>" class="btn btn-outline-success w-100 mt-2">Cancelar</a>                        
                    </div>
                </form>
            </section>
            </div>
            <footer><h2>YouTube - U.G.D. - Campus Virtual</h2></footer>

            
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
            <script src="js/script.js"></script>
            <script>cargarDatosSession();</script>
    </body>
</html>