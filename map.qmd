<head>
  <meta charset="UTF-8">
  <title>Interactive Map</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
  <style>
    #map {
      height: 600px;
      width: 800px;
    }
  </style>
</head>
<body>
  <h1>Interactive Map</h1>
  <div id="map"></div>
  <div id="preview"></div>
  <script>
    var map = L.map('map').setView([37.6, -95.665], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    var place1 = L.marker([37.5, -95.665]).addTo(map);
    place1.bindPopup("<b>Place 1</b><br><img src='https://via.placeholder.com/300x200'>");
    
    var place2 = L.marker([37.7, -95.665]).addTo(map);
    place2.bindPopup("<b>Place 2</b><br><img src='https://via.placeholder.com/300x200'>");
  </script>
</body>
