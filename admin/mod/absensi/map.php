<?php 
$error = array();
	if (empty($_GET['latitude'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $latitude = $_GET['latitude'];
  	}

  	if (empty($_GET['longitude'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $longitude = $_GET['longitude'];
  	}

  	if (empty($_GET['name'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $name = $_GET['name'];
  	}

  if (empty($error)) { 
echo'
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Map</title>
		<link rel="stylesheet" href="../../assets/plugins/leatfet/leaflet.css">
    <script src="../../assets/plugins/leatfet/leaflet.js"></script>
	</head>
	<body>
		<div id="peta" style="height:500px; width: 100%"></div>';?>
  	<script type="text/javascript">
  		var mymap = L.map('peta').setView([<?php echo $latitude;?>, <?php echo $longitude;?>], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaW5hYXJpczI3IiwiYSI6ImNscmhhNWN0MDBsYmsya21qMDRzOWIwd24ifQ.jfOKBs-dGTm06Hktxfbk3Q', {
              maxZoom: 20,
              attribution:'',
              id: 'mapbox/streets-v11',
              tileSize: 512,
              zoomOffset:-1,
              accessToken: 'pk.eyJ1IjoiaW5hYXJpczI3IiwiYSI6ImNscmhhNWN0MDBsYmsya21qMDRzOWIwd24ifQ.jfOKBs-dGTm06Hktxfbk3Q'
            }).addTo(mymap);
          L.marker([<?php echo $latitude;?>, <?php echo $longitude;?>]).addTo(mymap);
          L.circle([<?php echo $latitude;?>, <?php echo $longitude;?>], 550, {
  		color: 'red',
  		fillColor: '#f03',
  		fillOpacity: 0.5
  		}).addTo(mymap).bindPopup("<?php echo $name;?>").openPopup();
          var popup = L.popup();
          function onMapClick(e) {
  		popup
  			.setLatLng(e.latlng)
  			.setContent(""+ e.latlng.toString())
  			.openOn(mymap);
  		}
  		mymap.on('click', onMapClick);
    </script>

	</body>	
</html>
<?PHP }else{
	echo'Data tidak ditemukan';
}?>