<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php

include('mongodb_connection.php');
include('hashing.php');
$collection = connect_mongodb();

// Query DB collection vendors
$cursor = $collection->find(array("VendorName" => array('$ne' => null)));
$cursor->sort(array('VendorName' => 1));
$list = iterator_to_array($cursor);

//Vendors Table
echo '
<br><br>
<div class="container" id="vendors_table">
  <div class="panel panel-default">
    <div class="panel-heading" align="center">
      <div class="row">
        <h2><b>רשימת הספקים</b></h2><br>
      </div>
      <div class="row">
        <form action="vendor_search.php" method="post" enctype="multipart/form-data">
          <div class="col-sm-2" align="right">
            <button type="submit" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-search" aria-hidden="true">
              </span>
            </button>
          </div>
          <div class="col-sm-10" align="center">
            <input dir="rtl" type="text" class="form-control" name="VendorSearchName" placeholder="חיפוש לפי שם">
          </div>
        </form>
      </div>
      <br/>
      <div class="row">
        <div class="col-sm-6" align="center">
          <a href="/vendor_add.html"><button type="button" class="btn btn-success">הוספת ספק +</button></a>
        </div>
        <div class="col-sm-6" align="center">
          <a href="vendor_filter.php"><button type="button" class="btn btn-success">סינון מתקדם
          <span class="glyphicon glyphicon-filter" aria-hidden="true"></button></a>
        </div>
      </div>
    </div>
    <table class="table" style="direction: rtl;">
      <tr>
        <td><b>#</b></td>
        <td><b>שם המקום</b></td>
        <td><b>יש חוזה</b></td>
        <td><b>איזור</b></td>
        <td><b>שם איש קשר</b></td>
        <td><b>טלפון</b></td>
        <td><b>אימייל</b></td>
        <td><b>פרטים</b></td>
        <td><b>עריכה</b></td>
        <td><b>מחיקה</b></td>
      </tr>
';

$index = 0;
foreach($list as $prop => $value)
{
//prop is the unique id
  if ("" != $value['VendorName'])
  {
    $index++;
    $bg_color = ('yes' == $value['WorkingWithUs']) ? '>' : ' style="background-color:#f0f0f5">';
    echo '      <tr' . $bg_color;
    echo '        <td>' . $index . '</td>';
    echo '        <td>' . $value['VendorName'] . '</td>';
    echo '        <td>' . WorkingWithUsHash($value['WorkingWithUs']) . '</td>';
    echo '        <td>' . VendorAreaHash($value['VendorLocation']) . '</td>';
    echo '        <td>' . $value['ContactName'] . '</td>';
    echo '        <td>' . $value['ContactPhone'] . '</td>';
    echo '        <td>' . $value['ContactEmail'] . '</td>';
    echo '        <td> <a class="btn btn-info"    href="vendor_details.php?name='.$value['VendorName'].'" role="button">פרטים</a>';
    echo '        <td> <a class="btn btn-warning" href="vendor_edit.php?name='.$value['VendorName'].'" role="button">עריכה</a>';
    echo '        <td> <a class="btn btn-danger" href="vendor_del.php?name='.$value['VendorName'].'" role="button">מחיקה</a>';
    echo '      </tr>';
  }
}
echo '    </div>';
echo '  </div>';
echo '</div>';

?>

</body>
</html>
