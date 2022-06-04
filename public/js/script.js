

//---------------------- Paises Provincias y Localidades
    function clearLocalities(){
      document.getElementById('calle').value = "";
      var combo = document.getElementById("ciudad");
      var L = combo.options.length - 1;
      for(i = L; i > 0; i--) {
        combo.remove(i);
      } 
    }

    function clearProvinces(){
      document.getElementById('calle').value = "";
      var combo = document.getElementById("provincia");
      var L = combo.options.length - 1;
      for(i = L; i > 0; i--) {
        combo.remove(i);
      }
    }

    function getProvinces(event, provinceName = "", localityName ="",calleName=''){
      
      if(event){
        event.preventDefault();//detener formulario  
      }
      
      var id_country = document.getElementById('pais').value;    
      var combo = document.getElementById("provincia");
      this.clearProvinces();
      this.clearLocalities();
      if(id_country > 0 ){     
          $.ajax({
            url: base_url + '/pais/getprovinces/' + id_country,
            method: "GET"
          })
            .done(function( msg ) {
              var provinces = msg.provinces;
              for (let i=1 ; i < provinces.length; i++) {         
                var option = document.createElement('option');
                // añadir el elemento option y sus valores
                combo.options.add(option, i);
                combo.options[i].value = provinces[i-1]['id'];
                combo.options[i].innerText = provinces[i-1]['provincia'];
                if(provinceName!=""){
                  if(provinceName === provinces[i-1]['provincia'] || provinceName === provinces[i-1]['id']){
                    combo.selectedIndex = i;
                    if(localityName!=""){
                      getLocalities(null,i,localityName,calleName);
                    }
                  }
                }
              }
            }).fail(function(err){
              console.log(err.statusText);
              
            });
      }else{
        console.log("Seleccione un Pais");
      }
    }


    function getLocalities(event, id_province = null, localityName = '',calleName=''){
      if(event){
        event.preventDefault();//detener formulario  
      } 
      if(!id_province){
        id_province = document.getElementById('provincia').value;
      }     
      var combo = document.getElementById("ciudad");
      this.clearLocalities();
      if(id_province > 0 ){     
          $.ajax({
            url: base_url + '/provincia/getProvince/' + id_province,
            method: "GET"
          })
            .done(function( msg ) {
              var localities = msg.localities;
              for (let i=1 ; i < localities.length; i++) {  
                  var option = document.createElement('option');
                  // añadir el elemento option y sus valores
                  combo.options.add(option, i);
                  combo.options[i].value = localities[i-1]['id'];
                  combo.options[i].innerText = localities[i-1]['localidad'];
                  if(localityName!=""){
                    if(localityName === localities[i-1]['localidad'] ||localityName === localities[i-1]['id'] ){
                      combo.selectedIndex = i;
                      if(calleName!=""){
                        document.getElementById('calle').value = calleName;
                        start();
                      }
                    }
                  }
              }
            
            }).fail(function(err){
              console.log(err.statusText);
            });
      }else{
        console.log("Seleccione una provincia");
      }
    }
//---------------------- Fin Paises Provincias y Localidades

