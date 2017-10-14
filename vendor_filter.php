<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/on-off-2.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <br><div align="center"><a href="home.php" class="btn btn-large btn-primary">חזרה למסך הבית</a></div><br>
</head>
<body>
  <br>
  <form action="vendor_filter_res.php" method="post" enctype="multipart/form-data">
    <div class="container" id="vendor_name">
      <div class="panel panel-primary">
        <div class="panel-heading" align="center" dir="rtl">גן אירועים - חיפוש מתקדם</div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group">
              <div class="col-sm-6" align="center">
                <p dir="rtl" align="center"><label for="VendorPriceRange">טווח מחיר: </label></p>
                <select name="PriceRate" style="width: 250px;">
                  <option disabled selected>טווח מחיר</option>
                  <option value="one">$</option>
                  <option value="two">$$</option>
                  <option value="three">$$$</option>
                  <option value="four">$$$$</option>
                </select>
              </div>
              <div class="col-sm-6" align="center">
                <p dir="rtl" align="center"><label for="VendorArea">האם עובדים איתנו?</label></p>
                <select name="WorkingWithUs" style="width: 250px;" required>
                  <option value="empty" disabled selected="selected">האם עובדים איתנו</option>
                  <option value="yes">כן</option>
                  <option value="no">לא</option>
                  <option value="pending">טרם</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row" style="direction: rtl;">
            <h5 dir="rtl" align="center"><label for="VendorKind"><u>איזור (בחירה מרובה):</u></label></h5>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="north" name="north" style="float: right;"> צפון
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="haifaAndKrayot" name="haifaAndKrayot" style="float: right;"> חיפה והקריות
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="sharon" name="sharon" style="float: right;"> שרון
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="center" name="center" style="float: right;"> מרכז
              </label>
            </div>  
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="Rashlaz" name="Rashlaz" style="float: right;"> רשלצ-גדרה
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="south" name="south" style="float: right;"> דרום
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="jerusalem" name="jerusalem" style="float: right;"> ירושלים
              </label>
            </div>
            <div class="col-sm-3">
              <label align="right">
                <input type="checkbox" id="tlv" name="tlv" style="float: right;">תל אביב
              </label>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-6" align="center" style="direction: rtl;">
                <p dir="rtl"><label for="VendorMaxGuests">מכסימום מוזמנים: </label></p>
                <input dir="rtl" type="text" class="form-control" name="VendorMaxGuests" placeholder="מכסימום מוזמנים">
            </div>
            <div class="col-sm-6" align="center" style="direction: rtl;">
                <p dir="rtl"><label for="VendorMinGuests">מינימום מוזמנים: </label></p>
                <input dir="rtl" type="text" class="form-control" name="VendorMinGuests" placeholder="מינימום מוזמנים">
            </div>
          </div>
          <hr>
          <div class="row" style="direction: rtl;">
            <h5 dir="rtl" align="center"><label for="VendorKind"><u>סיווג המקום (בחירה מרובה): </u></label></h5>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Gan" name="Gan" style="float: right;">  גן אירועים
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Olam" name="Olam" style="float: right;">  אולם
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Small" name="Small" style="float: right;">א. קטנים
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Pub" name="Pub" style="float: right;">פאב
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Home" name="Home" style="float: right;">בית
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Resturant" name="Resturant" style="float: right;">מסעדה
              </label>
            </div>
          </div>
          <div class="row" style="direction: rtl;">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="OpenGan" name="OpenGan" style="float: right;">גן אירועים פתוח
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="NatureProduction" name="NatureProduction" style="float: right;">הפקה בטבע
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Historical" name="Historical" style="float: right;">אתר היסטורי
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Sinigog" name="Sinigog" style="float: right;">בית כנסת
              </label>
            </div>
            <div class="col-sm-2">
              <label align="right">
                <input type="checkbox" id="Hotel" name="Hotel" style="float: right;">מלון
              </label>
            </div>
          </div>
          <hr>
          <div class="row" style="direction: rtl;">
            <div class="col-sm-1" align="center">
              <!-- spacing -->
            </div>
            <div class="col-sm-1" align="center">
              קירוי חורף
              <br>
              <div class="switch">
                <input id="WinterCover" name="WinterCover" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="WinterCover"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              לינה במקום
              <br>
              <div class="switch">
                <input id="SleepOver" name="SleepOver" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="SleepOver"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              הגשה
              <br>
              <div class="switch">
                <input id="Hagasha" name="Hagasha" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="Hagasha"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              בופה
              <br>
              <div class="switch">
                <input id="Bofet" name="Bofet" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="Bofet"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              חופה בחוץ
              <br>
              <div class="switch">
                <input id="HupaOutside" name="HupaOutside" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="HupaOutside"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              חופה בפנים
              <br>
              <div class="switch">
                <input id="HupaInside" name="HupaInside" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="HupaInside"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              בריכה
              <br>
              <div class="switch">
                <input id="Pool" name="Pool" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="Pool"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              ליד הים
              <br>
              <div class="switch">
                <input id="NearSea" name="NearSea" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="NearSea"></label>
              </div>
            </div>
            <div class="col-sm-1" align="center">
              בטבע
              <br>
              <div class="switch">
                <input id="Nature" name="Nature" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="Nature"></label>
              </div>
            </div>
            <div class="col-sm-2" align="center">
              השכרת מקום
              <br>
              <div class="switch">
                <input id="PlaceOnly" name="PlaceOnly" class="cmn-toggle cmn-toggle-round" type="checkbox">
                <label for="PlaceOnly"></label>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group">
              <div class="col-sm-3" align="center">
                <p dir="rtl"><label for="Kosher">כשרות</label></p>
                <select name="IsKosher"  style="width: 150px;">
                  <option disabled selected>לא משנה</option>
                  <option value="Kosher">כשר</option>
                  <option value="NonKosher">לא כשר</option>
                  <option value="SemiKosher">יש מתחם לא כשר</option>
                </select>
              </div>
              <div class="col-sm-3" align="center">
                <p dir="rtl"><label for="Tivoni">טבעונות</label></p>
                <select name="IsTivoni" style="width: 150px;">
                  <option disabled selected>לא משנה</option>
                  <option value="SomeTivoni">יש מנות טבעוניות</option>
                  <option value="NonTivoni">אין אפשרות לטבעוני מלא</option>
                  <option value="Option2Tivoni">אפשרות לטבעוני מלא</option>
                  <option value="OnlyTivoni">רק טבעוני</option>
                </select>
              </div>
              <div class="col-sm-3" align="center">
                <p dir="rtl"><label for="Ztimhoni">צמחונות</label></p>
                <select name="IsZtimhoni" style="width: 150px;">
                  <option disabled selected>לא משנה</option>
                  <option value="SomeZtimhoni">יש מנות צמחוניות</option>
                  <option value="NonZtimhoni">אין אפשרות לצמחוני מלא</option>
                  <option value="Option2Ztimhoni">אפשרות לצמחוני מלא</option>
                  <option value="OnlyZtimhoni">רק צמחוני</option>
                </select>
              </div>
              <div class="col-sm-3" align="center">
                <p dir="rtl"><label for="Handicaps">גישה לנכים</label></p>
                <select name="HandicapsAccess" style="width: 150px;">
                  <option disabled selected>לא משנה</option>
                  <option value="FullAccess">גישה מלאה</option>
                  <option value="PartAccess">גישה חלקית</option>
                  <option value="ZeroAccess">אין גישה</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group">
              <div class="col-sm-9" align="center">
                <!-- Spacing -->
              </div>
              <div class="col-sm-3" align="center">
                <p dir="rtl"><label for="Winter">חורף</label></p>
                <select name="Winter" style="width: 150px;">
                  <option disabled selected>לא משנה</option>
                  <option value="Active">פעיל</option>
                  <option value="NonActive">לא פעיל</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <center><button type="submit" class="btn btn-primary btn-lg" name="submit">
      תביא תוצאות באמא שך
    </button></center>
  </form>
</body>
</html>
