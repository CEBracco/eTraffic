//key= AIzaSyDG94jyox5HGY9k-ajWQdzJsePe81moRhY
function mostrar(){
 
  addMarker();
};
function getCoordinate(avenida,calle){
    var coordinate= {lat: "", lng: ""};
  
       
        addMarker();
        
  
}
function obtainGeolocation(){
 window.navigator.geolocation.getCurrentPosition(localitation);
}
var latitude;
var longitude;
var map;
// Utilizamos el objeto Navigator para obtener la Latitud y la Longitud
function obtainGeolocation(){
 window.navigator.geolocation.getCurrentPosition(localitation);
 }

function addMarker(){

    var latlngs = new google.maps.LatLng(-34.9363423132521,-57.97224120643773);
    var marker = new google.maps.Marker({
    position: latlngs,
    map: map,
    title: "lala"
    });
    
}
// Aqui Desarrollamos toda la magia
 function localitation(geo){
 // obtenemos y guardamos la latitud y longitud 
 var latitude = geo.coords.latitude;
 var longitude = geo.coords.longitude;
 // las variables las colocamos en la instancia del objeto de google maps
 var latlng = new google.maps.LatLng(latitude,longitude);
 // y configuramos las opciones del maps 
     var myOptions = {
          center: latlng,
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
     // Decimos donde vamos a colocar el maps
         map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
       // Inistancia para le marker
        var marker = new google.maps.Marker({
            position: latlng, 
            map: map, 
            title:"Estamos aqui!"
        });
 }
 //llamando la funcion inicial para ver trabajar la API


function initialize() {
   obtainGeolocation();   
}