//---------------------- Geolocalizacion

  var marker= null;
  const start = async function(consulta = null) {
    var result = null;
    const provider = new GeoSearch.OpenStreetMapProvider();
    var search = document.getElementById('calle').value;
    if(document.getElementById('altura').value){
      search += ' ' + document.getElementById('altura').value;
    }
    
    search += ', ' + document.getElementById('ciudad').options[document.getElementById('ciudad').selectedIndex].text;
    search += ', ' + document.getElementById('provincia').options[document.getElementById('provincia').selectedIndex].text; 
    search += ', ' + document.getElementById('pais').options[document.getElementById('pais').selectedIndex].text; 
    
      
      if(consulta){
         result = await provider.search({ query: consulta });
      }else{
         result = await provider.search({ query: search });
      }
      if(result != null && result.length > 0){      
        var zoom = 0;
        switch(result[0].raw.type.toString()){
          case 'administrative':
            zoom = 12;
            break;
          case 'residential':
            zoom= 17;
            break;
          default:
            console.log(result[0].raw.type.toString());
            zoom= 16;
        }
        if(this.marker){
          this.marker.remove();
        }      
        this.map.setView([result[0].y,result[0].x], zoom);     
        this.marker = L.marker([result[0].y,result[0].x],{title:result[0].label}).addTo(map);      
        document.getElementById('lat').value = result[0].y;
        document.getElementById('long').value = result[0].x;
        if(consulta){
          var label = result[0].label.split(', ');
  
          optionsPais=document.getElementById('pais').options;        
          for(i=0; i <  optionsPais.length; i ++){
              if(optionsPais[i].text === label[label.length -1] ){
                optionsPais.selectedIndex = i;
                
              }
          }
          getProvinces(null, label[label.length -3], label[label.length -6], label[label.length -9]);
        }
      }else{
        if(this.marker){
          this.marker.remove();
        }    
        document.getElementById('lat').value = '';
        document.getElementById('long').value = '';
      }
  }
  if(ruta[ruta.length-1] == "modificarperfil" || ruta[ruta.length-1] == "registro"){
   
    
   var map = L.map('map').setView([-27.3698805,-55.9399215], 17);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1IjoiNjRiaXRzanVhbiIsImEiOiJjbDJhcDVkdjMwN2d4M2pxbjRzaHY3NHlyIn0.JGc3z4I7Go_JgaZLc0VTkA'
  }).addTo(map);
  const search = new GeoSearch.GeoSearchControl({
    provider: new GeoSearch.OpenStreetMapProvider(),
  });
  
  
  
  
  
  

  function obtenerUbicacion(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(mostrarPosicion, mostrarErrores, opciones);    
    } else {
      alert("Tu navegador no soporta la geolocalización, actualiza tu navegador.");
    }
  }
  function mostrarPosicion(posicion) {
    var latitud = posicion.coords.latitude;
    var longitud = posicion.coords.longitude;
    var precision = posicion.coords.accuracy;
    var fecha = new Date(posicion.timestamp);
    console.log("Lat:" +latitud,"Long:" +longitud,"Pre:" +precision,"Date:" +fecha); 
  
    if(this.marker){
      this.marker.remove();
    }
    start(latitud + ' ' + longitud);
  
  }
  
  function mostrarErrores(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert('Permiso denegado por el usuario'); 
            break;
        case error.POSITION_UNAVAILABLE:
            alert('Posición no disponible');
            break; 
        case error.TIMEOUT:
            alert('Tiempo de espera agotado');
            break;
        default:
            alert('Error de Geolocalización desconocido :' + error.code);
    }
  }
  
  var opciones = {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 1000
  };
  start();
}

//---------------------- Fin Geolocalizacion


