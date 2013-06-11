
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=x-iso-8859-11">
        <title>probando test</title>
        <style type="text/css">
          html { height: 100%; }
          body { height: 100%; margin: 0px; padding: 0px }
          #map_canvas { height: 200px; width: 300px;margin-left: 150px; }
        </style>
        <script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=true"/>
</script>
    </head>
    <body>
        <h1>Mapa de google test</h1>
        <button id="test" style="margin-left: 500px;">Test</button>
        <br/>
        <div id="map_canvas"></div>
        
        <script type="text/javascript">
            window.onload = function(){
                app.maps.init('map_canvas',20.67597752738503 ,-103.36885380921808 ,17);
                jQuery('#test').on('click', function(evt){
                    console.log(app.maps.latitud);
                    console.log(app.maps.longitud);
                    console.log(app.maps.zoom);
                });
            }
        </script>
        <script src="<?php echo HOME; ?>assets/js/libs/jquery-1.8.2.min.js"></script>
        <script src="<?php echo HOME; ?>scripts/js/app.js"></script>
        


    </body>
</html>
