<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <br><div align="center"><a href="home.php" class="btn btn-large btn-primary">חזרה למסך הבית</a></div><br>
</head>
<body>
<br>
<?php
include ('hashing.php');
include('mongodb_connection.php');
$collection = connect_mongodb();

$search = array ();
$or_search1 = array();
$or_search2 = array();
$or_search3 = array();

// search = and_search && or_search1 && or_search2

// AND operation
if (!(empty($_POST["VendorMinGuests"])))  $search["VendorMinGuests"]  = array('$lte' => intval($_POST["VendorMinGuests"]));
if (!(empty($_POST["VendorMaxGuests"])))  $search["VendorMaxGuests"]  = array('$gte' => intval($_POST["VendorMaxGuests"]));

//if (!(empty($_POST["VendorLocation"])))   $search["VendorLocation"]   = $_POST["VendorLocation"];
if (!(empty($_POST["PriceRate"])))        $search["PriceRate"]        = $_POST["PriceRate"];

if (!(empty($_POST["IsKosher"])))         $search["Kosher"]           = $_POST["IsKosher"];
if (!(empty($_POST["IsTivoni"])))         $search["Tivoni"]           = $_POST["IsTivoni"];
if (!(empty($_POST["IsZtimhoni"])))       $search["Ztimhoni"]         = $_POST["IsZtimhoni"];
if (!(empty($_POST["HandicapsAccess"])))  $search["HandicapsAccess"]  = $_POST["HandicapsAccess"];
if (!(empty($_POST["Parking"])))          $search["Parking"]          = $_POST["Parking"];
if (!(empty($_POST["Winter"])))           $search["Winter"]           = $_POST["Winter"];
//if (!(empty($_POST["SpecialParams"])))    $search["SpecialParams"]    = $_POST["SpecialParams"];

// OR operation 1
if (isset($_POST["Gan"]))               array_push($or_search1, array("IsGan"        => true));
if (isset($_POST["Olam"]))              array_push($or_search1, array("IsOlam"       => true));
if (isset($_POST["Small"]))             array_push($or_search1, array("IsSmall"      => true));
if (isset($_POST["Pub"]))               array_push($or_search1, array("IsPub"        => true));
if (isset($_POST["Home"]))              array_push($or_search1, array("IsHome"       => true));
if (isset($_POST["Resturant"]))         array_push($or_search1, array("IsResturant"  => true));
if (isset($_POST["NatureProduction"]))  array_push($or_search1, array("IsNatureProd" => true));
if (isset($_POST["Historical"]))        array_push($or_search1, array("IsHistorical" => true));
if (isset($_POST["Sinigog"]))           array_push($or_search1, array("IsSinigog"    => true));
if (isset($_POST["Hotel"]))             array_push($or_search1, array("IsHotel"      => true));
if (isset($_POST["OpenGan"]))           array_push($or_search1, array("IsOpenGan"    => true));

// OR operation 2
if (isset($_POST["SleepOver"]))     array_push($or_search2, array("IsSleepOver"   => true));
if (isset($_POST["Hagasha"]))       array_push($or_search2, array("IsHagasha"     => true));
if (isset($_POST["Bofet"]))         array_push($or_search2, array("IsBofet"       => true));
if (isset($_POST["HupaOutside"]))   array_push($or_search2, array("IsHupaOutside" => true));
if (isset($_POST["HupaInside"]))    array_push($or_search2, array("IsHupaInside"  => true));
if (isset($_POST["Pool"]))          array_push($or_search2, array("IsPool"        => true));
if (isset($_POST["Nature"]))        array_push($or_search2, array("IsNature"      => true));
if (isset($_POST["PlaceOnly"]))     array_push($or_search2, array("PlaceOnly"     => true));

// OR operation 3
if (isset($_POST["north"]))              array_push($or_search3, array("VendorLocation"   => "north"));
if (isset($_POST["haifaAndKrayot"]))     array_push($or_search3, array("VendorLocation"   => "haifaAndKrayot"));
if (isset($_POST["sharon"]))             array_push($or_search3, array("VendorLocation"   => "sharon"));
if (isset($_POST["center"]))             array_push($or_search3, array("VendorLocation"   => "center"));
if (isset($_POST["Rashlaz"]))            array_push($or_search3, array("VendorLocation"   => "Rashlaz"));
if (isset($_POST["south"]))              array_push($or_search3, array("VendorLocation"   => "south"));
if (isset($_POST["jerusalem"]))          array_push($or_search3, array("VendorLocation"   => "jerusalem"));
if (isset($_POST["tlv"]))                array_push($or_search3, array("VendorLocation"   => "tlv"));

if (!(empty($or_search1))) $search['$or'] = $or_search1;
if (!(empty($or_search2))) $search['$or'] = $or_search2;
if (!(empty($or_search3))) $search['$or'] = $or_search3;

echo '<br/><br/>';

$cursor = $collection->find($search);
show_vendor_list($cursor);

?>
</body>
</html>