//---------------------- Registro de Usuario nuevo
function email_available(){
  var email = document.getElementById('email').value;  
  var button = document.getElementById('btnsubmit');
  var email_alert = document.getElementById('email_alert');
  email_alert.textContent ="";
  email_alert.style.visibility = "hidden"; 
  if( typeof usuario_session == 'undefined' || (usuario_session.email != email)){
  if(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email) ){  
      $.ajax({
        url: base_url + '/registro/email_available',
        method: "POST",
        data: {"json": JSON.stringify( {'email' : email })}
      })
        .done(function( msg ) {
          if(msg.email_available){
            var tag = document.createElement("p");
            var text = document.createTextNode(msg.message);
            tag.appendChild(text);
            email_alert.appendChild(tag);
            email_alert.className = "alert alert-success";
            email_alert.style.visibility = "visible";
            button.disabled = false;
          }else{
            var tag = document.createElement("p");
            var text = document.createTextNode(msg.message);
            tag.appendChild(text);
            email_alert.appendChild(tag);
            email_alert.className = "alert alert-danger";
            email_alert.style.visibility = "visible";
            button.disabled = true;
          }
        }).fail(function(err){
          console.log(err.statusText);          
        });
  }else{
    button.disabled = false;
  } 
}
}
function registrar(event){
    event.preventDefault();//detener formulario
    var usuario = {
      "nombre": document.getElementById('nombre').value ,
      "apellido":  document.getElementById('apellido').value,
      "email":  document.getElementById('email').value,
      "password":  document.getElementById('password').value,
      "pass_confirm":  document.getElementById('re-password').value,
      "genero":  $('input[name="genero"]:checked').val(),
      "telefono":  document.getElementById('tel').value,
      "f_nacimiento": document.getElementById('fecha_nacimiento').value,
      "id_pais": parseInt(document.getElementById('pais').value),
      "id_provincia": parseInt(document.getElementById('provincia').value),
      "id_localidad": parseInt(document.getElementById('ciudad').value),
      "calle": document.getElementById('calle').value,
      "altura": parseInt(document.getElementById('altura').value),
      "Coordenadas_lat":parseFloat( document.getElementById('lat').value ),
      "Coordenadas_long": parseFloat(document.getElementById('long').value),      
      "p_web":  document.getElementById('pagina_web').value
    }
    var error = document.getElementById('alert');
    error.textContent ="";
    $.ajax({
      url: base_url + '/usuario/insertar',
      method: "POST",
      data: {"usuario": JSON.stringify(usuario)}
    })
      .done(function( msg ) {
        error.style.visibility = "hidden";
        alert("El usuario fue registrado con éxito. Inicie sesión")
        window.location.href = base_url + '/login';
      }).fail(function(err){                
        error.style.visibility = "visible";
        var errores = JSON.stringify(err.responseJSON.errors).replace(/"/g,'').replace(/{/g,'').replace(/}/g,'').split(',');
        errores.forEach(element => {
          var tag = document.createElement("p");
          var text = document.createTextNode(element);
          tag.appendChild(text);
          error.appendChild(tag);
        });
         
      });

}

//---------------------- Fin Registro de Usuario nuevo


//---------------------- Login

function login(event){
  event.preventDefault();//detener formulario
  var password = document.getElementById('password').value;
  var email = document.getElementById('email').value;
  var error = document.getElementById('alert');
  $.ajax({
    url: base_url + '/session/login',
    method: "POST",
    data: {"json": JSON.stringify({"email":email, "password":password})}
  })
    .done(function( msg ) {
      error.style.visibility = "hidden";
      window.location.href = base_url;

    }).fail(function(err){                
      error.style.visibility = "visible";      
        var tag = document.createElement("p");
        var text = document.createTextNode(err.responseJSON.message);
        tag.appendChild(text);
        error.appendChild(tag);     
    });
}
//---------------------- Fin Login

//---------------------- Actualizar Usuario
function cargarDatosSession(){
  if(ruta[ruta.length-1] == "modificarperfil" && typeof usuario_session !== 'undefined'){
    document.getElementById('nombre').value = usuario_session.nombre;
    document.getElementById('apellido').value = usuario_session.apellido;
    document.getElementById('email').value = usuario_session.email;
    document.getElementById(usuario_session.genero.toLowerCase()).checked = true;
    document.getElementById('tel').value  = usuario_session.telefono;
    document.getElementById('fecha_nacimiento').value  = usuario_session.f_nacimiento;
    document.getElementById('pais').value = usuario_session.id_pais;
    getProvinces(null,usuario_session.id_provincia,usuario_session.id_localidad,usuario_session.calle);
    document.getElementById('altura').value = usuario_session.altura;
    document.getElementById('lat').value = usuario_session.Coordenadas_lat;
    document.getElementById('long').value = usuario_session.Coordenadas_long;
    document.getElementById('pagina_web').value = usuario_session.p_web;
  }
}

function actualizarUsuario(event){
  event.preventDefault();//detener formulario
  var error = document.getElementById('alert');
  error.textContent ="";
  var nombre = document.getElementById('nombre').value;
  var apellido =   document.getElementById('apellido').value;
  var email  = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var pass_confirm = document.getElementById('re-password').value;
  var genero = $('input[name="genero"]:checked').val();
  var telefono = document.getElementById('tel').value;
  var f_nacimiento = document.getElementById('fecha_nacimiento').value;
  var id_pais = parseInt(document.getElementById('pais').value);
  var id_provincia = parseInt(document.getElementById('provincia').value);
  var id_localidad = parseInt(document.getElementById('ciudad').value);
  var calle = document.getElementById('calle').value;
  var altura = parseInt(document.getElementById('altura').value);
  var Coordenadas_lat = parseFloat( document.getElementById('lat').value );
  var Coordenadas_long = parseFloat(document.getElementById('long').value);      
  var p_web = document.getElementById('pagina_web').value;
  var UserUpdate = {id:parseInt(usuario_session.id)};

  // comprobar y asignar unicamente los campos modificados a la actualizacion;
  if(nombre != usuario_session.nombre) UserUpdate.nombre = nombre;
  if(apellido != usuario_session.apellido)UserUpdate.apellido = apellido;
  if(email != usuario_session.email)UserUpdate.email = email;
  if(genero != usuario_session.genero) UserUpdate.genero = genero;
  if(telefono != usuario_session.telefono) UserUpdate.telefono = telefono;
  if(f_nacimiento != usuario_session.f_nacimiento) UserUpdate.f_nacimiento = f_nacimiento;
  if(id_pais != usuario_session.id_pais) UserUpdate.id_pais = id_pais;
  if(id_provincia != usuario_session.id_provincia) UserUpdate.id_provincia = id_provincia;
  if(id_localidad != usuario_session.id_localidad) UserUpdate.id_localidad = id_localidad;
  if(calle != usuario_session.calle) UserUpdate.calle = calle;
  if(altura != usuario_session.altura) UserUpdate.altura = altura;
  if(Coordenadas_lat != usuario_session.Coordenadas_lat) UserUpdate.Coordenadas_lat = Coordenadas_lat;
  if(Coordenadas_long != usuario_session.Coordenadas_long) UserUpdate.Coordenadas_long = Coordenadas_long;
  if(p_web != usuario_session.p_web) UserUpdate.p_web = p_web;
  if(password.length > 0 && pass_confirm.length > 0){
    UserUpdate.password = password;
    UserUpdate.pass_confirm = pass_confirm;
  }
  console.log(UserUpdate);
  //enviar peticion
  $.ajax({
    url: base_url + '/usuario/actualizar',
    method: "PUT",
    data: {"usuario": JSON.stringify(UserUpdate)}
  })
    .done(function( msg ) {
      error.style.visibility = "hidden";
      alert("El usuario fue actualizado con éxito.")
      window.location.href = base_url + '/';
    }).fail(function(err){                
      error.style.visibility = "visible";
      var errores = JSON.stringify(err.responseJSON.errors).replace(/"/g,'').replace(/{/g,'').replace(/}/g,'').split(',');
      errores.forEach(element => {
        var tag = document.createElement("p");
        var text = document.createTextNode(element);
        tag.appendChild(text);
        error.appendChild(tag);
      });
       
    });

}
//---------------------- Fin Actualizar Usuario

//---------------------- API Google Youtube

var apiKey = '';

gapi.load("client", loadClient);
function loadClient() {
  var noDisponible = '<i class="bi bi-exclamation-square"></i>Sin servicios'
  var loading = '<div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div>';
  var searchBtn = '<img src="';
  if(subRuta){
    searchBtn += "../";
  }
  searchBtn += 'img/VideoTrend.png" alt="VideoTrend" class="btn-search ml-0" onclick="execute()">';
  var btn = document.getElementById('btn-search');
  btn.innerHTML = loading ;
    gapi.client.setApiKey(apiKey);
    return gapi.client.load("https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest")
        .then(function() { 
          btn.innerHTML = searchBtn;
          console.log("Se cargó el cliente de google API con éxito"); },
                function(err) { 
                  btn.innerHTML = noDisponible;
                  console.error("Error  GAPI", err); });
}


const keywordInput = document.getElementById('terminos');
const maxresultInput = 40;
const orderInput = 'relevance';
const videoList = document.getElementById('listaBusqueda');
const videoListstatus = document.getElementById('status');
const videoListmas = document.getElementById('cargarmas');
const videoListTitulo = document.getElementById('titulo');
var pageToken = '';
  

  
function paginate(e, obj) {
    e.preventDefault();
    pageToken = obj.getAttribute('data-id');
    execute();
}
  

function execute() {
    const searchString = keywordInput.value;
    const maxresult = maxresultInput.value;
    const orderby = orderInput.value;
    var loading = '<div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div><h2>Cargando</h2>';
    var sinVideos= '<h2><i class="bi bi-collection-play-fill"></i> No hay resultados</h2>';
    var alertError = '<h2><i class="bi bi-exclamation-triangle-fill"></i>';
    videoListstatus.innerHTML =  loading;
    var arr_search = {
        "part": 'snippet',
        "type": 'video',
        "order": orderby,
        "maxResults":40,        
        "q": searchString
    };
  
    if (pageToken != '') {
        arr_search.pageToken = pageToken;
    }else{
      videoList.innerHTML = "";
      registrarBusqueda();
      getBusquedas();
    }
  
    return gapi.client.youtube.search.list(arr_search)
    .then(function(response) {
        // cargar resultados
        const listItems = response.result.items;
        if (listItems) {
          
          videoListstatus.innerHTML = "";
            listItems.forEach(item => {
                            crearTarjetaVideo(item.id.videoId,item.snippet.title,videoList);
            });
            
            /*
            if (response.result.prevPageToken) {
                output += `<br><a class="paginate" href="#" data-id="${response.result.prevPageToken}" onclick="paginate(event, this)">Anterior</a>`;
            } */
  
            if (response.result.nextPageToken) { //boton cargar mas
              videoListmas.innerHTML = `<h5><a href="#" class="paginate" data-id="${response.result.nextPageToken}" onclick="paginate(event, this)"><i class="bi bi-cloud-plus"></i> Cargar más resultados</a></h5>`;
            }
  
            
            
        }
        
        if(listItems.length <=0 ){
          videoListstatus.innerHTML = sinVideos;
        }
    },
    function(err) { 
      videoListstatus.innerHTML =  '<div class="text-center w-50">' +  alertError + '</h2><h2>' + err.result.error.message + '</h2></div>';
      console.error("Execute error", err); 
    });
}

function crearTarjetaVideo(videoId,videoTitle,lista,id=""){
  var newDiv = document.createElement("div");
  newDiv.className = "card bg-light";
  newDiv.id = videoId;
  newDiv.title = videoTitle;
  if(id!=""){
    newDiv.setAttribute("data-id",id);
  }
  newDiv.innerHTML = '<div class="card-header" ><i class="bi bi-arrows-move"></i> ' + videoTitle.toLowerCase() + '...</div><div class="card-body"><iframe src="https://www.youtube.com/embed/'+ videoId +'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
  // cargar tarjeta 
  lista.appendChild(newDiv);
}
//---------------- fin api google

//---------------- drag and drop

  const lista = document.getElementById('listaBusqueda');  
  Sortable.create(lista,{
      group: 'shared', 
      animation: 150,
      dragClass:"drag"
      
  });




//---------------- fin drag and drop

// --------------- Registrar busqueda
function registrarBusqueda(){
  
  var busqueda = {
    "titulo": document.getElementById('titulo').value ,
    "terminos_busqueda":  document.getElementById('terminos').value,
    "id_usuario": usuario_session.id
  }
  var error = document.getElementById('alert');
  error.textContent ="";
  $.ajax({
    url: base_url + '/busqueda/insertar',
    method: "POST",
    data: {"busqueda": JSON.stringify(busqueda)}
  })
    .done(function( msg ) {
      error.style.visibility = "hidden";
      busqueda.id = msg.id_busqueda;
      getBusquedas();
    }).fail(function(err){                
      error.style.visibility = "visible";
      var errores = JSON.stringify(err.responseJSON.errors).replace(/"/g,'').replace(/{/g,'').replace(/}/g,'').split(',');
      errores.forEach(element => {
        var tag = document.createElement("p");
        var text = document.createTextNode(element);
        tag.appendChild(text);
        error.appendChild(tag);
      });
       
    });

}
function getBusquedas(){  
  var listadebusquedas = document.getElementById("accordionListas");  
      $.ajax({
        url: base_url + '/busqueda/get',
        method: "GET"
      })
        .done(function( msg ) {
          var busquedas = msg.busquedas;
          listadebusquedas.innerHTML = "";
          for (let i = busquedas.length -1 ; 0 <= i ; i--) { 
            
            if(i == busquedas.length -1){
              nuevoAcordionBusqueda(busquedas[i], "show" );
            }else{
              nuevoAcordionBusqueda(busquedas[i]);
            }
            getVideos(busquedas[i].id);
          }
        
        }).fail(function(err){
          console.log(err.statusText);
        });  
}

if(ruta[ruta.length-1] == ""){
  getBusquedas();
}
// --------------- Fin registrar busqueda
//---------------- Listados de busqueda
function nuevoAcordionBusqueda(busqueda, show =""){
  if(busqueda){
    var idBusqueda = busqueda.id;
    var titulo = busqueda.titulo;
    var newDiv = document.createElement("div");
    var listadebusquedas = document.getElementById("accordionListas");
    newDiv.className = "accordion";
    newDiv.id = "accordion" + idBusqueda;
    
    newDiv.innerHTML = '<div class="collapse-card" ><div class="card-header" id="heading'+idBusqueda+'"><h2 class="mb-0"><button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse'+idBusqueda+'" aria-expanded="true" aria-controls="collapse'+idBusqueda+'">' + titulo  +'</button></h2></div><div id="collapse'+idBusqueda+'" class="collapse '+show+'" aria-labelledby="heading'+idBusqueda+'" data-parent="#accordion'+idBusqueda+'" ><div class="search-row listaVideos" id="search'+ idBusqueda +'"></div></div></div>';

    // cargar tarjeta 
    
    listadebusquedas.appendChild(newDiv);
    const lista = document.getElementById("search" + idBusqueda);
      Sortable.create(lista,{
          group: 'shared', 
          animation: 150,
          onAdd:(evt)=>{
           registrarVideo(idBusqueda, evt.item);
          },
          onRemove:(evt)=>{
            borrarVideo(idBusqueda, evt.item.dataset.id);
          }
      });
  }
                  
}

//---------------- Fin Listados de busqueda

// --------------- Registrar video

function registrarVideo(id_busqueda,videoItem){
  
  var video = {
    "id_busqueda": id_busqueda ,
    "id_video":  videoItem.id,
    "titulo": videoItem.title
  }
  var error = document.getElementById('alert');
  error.textContent ="";
  $.ajax({
    url: base_url + '/video/insertar',
    method: "POST",
    data: {"video": JSON.stringify(video)}
  })
    .done(function( msg ) {
      error.style.visibility = "hidden";    
      videoItem.setAttribute("data-id",msg.id);
    }).fail(function(err){                
      error.style.visibility = "visible";
      var errores = JSON.stringify(err.responseJSON.errors).replace(/"/g,'').replace(/{/g,'').replace(/}/g,'').split(',');
      errores.forEach(element => {
        var tag = document.createElement("p");
        var text = document.createTextNode(element);
        tag.appendChild(text);
        error.appendChild(tag);
      });
       
    });

}


function getVideos(id_busqueda){  
  var lista = document.getElementById("search"+id_busqueda);  
      $.ajax({
        url: base_url + '/video/'+id_busqueda,
        method: "GET"
      })
        .done(function( msg ) {
          var videos = msg.videos;
          lista.innerHTML = "";
          for (let i = 0; i < videos.length ;i++) { 
            crearTarjetaVideo(videos[i].id_video,videos[i].titulo,lista,videos[i].id);
          }        
        }).fail(function(err){
          console.log(err.statusText);
        });  
}

function borrarVideo(id_busqueda,id_video){  
  var video = {
    "id_busqueda": id_busqueda ,
    "id_video":  id_video
  }
  $.ajax({
    url: base_url + '/video/borrar/'+id_busqueda+'/'+id_video,
    method: "DELETE",
    data: {"video": JSON.stringify(video)}
  })
    .done(function( msg ) {
    }).fail(function(err){
      console.log(err.statusText);
    });  
}