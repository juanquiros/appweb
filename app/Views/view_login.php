<?php include_once('documentoDeclaracion.php');?>

   
   <div class="row login-row mb-5">
        <section class="item">
                
                <form id="formLogin" onsubmit="login(event)">
                    <div class="form-item">
                        <div class="alert alert-danger" role="alert" id="alert">                        
                        </div>
                    </div>
                    <div class="form-item">
                        <input id="email" type="email" required>
                        <label for="email">E-mail</label>
                    </div>
                    <div class="form-item">
                        <input id="password" type="password" minlength="8" required>
                        <label for="password" >Contraseña</label>
                    </div>
                    
                    <div class="form-item">
                        <button type="submit" >Iniciar Sesión</button>
                    </div>
                </form>
                <div>
                    <hr>
                    <a href="<?php echo site_url("/registro");?>" target="_parent"><button>Crear una cuenta</button></a>
                </div>
        </section>
        <aside class="item" id="divImg" onclick="changeImg()">
            <img id="image" src="img/smartphone.png" alt="smartphone">
        </aside>
    </div>  
   
<?php include_once('documentoCierre.php');?>
