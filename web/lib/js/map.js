var markers = [];
var map;
var latitude;
var longitude;
var intersecciones = [];
function loadDirecciones() {
 
   var query="http://localhost/eTraffic/web/app_dev.php/semaforo/json";
   $.getJSON(query, function(result){
        $.each(result, function(i, field){
            getCoordinate(field.primaria,field.calleSecundaria,i);
           
        });
    });
}

function initialize() {
 loadDirecciones();
  map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 14,
    center: {lat: -34.9200834, lng: -57.9564755}
  });

}


function addMarkerWithTimeout(position, timeout) {
  
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP
    }));
  }, timeout);
}


function getCoordinate(calle,avenida,indice){
    var coordinate= {lat: "", lng: ""};
    var query="http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address= calle "+avenida+" y calle "+calle+", La Plata";
    $.getJSON( query, function( data ) {
        coordinate.lng=data.results[0].geometry.location.lng;
        coordinate.lat=data.results[0].geometry.location.lat;
        addMarkerWithTimeout(coordinate, indice * 200);
    });
}