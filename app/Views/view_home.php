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
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-11 p-0">                            
                            <select name="order" id="orderListaBusqueda" class="inp-home mb-2" onchange="ordenarListaBusqueda()">
                                <option value ="relevance">Relevancia</option>    
                                <option value ="date">Fecha</option>
                                <option value ="rating">Calificación mayor a menor</option>
                                <option value ="title">Título simbolos numeros letras</option>
                                <option value ="videoCount">Canal, número de videos</option>
                                <option value ="viewCount">Reproducciones de mayor a menor</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="order" class="lbl-home" >Ordenar por</label>
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
                                <input type="text" id="terminos" class="inp-home mb-2" onkeypress="buscarKeyPress(event)">
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
                <div class="card-header w-100 scroll-card p-2 mb-2">
                            <div class="col-md-4">
                                <h2>Mis videos</h2>                                
                            </div>
                            <div class="col-md-8">                                
                                <div class="orden-mis-videos row">
                                    <label for="order" class="lbl-home">Ordenar videos por</label>    
                                    <select name="order" id="orderGuardado" class="inp-home" onchange="ordenarListaGuardada()">
                                        <option>Fecha guardado antiguo</option>    
                                        <option>Fecha guardado actual</option>    
                                        <option>Titulo A-Z</option>
                                        <option>Titulo Z-A</option>
                                    </select>
                                </div>
                            </div>                            
                </div>
                <div class="card-body scroll" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                    <div class="accordion" id="accordionListas">                        
                    </div>                   
                </div>                
        </div>
    </div>
    <?php include_once('documentoCierre.php');?>