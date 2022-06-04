<?php include_once('documentoDeclaracion.php');?>

<div class="col-lg-auto principal">
    <div class="col-lg-auto w-100">
        <form class="w-100">
            <div class="form-group w-100 justify-content-between search">
                <div class="row">
                
                    <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-11 p-0">
                            <input type="text" id="titulo" class="inp-home">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="titulo" class="lbl-home">Titulo</label>
                    </div>
                </div>
            </div>
            <div class="form-group w-100 justify-content-between search">
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-1" id="btn-search">
                                
                            </div>
                            <div class="col-md-11 p-0">
                                <input type="text" id="terminos" class="inp-home mb-2">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <label for="terminos" class="lbl-home">Términos de mi búsqueda</label>
                    </div>


                </div>
            </div>

        </form>
        <div class="alert alert-danger" role="alert" id="alert">                        
        </div>
    </div>
    <div class="col-lg-auto w-100">
        <div class="w-100 scroll-card p-2 mb-2">
            <div id="status"></div>
            <div class="card-body scroll" data-spy="scroll"  data-offset="0">
                
                <div id="videoListContainer" >
                    <div class="search-row" id="listaBusqueda">
                    </div><hr>
                </div>
                
            </div>
            <div id="cargarmas"></div>
        </div>
        <div class="w-100 scroll-card p-2 mb-2">
            
                <div class="card-body scroll" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                    <div class="accordion" id="accordionListas">
                        
                    </div>
                   
                </div>
                
        </div>
    </div>

    <?php include_once('documentoCierre.php');?>