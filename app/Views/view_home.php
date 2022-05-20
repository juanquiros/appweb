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
    </div>
    <div class="col-lg-auto  w-100">
        <div class="w-100 scroll-card p-2 mb-2">
            <div class="card-body scroll" data-spy="scroll"  data-offset="0">
                <div id="videoListContainer" >

                </div>
                
            </div>
        </div>
        <div class="w-100 scroll-card p-2 mb-2">
            
                <div class="card-body scroll" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                    <div class="accordion" id="accordionExample">
                        <div class="collapse-card" >
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Collapsible Group Item #1
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample" >
                                <div id="listaVideos1">

                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>

    <?php include_once('documentoCierre.php');?>