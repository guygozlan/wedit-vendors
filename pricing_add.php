<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <br><div align="center"><a href="/home.php" class="btn btn-large btn-primary">חזרה למסך הבית</a></div><br>
</head>
<body>
  <?php
  //Connect to MongoDB
  include('mongodb_connection.php');
  $collection = connect_mongodb();
  $vendor_name = $_GET["name"];
  $vendor = $collection->findOne(array('VendorName' => $_GET["name"]));
  if (NULL == $vendor) echo "<script type='text/javascript'>alert('אירעה תקלה - שם ספק לא תואם. פנה לגוזלן')</script>";
  $index=1;

if ('del'==$_GET["act"])
{
  /*
  To Delete element in the array Pricing inside document of the venue,
  need to replace the data for this element to null and then to remove the null element
  */
  $id2del = (intval($_GET["del_id"]) - 1);
  $res = $collection->update(
    array('VendorName'  => $vendor_name),
    array('$unset' => array("Pricing.".$id2del => 1))
  );
  $res = $collection->update(
    array('VendorName'  => $vendor_name),
    array('$pull' => array("Pricing" => NULL))
  );
  header("Location: /pricing_add.php/?name=$vendor_name");
  die();
}

if ($_POST) {
  $i=1;
  $document =
  array (
      "PricingWeddingMonth" => $_POST['PricingWeddingMonth'],
      "PricingWeddingDay"   => $_POST['PricingWeddingDay'],
      "PricingNumGuests"    => $_POST['PricingNumGuests'],
      "PricingPrice"        => $_POST['PricingPrice'],
      "PricingAdditionals"  => $_POST['PricingAdditionals'],
      "PricingComments"     => $_POST['PricingComments'],
      "PricingCouple"       => $_POST['PricingCouple']
  );
  $collection->update(array('VendorName' => $vendor_name), array('$push' => array (Pricing => $document)));
  header("Refresh:0");
}

function PricingWeddingDayHash($PricingWeddingDay)
{
  if (Sun == $PricingWeddingDay)      return ("א");
  if (Mon == $PricingWeddingDay)      return ("ב");
  if (Tue == $PricingWeddingDay)      return ("ג");
  if (Wed == $PricingWeddingDay)      return ("ד");
  if (The == $PricingWeddingDay)      return ("ה");
  if (FriNoon == $PricingWeddingDay)  return ("ו צהריים");
  if (FriEve == $PricingWeddingDay)   return ("ו ערב");
  if (Sat == $PricingWeddingDay)      return ("ש");
  return ("Error");
}

function show_pricing_data($vendor)
{
  $i=1;
  foreach ($vendor["Pricing"] as $arr) {
    echo '
    <tr>
      <td>'.$i.'</td>
      <td>'.$arr["PricingWeddingMonth"].'</td>
      <td>'.PricingWeddingDayHash($arr["PricingWeddingDay"]).'</td>
      <td>'.$arr["PricingNumGuests"].'</td>
      <td>'.$arr["PricingPrice"].'</td>
      <td>'.$arr["PricingAdditionals"].'</td>
      <td>'.$arr["PricingComments"].'</td>
      <td>'.$arr["PricingCouple"].'</td>
      <td><a href="pricing_add.php?name='.$vendor["VendorName"].'&act=del&del_id='.$i.'"
      class="btn btn-danger" role="button">מחיקה</a></td>
    </tr>
    ';
    $i++;
    if ($i>100) break; //Protection
  }

  return($i);
}

  ?>
  <br>
  <div class="container" id="vendor_name">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" dir="rtl">
        איסוף מחירים - <?php echo ($vendor_name); ?>
      </div>
      <div class="panel-body">
        <form action="pricing_add.php?name=<?php echo ($vendor_name); ?>" method="post" enctype="multipart/form-data">
          <table class="table" style="direction: rtl;">
            <tr>
              <td><b>#</b></td>
              <td><b>חודש</b></td>
              <td><b>יום</b></td>
              <td><b>מוזמנים</b></td>
              <td><b>מחיר</b></td>
              <td><b>תוספות</b></td>
              <td><b>הערות</b></td>
              <td><b>שם הזוג</b></td>
              <td><b>פעולות</b></td>
            </tr>
              <?php $index=show_pricing_data($vendor); ?>
            <tr>
              <td><?php echo ($index); $index++; ?></td>
              <td>
                <input dir="rtl" type="text" align="right" class="form-control" name="PricingWeddingMonth" placeholder="חודש">
              </td>
              <td>
              <select name="PricingWeddingDay" class="form-control">
                <option value="Sun">א</option>
                <option value="Mon">ב</option>
                <option value="Tue">ג</option>
                <option value="Wed">ד</option>
                <option value="The">ה</option>
                <option value="FriNoon">ו צהריים</option>
                <option value="FriEve">ו ערב</option>
                <option value="Sat">ש</option>
              </select>
              <td><input dir="rtl" type="text" class="form-control" name="PricingNumGuests" placeholder="מוזמנים"></td>
              <td><input dir="rtl" type="text" class="form-control" name="PricingPrice" placeholder="מחיר"></td>
              <td><input dir="rtl" type="text" class="form-control" name="PricingAdditionals" placeholder="תוספות מחיר"></td>
              <td><input dir="rtl" type="text" class="form-control" name="PricingComments" placeholder="הערות"></td>
              <td><input dir="rtl" type="text" class="form-control" name="PricingCouple" placeholder="שם הזוג"></td>
              <td>
                <input type="submit" class="btn btn-success" value="שמירה"/>
              </td>
            </tr>
          </table>

        </form>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-sm-12" align="center">
      <?php echo '
        <a href="/vendor_details.php/?name='. $vendor_name .'" class="btn btn-primary btn-lg active" role="button">חזרה לפרטי הספק</a>
      ';?>
    </div>
  </div>

</body>
</html>
