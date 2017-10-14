<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/file_upload.css">
  <br><div align="center"><a href="/home.php" class="btn btn-large btn-primary">חזרה למסך הבית</a></div><br>
</head>
</body>

<?php
include('hashing.php');
include('mongodb_connection.php');
$collection = connect_mongodb();

$vendor = $collection->findOne(array('VendorName' => $_GET["name"]));

echo '
<div class="container" id="vendor_images">
  <div class="panel panel-primary">
    <div class="panel-heading" align="center" dir="rtl">' . $vendor["VendorName"] . '</div>
    <div class="panel-body" align="center">
      <div class="row">
        <div class="col-sm-12">
          <img src="' . $vendor["ImgLogo"] . '" alt="ImgLogo" width="140" class="img-rounded">
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <a href="/pricing_add.php/?name='. $vendor["VendorName"] . '" class="btn btn-success" role="button">$מחירים$</a>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading" align="center" dir="rtl"><strong>פרטים טכניים</strong></div>
            <div class="panel-body">
              <table class="table table-bordered" dir="rtl" align="right">
                <tr>
                  <td>מינימום מוזמנים</td>
                  <td> ' . $vendor["VendorMinGuests"] . ' </td>
                </tr>
                <tr>
                  <td>מכסימום מוזמנים</td>
                  <td> ' . $vendor["VendorMaxGuests"] . ' </td>
                </tr>
                <tr>
                <tr>
                  <td>טווח מחיר</td>
                  <td> ' . PriceRangeHash($vendor["PriceRate"]) . ' </td>
                </tr>
                <tr>
                  <td>איזור</td>
                  <td> ' . VendorAreaHash($vendor["VendorLocation"]) . ' </td>
                </tr>
                <tr>
                  <td>כתובת מדוייקת</td>
                  <td> ' . $vendor["VendorAddress"] . ' </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading" align="center" dir="rtl"><strong>איש קשר</strong></div>
            <div class="panel-body">
              <table class="table table-bordered" dir="rtl" align="right">
                <tr>
                  <td>עובדים איתנו?</td>
                  <td>' . WorkingWithUsHash($vendor["WorkingWithUs"])    . '</td>
                </tr>
                <tr>
                  <td>שם</td>
                  <td>' . $vendor["ContactName"]    . '</td>
                </tr>
                <tr>
                  <td>טלפון</td>
                  <td>' . $vendor["ContactPhone"]    . '</td>
                </tr>
                <tr>
                  <td>טלפון 2</td>
                  <td>' . $vendor["ContactPhone2"]    . '</td>
                </tr>
                <tr>
                  <td>אימייל</td>
                  <td>' . $vendor["ContactEmail"]    . '</td>
                </tr>
                <tr>
                  <td>הערות</td>
                  <td>' . $vendor["ContactComments"]    . '</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading" align="center" dir="rtl"><strong>איפיון המקום</strong></div>
            <div class="panel-body">
              <table class="table table-bordered" dir="rtl" align="right">
                <tr>
                  <td>סוג המקום</td>
                  <td>' . VendorKindHash($vendor) .'</td>
                </tr>
                <tr>
                  <td>פיצרים</td>
                  <td>' . VendorFeaturesHash($vendor) .'</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading" align="center" dir="rtl"><strong>נוספים</strong></div>
            <div class="panel-body">
              <table class="table table-bordered" dir="rtl" align="right">
                <tr>
                  <td>כשרות</td>
                  <td>' . VendorKosherHash($vendor["Kosher"]) .'</td>
                </tr>
                <tr>
                  <td>טבעונות</td>
                  <td>' . VendorTivoniHash($vendor["Tivoni"]) .'</td>
                </tr>
                <tr>
                  <td>צמחונות</td>
                  <td>' . VendorVegHash($vendor["Ztimhoni"]) .'</td>
                </tr>
                <tr>
                  <td>גישה לנכים</td>
                  <td>' . VendorNechimHash($vendor["HandicapsAccess"]) .'</td>
                </tr>
                <tr>
                  <td>חניה</td>
                  <td>' . VendorParkingHash($vendor["Parking"]) .'</td>
                </tr>
                <tr>
                  <td>חורף</td>
                  <td>' . VendorWinterHash($vendor["Winter"]) .'</td>
                </tr>
                <tr>
                  <td>חורף</td>
                  <td>' . VendorWinterCoverHash($vendor["WinterCover"]) .'</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading" align="center" dir="rtl"><strong>תיאור של המקום</strong></div>
            <div class="panel-body">
              ' . $vendor["FreeText"] . '
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6" align="center">
          ' . LinkHandler($vendor["FacebookLink"], 'Facebook') . '
        </div>
        <div class="col-sm-6" align="center">
          ' . LinkHandler($vendor["WebsiteLink"], 'קישור לאתר') . '
        </div>
      </div>
      <hr>
      <div class="panel panel-default">
        <div class="panel-heading" align="center" dir="rtl"><strong>תמונות חופה</strong></div>
        <div class="panel-body">
        ' . DisplayImgs($vendor, 'ImgHupa') . '
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" align="center" dir="rtl"><strong>סידורי ישיבה</strong></div>
        <div class="panel-body">
        ' . DisplayImgs($vendor, 'ImgTables') . '
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" align="center" dir="rtl"><strong>קירוי חורף</strong></div>
        <div class="panel-body">
        ' . DisplayImgs($vendor, 'ImgWinter') . '
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" align="center" dir="rtl"><strong>קבלת פנים</strong></div>
        <div class="panel-body">
        ' . DisplayImgs($vendor, 'ImgReception') . '
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" align="center" dir="rtl"><strong>תמונות נוספות</strong></div>
        <div class="panel-body">
        ' . DisplayImgs($vendor, 'ImgOthers') . '
        </div>
      </div>
    </div>
  </div>
</div>
';
echo '<div class="col-sm-12" align="center">
        <a href="/home.php" class="btn btn-primary btn-lg active" role="button">חזרה לרשימת הספקים</a>
      </div><br/>';
?>

</body>
</html>
