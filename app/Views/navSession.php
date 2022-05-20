<div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <nav class="navbar navbar-light bg-light justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo site_url("/");?>"title="Ir al inicio">VideoTrend</a>
            </li>   
        </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i>
                    <?php echo $Usersession->nombre . ' ' . $Usersession->apellido ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">          
                    <a class="dropdown-item" href="<?php echo site_url("/modificarperfil");?>">Modificar Perfil</a>
                    <a class="dropdown-item" href="<?php echo site_url("/login/logout");?>">Salir</a>
                    </div>
                </div>
        </nav>
        </div>
        <div class="col-md-1"></div>
</div>