<!DOCTYPE html>

<html dir="rtl">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="initial-scale=1.0">
  <title>מפת גני האירועים של Wedit</title>
  <!-- <script src="http://maps.google.com/maps/api/js?sensor=false"
          type="text/javascript"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=he&key=AIzaSyDUAF0CJe3S6p9Rn2fF6ZeCy8AP0xnQZms"
      async defer></script> -->

</head>
<body>
<p id="js_consule"></p>
<?php
include('mongodb_connection.php');
include('hashing.php');
$collection = connect_mongodb();
$cursor = $collection->find(array("VendorName" => array('$ne' => null)));
$cursor->sort(array('VendorName' => 1));
$list = iterator_to_array($cursor);
$i=0;

foreach($list as $prop => $value)
{
//prop is the unique id
  $vendor_name = $value['VendorName'];
  if (!empty($value['GeoAddress']))
  // if (0)
  {
    $add_arr[] = $arrayName = array(
      'VendorName'  => $vendor_name,
      'GeoAddress'  => $value['GeoAddress']
    );
  } else {
    $geo = geocode($value['VendorAddress']);
    if ($geo)
    {
      $add_arr[] = $arrayName = array(
        'VendorName'              => $vendor_name,
        'GeoAddress'              => $geo
      );
      $collection->update(array('VendorName' => $vendor_name), array('$set' => array ('GeoAddress' => $geo)));
    } else {
      echo 'Error! Address for: ' . $value['VendorName'] . '; Is: ' . $value['VendorAddress'] . '<br>';
    }
  }
  $i++;
  if (1000<$i) break; //Protection
}

// var_dump($add_arr);

function geo_list ($add_arr)
{
  $j=1;
  $str='';
  $loc_arr = array();
  foreach($add_arr as $prop => $value)
  {
     if (($value['VendorAddressLatitude']) && ($value['VendorAddressLongitude']))
    //if(0)
    {
      echo 'Entered to we have lat-logn if statement <br>';
      $latitude   = $value['VendorAddressLatitude'];
      $longitude  = $value['VendorAddressLongitude'];
    }
    else if ($value['GeoAddress'])
    {
      $latitude = $value['GeoAddress'][0];
      $longitude = $value['GeoAddress'][1];
      $name = $value['VendorName'];
      //$str = $str . "['" . $name . "'," .  $latitude . ',' . $longitude . ',' . $j . '],';
      array_push($loc_arr,array($name, $latitude, $longitude, $j));

      // TODO: Update the DB for the new Lat-Lon !!!
    } else {
      echo 'כתובת חסרה או שגויה לגן אירועים: ' . $value['VendorName'] . '<br>';
      // coninue;
    }
    $j++;
    if ($j>1000) break; //Protection
  }
  return $loc_arr;
}

$loc_arr = (geo_list ($add_arr));

?>

  <div id="map" style="width: 1500px; height: 800px;"></div>


  <script>
    function initMap() {
      // List of all venues with address - makes an JS array from the PHP results
      var locations = (<?php echo ($str); ?>);

      var locations = new Array();
      <?php foreach($schd_arr as $key => $val){ ?>
          locations.push('<?php echo $val; ?>');
      <?php } ?>

      var myLatLng = {lat: 32.07, lng: 34.82};

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var infowindow = new google.maps.InfoWindow();

      var marker, i;
      var test = locations.length
      window.alert(test.toString());

      for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(
            locations[i][1], locations[i][2]
          ),
          map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i, infowindow) {
          return function() {
            infowindow.setContent('<a target="_blank" href="/vendor_details.php/?name=' +
            locations[i][0] + '">' + locations[i][0] + '</a>');
            infowindow.open(map, marker);
          }
        })(marker, i, infowindow));
      }
    }
  </script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_Mle-6dMTO0ZFrYsGnLRl3v4Y8uXkN8&callback=initMap"
  type="text/javascript"></script>

<?php
  // function to geocode address, it will return false if unable to geocode address
  function geocode($address){

    // url encode the address
    $address = urlencode($address);

    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";

    // get the json response
    $resp_json = file_get_contents($url);

    // decode the json
    $resp = json_decode($resp_json, true);

    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){

      // get the important data
      $lati = $resp['results'][0]['geometry']['location']['lat'];
      $longi = $resp['results'][0]['geometry']['location']['lng'];
      $formatted_address = $resp['results'][0]['formatted_address'];

      // verify if data is complete
      if($lati && $longi && $formatted_address){

        // put the data in the array
        $data_arr = array();

        array_push(
          $data_arr,
            $lati,
            $longi,
            $formatted_address
          );

        return $data_arr;

      }else{
        return false;
      }

    }else{
      return false;
    }
  }
?>

</body>
</html>
