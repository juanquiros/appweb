<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Login - Taller de Aplicaciones Web</title>
    <link rel="icon" href="fabicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>var base_url = '<?php echo base_url() ?>';</script>

</head>
<body>
   <header>
       <a href="/"><img src="img/VideoTrend.png" alt="VideoTrend">
       <h1>VideoTrend</h1></a>
       <h3>Mira tus videos de YouTube como quieras</h3>
       
   </header>
   <nav>
        <a href="<?php echo site_url("/registro");?>" target="_blank">Crear una cuenta</a>|
        <a href="" target="_blank">Olvide mi contraseña</a>|
        <a href="" target="_blank">Acerca de Nosotros</a>
    </nav>
   <div class="row login-row">
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
   <footer><h2>YouTube - U.G.D. - Campus Virtual</h2></footer>
   <script src="js/script.js"></script>
</body>
</html>