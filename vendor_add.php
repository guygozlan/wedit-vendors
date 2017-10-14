<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/file_upload.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="DragNdrop/dropzone.js"></script>
</head>
<body>

<?php
  //Connect to MongoDB & AWS S3
  include('mongodb_connection.php');
  $collection = connect_mongodb();
  $vendor_name = $_GET["name"];

if (1==$_GET["DelImg"])
{
//Delete image
  $vendor = $collection->findOne(array('VendorName' => $vendor_name));

  function count_imgs($vendor, $base_name)
  {
    $i = 0;
    while (!(empty($vendor[$base_name.strval($i+1)]))) $i++;
    return $i;
  }

  $i=$_GET["i"];
  $baseLink=$_GET["baselink"];
  $img_count = count_imgs($vendor, $baseLink);

  echo 'Del img: count='.$img_count.'<br/>';
  for ($j=$i; $j<$img_count; $j++)
  {
    echo 'Del img: i='.$i.', j='.$j.'<br/>';
    var_dump($collection);
    $collection->update(array('VendorName' => $vendor_name),
                        array('$set' =>
                        array($baseLink.strval($j) => $vendor[$baseLink.strval($j+1)])));
  }
  $collection->update(array('VendorName' => $vendor_name),
                      array('$set' =>
                      array($baseLink.strval($j) => '')));
  header('Location: vendor_add.php?show_only=1&name='.$vendor_name);
  die();

} else if ($_GET["show_only"]) {
  $vendor = $collection->findOne(array('VendorName' => $vendor_name));
} else {
//Update or Create new document
  // create document
  $vendor_name = $_POST["VendorName"];
  $document = array(
      "Staging"         => (isset($_POST['Staging'])),

      "VendorName"      => $_POST["VendorName"],
      "WorkingWithUs"   => $_POST["WorkingWithUs"],

      "ContactName"     => $_POST["VendorContactName"],
      "ContactEmail"    => $_POST["VendorContactEmail"],
      "ContactPhone"    => $_POST["VendorContactPhone"],
      "ContactPhone2"   => $_POST["VendorContactPhone2"],
      "ContactComments" => $_POST["VendorContactComments"],

      "VendorLocation"  => $_POST["VendorLocation"],
      "VendorAddress"   => $_POST["VendorAddress"],
      "VendorAddressLatitude"   => $_POST["VendorAddressLatitude"],
      "VendorAddressLongitude"  => $_POST["VendorAddressLongitude"],

      "PriceRate"       => $_POST["PriceRate"],

      "VendorMinGuests" => (int)($_POST["VendorMinGuests"]),
      "VendorMaxGuests" => (int)($_POST["VendorMaxGuests"]),

      "IsGan"           => (isset($_POST['Gan'])),
      "IsOlam"          => (isset($_POST['Olam'])),
      "IsSmall"         => (isset($_POST['Small'])),
      "IsPub"           => (isset($_POST['Pub'])),
      "IsHome"          => (isset($_POST['Home'])),
      "IsResturant"     => (isset($_POST['Resturant'])),
      "IsNatureProd"    => (isset($_POST['NatureProduction'])),
      "IsHistorical"    => (isset($_POST['Historical'])),
      "IsSinigog"       => (isset($_POST['Sinigog'])),
      "IsHotel"         => (isset($_POST['Hotel'])),
      "IsOpenGan"       => (isset($_POST['OpenGan'])),

      "IsSleepOver"     => (isset($_POST['SleepOver'])),
      "IsHagasha"       => (isset($_POST['Hagasha'])),
      "IsBofet"         => (isset($_POST['Bofet'])),
      "IsHupaOutside"   => (isset($_POST['HupaOutside'])),
      "IsHupaInside"    => (isset($_POST['HupaInside'])),
      "IsPool"          => (isset($_POST['Pool'])),
      "IsNearSea"       => (isset($_POST['NearSea'])),
      "IsNature"        => (isset($_POST['Nature'])),
      "PlaceOnly"       => (isset($_POST['PlaceOnly'])),

      "Kosher"          => $_POST['IsKosher'],
      "Tivoni"          => $_POST['IsTivoni'],
      "Ztimhoni"        => $_POST['IsZtimhoni'],
      "HandicapsAccess" => $_POST['HandicapsAccess'],
      "Parking"         => $_POST['Parking'],
      "Winter"          => $_POST['Winter'],
      "WinterCover"     => $_POST['WinterCover'],

      // "SpecialParams"   => $_POST['SpecialParams'],

      "FreeText"        => $_POST['VendorFreeText'],

      "FacebookLink"    => $_POST['VendorFacebookLink'],
      "WebsiteLink"     => $_POST['VendorWebsiteLink'],

      //"VendorMinisite"  => $_POST['VendorMinisite']

  );
  //insert document
  $vendor = $collection->findOne(array('VendorName' => $_POST["VendorName"]));
  if (empty($vendor))
  {
    $kind = 'נוסף בהצלחה למערכת';
    $collection->insert($document);
  } else {
    $collection->update(array('VendorName' => $_POST["VendorName"]), array('$set' => $document));
    $kind = 'עודכן בהצלחה';
  }
}

