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
    
    // Load existing places from the database
    var places = [];
    function loadPlaces() {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'load_places.php', true);
      xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          var response = JSON.parse(this.responseText);
          response.forEach(function(place) {
            var marker = L.marker([place.lat, place.lng]).addTo(map);
            marker.bindPopup("<b>" + place.title + "</b><br><img src='" + place.picture + "'><br>" + place.details);
            places.push({
              marker: marker,
              title: place.title,
              picture: place.picture,
              details: place.details,
              lat: place.lat,
              lng: place.lng
            });
          });
        }
      };
      xhr.send();
    }
    loadPlaces();
    
    // Add a new place from a JSON endpoint
    fetch('')
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        data.forEach(function(place) {
          var marker = L.marker([place.lat, place.lng]).addTo(map);
          marker.bindPopup("<b>" + place.title + "</b><br><img src='" + place.picture + "'><br>" + place.details);
          places.push({
            marker: marker,
            title: place.title,
            picture: place.picture,
            details: place.details,
            lat: place.lat,
            lng: place.lng
          });
        });
      });
  </script>
</body>

<?php
// Connect to the database
$mysqli = new mysqli("localhost", "username", "password", "database_name");

// Check for errors
if ($mysqli->connect_errno) {
  die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Get the place data from the request
$title = $_POST['title'];
$picture = $_POST['picture'];
$details = $_POST['details'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO places (title, picture, details, lat, lng) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssd", $title, $picture, $details, $lat, $lng);

// Execute the statement and check for errors
if (!$stmt->execute()) {
  die("Failed to add place: " . $stmt->error);
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();
?>

