<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/file_upload.css">
  <link rel="stylesheet" href="css/on-off-2.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <br><div align="center"><a href="home.php" class="btn btn-large btn-primary">חזרה למסך הבית</a></div><br>
</head>
<body>

<?php
include ('hashing.php');
include('mongodb_connection.php');
$collection = connect_mongodb();
$vendor = $collection->findOne(array('VendorName' => $_GET["name"]));
?>

<form action="vendor_add.php" method="post" enctype="multipart/form-data">

  <div class="container" id="vendor_name">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" dir="rtl">גן האירועים</div>
      <div class="panel-body">
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" id="Staging" <?php if ($vendor["Staging"]) echo " checked ";?> name="Staging" style="float: right;">Staging
          </label>
        </div>
        <div class="col-sm-4">
          <select name="WorkingWithUs" class="form-control" style="width: 250px;" required>
            <option <?php if ("empty"   == $vendor["WorkingWithUs"]) echo " selected ";?>value="empty" disabled>האם עובדים איתנו</option>
            <option <?php if ("yes"     == $vendor["WorkingWithUs"]) echo " selected ";?>value="yes">כן</option>
            <option <?php if ("no"      == $vendor["WorkingWithUs"]) echo " selected ";?>value="no">לא</option>
            <option <?php if ("pending" == $vendor["WorkingWithUs"]) echo " selected ";?>value="pending">טרם</option>
          </select>
        </div>
        <div class="col-sm-6">
          <input dir="rtl" type="text" class="form-control" id="VendorName" name="VendorName"
            required title="נא למלא את השדה הזה בבקשה" value="<?php echo ($vendor["VendorName"]); ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="vendor_contact_details">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" dir="rtl">איש קשר</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
              <p dir="rtl"><label for="VendorContactPhone2"> טלפון נוסף:</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorContactPhone2" value="<?php echo ($vendor["ContactPhone2"]); ?>">
          </div>
          <div class="col-sm-3">
              <p dir="rtl"><label for="VendorContactPhone"> טלפון:</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorContactPhone"  value="<?php echo ($vendor["ContactPhone"]); ?>">
          </div>
          <div class="col-sm-3">
              <p dir="rtl"><label for="VendorContactEmail"> אימייל:</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorContactEmail"  value="<?php echo ($vendor["ContactEmail"]); ?>">
          </div>
          <div class="col-sm-3">
              <p dir="rtl"><label for="VendorContactName"> שם איש הקשר:</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorContactName"  value="<?php echo ($vendor["ContactName"]); ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            <textarea class="form-control" rows="3" dir="rtl" name="VendorContactComments"> <?php echo ($vendor["ContactComments"]); ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="vendor_details">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" dir="rtl">מאפיינים בסיסיים</div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group">
            <div class="col-sm-3" align="center">
              <p dir="rtl" align="center"><label for="VendorArea">איזור: </label></p>
              <select name="VendorLocation" class="form-control" style="width: 250px;">
                <option <?php if ("empty"             == $vendor["VendorLocation"]) echo " selected ";?>value="empty">איזור</option>
                <option <?php if ("north"             == $vendor["VendorLocation"]) echo " selected ";?>value="north">צפון</option>
                <option <?php if ("haifaAndKrayot"    == $vendor["VendorLocation"]) echo " selected ";?>value="haifaAndKrayot">חיפה והקריות</option>
                <option <?php if ("sharon"            == $vendor["VendorLocation"]) echo " selected ";?>value="sharon">שרון</option>
                <option <?php if ("center"            == $vendor["VendorLocation"]) echo " selected ";?>value="center">מרכז</option>
                <option <?php if ("Rashlaz"           == $vendor["VendorLocation"]) echo " selected ";?>value="Rashlaz">רשלצ-גדרה</option>
                <option <?php if ("south"             == $vendor["VendorLocation"]) echo " selected ";?>value="south">דרום</option>
                <option <?php if ("jerusalem"         == $vendor["VendorLocation"]) echo " selected ";?>value="jerusalem">ירושלים</option>
                <option <?php if ("tlv"               == $vendor["VendorLocation"]) echo " selected ";?>value="tlv">תל אביב</option>
              </select>
            </div>
            <div class="col-sm-3" align="center">
              <p dir="rtl"><label for="VendorAddress">Latitude</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorAddressLatitude" value="<?php echo ($vendor["VendorAddressLatitude"]); ?>">
            </div>
            <div class="col-sm-3" align="center">
              <p dir="rtl"><label for="VendorAddress">Longitude</label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorAddressLongitude" value="<?php echo ($vendor["VendorAddressLongitude"]); ?>">
            </div>
            <div class="col-sm-3" align="right">
              <p dir="rtl"><label for="VendorAddress">כתובת מדוייקת: </label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorAddress" value="<?php echo ($vendor["VendorAddress"]); ?>">
            </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-3" align="center">
            <p dir="rtl" align="center"><label for="VendorPriceRange">טווח מחיר: </label></p>
            <select name="PriceRate" class="form-control" style="width: 250px;">
              <option <?php if ("empty" == $vendor["PriceRate"]) echo " selected ";?>value="empty">טווח מחיר</option>
              <option <?php if ("one"   == $vendor["PriceRate"]) echo " selected ";?>value="one">$</option>
              <option <?php if ("two"   == $vendor["PriceRate"]) echo " selected ";?>value="two">$$</option>
              <option <?php if ("three" == $vendor["PriceRate"]) echo " selected ";?>value="three">$$$</option>
              <option <?php if ("four"  == $vendor["PriceRate"]) echo " selected ";?>value="four">$$$$</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
          </div>
          <div class="col-sm-3" style="direction: rtl;">
              <p dir="rtl"><label for="VendorMaxGuests">מכסימום מוזמנים: </label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorMaxGuests" value="<?php echo ($vendor["VendorMaxGuests"]); ?>">
          </div>
          <div class="col-sm-3" style="direction: rtl;">
              <p dir="rtl"><label for="VendorMinGuests">מינימום מוזמנים: </label></p>
              <input dir="rtl" type="text" class="form-control" name="VendorMinGuests" value="<?php echo ($vendor["VendorMinGuests"]); ?>">
          </div>
        </div>
      </div>
      <hr>
      <div class="row" style="direction: rtl;">
        <h5 dir="rtl" align="center"><label for="VendorKind"><u>סיווג המקום (בחירה מרובה): </u></label></h5>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsGan"]) echo " checked ";?> id="Gan" name="Gan" style="float: right;">  גן אירועים
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsOlam"]) echo " checked ";?> id="Olam" name="Olam" style="float: right;">  אולם
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsSmall"]) echo " checked ";?> id="Small" name="Small" style="float: right;">א. קטנים
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsPub"]) echo " checked ";?> id="Pub" name="Pub" style="float: right;">פאב
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsHome"]) echo " checked ";?> id="Home" name="Home" style="float: right;">בית
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsResturant"]) echo " checked ";?> id="Resturant" name="Resturant" style="float: right;">מסעדה
          </label>
        </div>
      </div>
      <div class="row" style="direction: rtl;">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsOpenGan"]) echo " checked ";?> id="OpenGan" name="OpenGan" style="float: right;">גן אירועים פתוח
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsNatureProd"]) echo " checked ";?> id="NatureProduction" name="NatureProduction" style="float: right;">הפקה בטבע
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsHistorical"]) echo " checked ";?> id="Historical" name="Historical" style="float: right;">אתר היסטורי
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsSinigog"]) echo " checked ";?> id="Sinigog" name="Sinigog" style="float: right;">בית כנסת
          </label>
        </div>
        <div class="col-sm-2">
          <label align="right">
            <input type="checkbox" <?php if ($vendor["IsHotel"]) echo " checked ";?> id="Hotel" name="Hotel" style="float: right;">מלון
          </label>
        </div>
      </div>
      <hr>
      <div class="row" style="direction: rtl;">
        <div class="col-sm-2" align="center">
          <!-- spacing -->
        </div>
        <div class="col-sm-1" align="center">
          לינה במקום
          <br>
          <div class="switch">
            <input id="SleepOver" name="SleepOver" <?php if ($vendor["IsSleepOver"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="SleepOver"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          הגשה
          <br>
          <div class="switch">
            <input id="Hagasha" name="Hagasha" <?php if ($vendor["IsHagasha"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="Hagasha"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          בופה
          <br>
          <div class="switch">
            <input id="Bofet" name="Bofet" <?php if ($vendor["IsBofet"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="Bofet"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          חופה בחוץ
          <br>
          <div class="switch">
            <input id="HupaOutside" name="HupaOutside" <?php if ($vendor["IsHupaOutside"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="HupaOutside"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          חופה בפנים
          <br>
          <div class="switch">
            <input id="HupaInside" name="HupaInside" <?php if ($vendor["IsHupaInside"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="HupaInside"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          בריכה
          <br>
          <div class="switch">
            <input id="Pool" name="Pool" <?php if ($vendor["IsPool"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="Pool"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          ליד הים
          <br>
          <div class="switch">
            <input id="NearSea" name="NearSea" <?php if ($vendor["IsNearSea"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="NearSea"></label>
          </div>
        </div>
        <div class="col-sm-1" align="center">
          בטבע
          <br>
          <div class="switch">
            <input id="Nature" name="Nature" <?php if ($vendor["IsNature"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="Nature"></label>
          </div>
        </div>
        <div class="col-sm-2" align="center">
          השכרת מקום
          <br>
          <div class="switch">
            <input id="PlaceOnly" name="PlaceOnly" <?php if ($vendor["PlaceOnly"]) echo " checked ";?> class="cmn-toggle cmn-toggle-round" type="checkbox">
            <label for="PlaceOnly"></label>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Kosher">כשרות</label></p>
            <select name="IsKosher" class="form-control" style="width: 150px;">
              <option <?php if ("Kosher" == $vendor["Kosher"])      echo " selected ";?> value="Kosher">כשר</option>
              <option <?php if ("Kosher" == $vendor["NonKosher"])   echo " selected ";?> value="NonKosher">לא כשר</option>
              <option <?php if ("Kosher" == $vendor["SemiKosher"])  echo " selected ";?> value="SemiKosher">יש מתחם לא כשר</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Tivoni">טבעונות</label></p>
            <select name="IsTivoni" class="form-control" style="width: 150px;">
              <option <?php if ("SomeTivoni" == $vendor["Tivoni"])    echo " selected ";?> value="SomeTivoni">יש מנות טבעוניות</option>
              <option <?php if ("NonTivoni" == $vendor["Tivoni"])     echo " selected ";?> value="NonTivoni">אין אפשרות לטבעוני מלא</option>
              <option <?php if ("Option2Tivoni" == $vendor["Tivoni"]) echo " selected ";?> value="Option2Tivoni">אפשרות לטבעוני מלא</option>
              <option <?php if ("OnlyTivoni" == $vendor["Tivoni"])    echo " selected ";?> value="OnlyTivoni">רק טבעוני</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Ztimhoni">צמחונות</label></p>
            <select name="IsZtimhoni" class="form-control" style="width: 150px;">
              <option <?php if ("SomeZtimhoni" == $vendor["Ztimhoni"])    echo " selected ";?> value="SomeZtimhoni">יש מנות צמחוניות</option>
              <option <?php if ("NonZtimhoni" == $vendor["Ztimhoni"])     echo " selected ";?> value="NonZtimhoni">אין אפשרות לצמחוני מלא</option>
              <option <?php if ("Option2Ztimhoni" == $vendor["Ztimhoni"]) echo " selected ";?> value="Option2Ztimhoni">אפשרות לצמחוני מלא</option>
              <option <?php if ("OnlyZtimhoni" == $vendor["Ztimhoni"])    echo " selected ";?> value="OnlyZtimhoni">רק צמחוני</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Handicaps">גישה לנכים</label></p>
            <select name="HandicapsAccess" class="form-control" style="width: 150px;">
              <option <?php if ("FullAccess" == $vendor["HandicapsAccess"])    echo " selected ";?> value="FullAccess">גישה מלאה</option>
              <option <?php if ("PartAccess" == $vendor["HandicapsAccess"])    echo " selected ";?> value="PartAccess">גישה חלקית</option>
              <option <?php if ("ZeroAccess" == $vendor["HandicapsAccess"])    echo " selected ";?> value="ZeroAccess">אין גישה</option>
            </select>
          </div>
        </div>
      </div>
      </br>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-3" align="center">
            <!-- Spacing -->
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Parking">חניה</label></p>
            <select name="Parking" class="form-control" style="width: 150px;">
              <option <?php if ("LocalParking"  == $vendor["Parking"]) echo " selected ";?> value="LocalParking">של המקום</option>
              <option <?php if ("InTheArea"     == $vendor["Parking"]) echo " selected ";?> value="InTheArea">יש באיזור</option>
              <option <?php if ("Paid"          == $vendor["Parking"]) echo " selected ";?> value="Paid">בתשלום</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="WinterCover">קירוי חורף</label></p>
            <select name="WinterCover" class="form-control" style="width: 150px;">
              <option <?php if ("NonRelevant"   == $vendor["WinterCover"]) echo " selected ";?> value="NonRelevant">לא רלוונטי</option>
              <option <?php if ("Cover"         == $vendor["WinterCover"]) echo " selected ";?> value="Cover">קירוי חורף</option>
              <option <?php if ("Building"      == $vendor["WinterCover"]) echo " selected ";?> value="Building">מבנה סגור</option>
            </select>
          </div>
          <div class="col-sm-3" align="center">
            <p dir="rtl"><label for="Winter">חורף</label></p>
            <select name="Winter" class="form-control" style="width: 150px;">
              <option <?php if ("Active"    == $vendor["Winter"]) echo " selected ";?> value="Active">פעיל</option>
              <option <?php if ("NonActive" == $vendor["Winter"]) echo " selected ";?> value="NonActive">לא פעיל</option>
            </select>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12" align="right">
          <p dir="rtl"><label for="Winter">תיאור של המקום:</label></p>
          <textarea class="form-control" rows="6" dir="rtl" name="VendorFreeText"><?php echo ($vendor["FreeText"]); ?></textarea>
        </div>
      </div>
      <hr>
      <div class="row" style="direction: rtl;">
        <div class="col-sm-6" align="right">
          <p dir="rtl"><label for="VendorFacebookLink">קישור לפייסבוק: </label></p>
          <input dir="rtl" type="text" class="form-control" name="VendorFacebookLink" value="<?php echo ($vendor["FacebookLink"]); ?>">
        </div>
        <div class="col-sm-6" align="right">
          <p dir="rtl"><label for="VendorWebsiteLink">קישור לאתר: </label></p>
          <input dir="rtl" type="text" class="form-control" name="VendorWebsiteLink" value="<?php echo ($vendor["WebsiteLink"]); ?>">
        </div>
      </div>
      <hr>
      <br>
    </div>
  </div>
  <br>
  <center><button type="submit" class="btn btn-primary btn-lg" name="submit" onsubmit="validate_data();">
    <span class="glyphicon glyphicon-send" aria-hidden="true"></span> יאללה, סיימתי
  </button></center>
</form>

</body>
</html>