?>
<div class="alert alert-warning alert-dismissible" role="alert" align="center" style="direction: rtl;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span></button>
  <p> גן אירועים <?php echo ($_POST["VendorName"]) . ' ' . $kind;?></p>
</div>

<!-- Image Upload Section -->
<script>
$( document ).ready(function() {
    $("[rel='tooltip']").tooltip();

    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );
});
</script>

<?php

function display_existing_images($vendor, $baseLink)
{
  $i = 1;
  while (!(empty($vendor[$baseLink . strval($i)])))
  {
    $ret = $ret . '
    <div class="thumbnail">
      <div class="caption">
         <p><a  href="vendor_add.php?DelImg=1&name=' . $vendor["VendorName"] .'&baselink=' . $baseLink .'&i=' . $i . '"
                class="label label-danger" title="מחק" rel="tooltip">מחק תמונה זו</a>
     </div>
     <img src="' . $vendor[$baseLink.strval($i)] . '" alt="problem" width="150px">
   </div>';
    $i++;
  }
  return ($ret);
}
?>

<?php include('hashing.php');?>
<br/>
<form action="vendor_images.php?name=<?php echo ($vendor_name); ?>"
      method="post" enctype="multipart/form-data">
  <div class="container" id="vendor_images">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center" dir="rtl">עכשיו בואו נוסיף את התמונות</div>
      <div class="panel-body" align="center">
        <div class="row">
          <div class="col-sm-4">
            <div class="panel panel-info">
              <div class="panel-heading" align="center" dir="rtl">סידור ישיבה</div>
              <div class="panel-body" align="center">
                <?php if (!(empty($vendor))) echo display_existing_images($vendor, 'ImgTables');?>
                <hr>
                <p dir="rtl" align="center">הוספת תמונות:</p><br>
                <input type="file" accept="image/*" name="ImgTables[]" multiple/>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="panel panel-info">
              <div class="panel-heading" align="center" dir="rtl">חופה</div>
              <div class="panel-body" align="center">
                <?php if (!(empty($vendor))) echo display_existing_images($vendor, 'ImgHupa');?>
                <hr>
                <p dir="rtl" align="center">הוספת תמונות:</p><br>
                <input type="file" accept="image/*" name="ImgHupa[]" multiple/>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="panel panel-info">
              <div class="panel-heading" align="center" dir="rtl">לוגו</div>
              <div class="panel-body" align="center">
                <input type="file" accept="image/*" name="ImgLogo"/>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-info">
            <div class="panel-heading" align="center" dir="rtl">אחר</div>
            <div class="panel-body" align="center">
              <?php if (!(empty($vendor))) echo display_existing_images($vendor, 'ImgOthers');?>
              <hr>
              <p dir="rtl" align="center">הוספת תמונות:</p><br>
              <input type="file" accept="image/*" name="ImgOthers[]" multiple/>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-info">
            <div class="panel-heading" align="center" dir="rtl">קבלת פנים</div>
            <div class="panel-body" align="center">
              <?php if (!(empty($vendor))) echo display_existing_images($vendor, 'ImgReception');?>
              <hr>
              <p dir="rtl" align="center">הוספת תמונות:</p><br>
              <input type="file" accept="image/*" name="ImgReception[]" multiple/>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-info">
            <div class="panel-heading" align="center" dir="rtl">קירוי חורף</div>
            <div class="panel-body" align="center">
              <?php if (!(empty($vendor))) echo display_existing_images($vendor, 'ImgWinter');?>
              <hr>
              <p dir="rtl" align="center">הוספת תמונות:</p><br>
              <input type="file" accept="image/*" name="ImgWinter[]" multiple/>
            </div>
          </div>
        </div>
        <hr>
        <div class="col-sm-12" align="center">
          <input type="submit" class="btn btn-primary btn-lg" value="סיימתי"/>
        </div>
      </div>
    </div>
  </div>
</form>

</body>
</html>
