<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>GPS</title>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
    
    var marker; // Variavel global para o marcador
  
    function initMap() {
    // Criando o mapa com a localizacao atual do banco de dados
    $.ajax({
      url: 'db_query.php',
      type: 'POST',
      dataType: 'json',
      success: function (result) {
        var latitude = result.lat;
        var longitude = result.lng;
        var localizacao = new google.maps.LatLng(latitude, longitude);
  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: localizacao,
          heading: 89,
          mapId: "90f87356969d889c",
        });
  
        // Criando o DT1 como icone do marcador de localizacao
        var icon = {
          url: 'DT1.png',
          scaledSize: new google.maps.Size(50, 50),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(25, 25)
        };
  
        // Criando um marcador para a localizacao
        marker = new google.maps.Marker({
          position: localizacao,
          map: map,
          icon: icon, 
          title: 'DT2'
        });
      },
    });
  
    // Atualizando a posição do marcador sempre que uma nova localização for inserida no banco de dados
    setInterval(function() {
      $.ajax({
        url: 'db_query.php',
        type: 'POST',
        dataType: 'json',
        success: function (result) {
          var latitude = result.lat;
          var longitude = result.lng;
          var localizacao = new google.maps.LatLng(latitude, longitude);
  
          marker.setPosition(localizacao); // Atualizando a posição do marcador no mapa
        },
      });
    }, 1000); // Definindo um intervalo de 1 segundo para buscar as novas localizações
    }

    window.initMap = initMap;
    </script>
    <?php require "api_key.txt"; ?>
    
  </body>
</html>