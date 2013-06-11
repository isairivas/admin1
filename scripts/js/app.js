var app = {
    maps:{},
    banners:{},
    eventos:{}
};

app.confirm = function(url){
    
    $.msgbox("Esta seguro de eliminar el registro permanentemente?", {
            type: "confirm",
            buttons : [
                    {type: "submit", value: "Si"},
                    {type: "submit", value: "No"},
                    {type: "cancel", value: "Cancelar"}
            ]
            }, function(result) {
                if(result == 'Si'){
                    window.location = url;
                } else {
                    return false;
                }
            }
    );
    return false;
}

app.maps.init = function (mapCanvas,latitud,longitud,zoom){
    app.maps.lat = 20.67773413481264;
    app.maps.lng = -103.3682100790545 ;
    app.maps.map = null;
    app.maps.marker = null;
    app.maps.zoom = 12;
    app.maps.latitud = app.maps.lat;
    app.maps.longitud = app.maps.lng;
    
    if(latitud != null){
        app.maps.lat = latitud;
    }
    if(longitud != null)
        app.maps.lng = longitud;
    if(zoom != null)
        app.maps.zoom = zoom;
    
    
    latLng = new google.maps.LatLng(app.maps.lat, app.maps.lng);
    
    var myOptions = {
        zoom: app.maps.zoom,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    app.maps.map = new google.maps.Map(document.getElementById(mapCanvas),
        myOptions);
                
    app.maps.marker = new google.maps.Marker({
        map: app.maps.map,//el mapa creado en el paso anterior
        position: latLng,//objeto con latitud y longitud
        draggable: true //que el marcador se pueda arrastrar
    });
                
    app.maps.updatePosition(latLng);
                
    google.maps.event.addListener(app.maps.marker, 'dragend', function(){
        app.maps.updatePosition(app.maps.marker.getPosition());
    })
                
}

app.maps.updatePosition = function(latLng)
  {
      app.maps.latitud = latLng.lat();
      app.maps.longitud = latLng.lng();
      app.maps.zoom = app.maps.map.getZoom();
  }
  
  app.banners.index = function(url){
      jQuery('#filtroTipo').on('change',function(){
          var filtro = '';
          switch(jQuery('#filtroTipo').val()){
              case 'A':
                  filtro = '&filtro='+jQuery('#filtroTipo').val();
                  break;
              case 'B':
                  filtro = '&filtro='+jQuery('#filtroTipo').val();
                  break;
              case 'C':
                  filtro = '&filtro='+jQuery('#filtroTipo').val();
                  break;
              case 'D':
                  filtro = '&filtro='+jQuery('#filtroTipo').val();
                  break;
          }
          
          window.location = url+filtro;
      });
  }
  app.etiquetas = {
      filtroCategoria:function(url){
          jQuery('#filtroCategoria').on('change',function(){
          var filtro = '&categoria='+jQuery('#filtroCategoria').val();
          if( jQuery('#filtroCategoria').val() == -1 ){
              filtro = '';
          }
          
          window.location = url+filtro;
      
      });
  }
  }
  
app.eventos.init = function(url){
    jQuery('#btn-filtro').on('click',function(){
         var filtro = jQuery('#filtro-mes').val();
         var error = true;
         var mes = '';
         var year = '';
         if(filtro != ''){
             var arrFiltros = filtro.split(' ');
             mes = arrFiltros[0];
             year = arrFiltros[1];
             if( mes != '' && year != '' ){
                 error = false;
             }
         }
        
        if(!error){
            window.location = url+'&year='+year+'&mes='+mes;
        }
    });
}
 
