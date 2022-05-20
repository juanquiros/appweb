<nav>
        <?php 
        $ruta = explode('/',current_url());
        if($ruta[count($ruta)-1] == 'registro'){
                echo '<a href="' . site_url("/login") . '" >Iniciar Sesión</a>|';
        }else{
                echo '<a href="' . site_url("/registro") . '" >Crear una cuenta</a>|';
        }
        ?>
        
        <a href="" >Olvide mi contraseña</a>|
        <a href="" >Acerca de Nosotros</a>
</nav>