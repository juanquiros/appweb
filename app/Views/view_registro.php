<?php include_once('documentoDeclaracion.php');?>


        <div class="row registro-row">
            <section class="item">
                
                <form method="POST" onSubmit="registrar(event)">
                    <h2>Datos de Inicio de Sesión</h2>                    
                    <div class="form-item">
                        <label for="email">E-mail *</label>
                        <input data-toggle="tooltip"  title="Ingrese su Email" type="email" name="email" id="email"onblur="email_available()" required>
                    </div>
                    <div class="form-item">
                        <div class="alert alert-danger" role="alert" id="email_alert">                        
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="password">Contraseña *</label>
                        <input data-toggle="tooltip"  title="Ingrese su contraseña" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-item">
                        <label for="re-password">Repetir Contraseña *</label>
                        <input data-toggle="tooltip"  title="Repita su contraseña" type="password" name="re-password" id="re-password" required>
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
                            <label for="femenino">Femenino</label>
                            <input type="radio" name="genero" id="masculino" value="Masculino">
                            <label for="masculino">Masculino</label>
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
                        <button class="btn btn-outline-danger" id="btnsubmit">Crear mi cuenta</button>
                    </div>
                    <div class="form-item">
                        <div class="alert alert-danger" role="alert" id="alert">                        
                        </div>
                    </div>
                </form>
            </section>
            <aside class="item">
                <img src="img/smartphone.png" alt="">
                <p>Al hacer clic en "Crear mi cuenta", aceptas las Condiciones y confirmas que leiste nuestra Politica de datosm incluido el uso de cookies.</p>
            
            </aside>
            </div>

<?php include_once('documentoCierre.php');?>
