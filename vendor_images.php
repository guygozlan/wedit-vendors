<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/file_upload.css">
</head>
</body>

<?php
include('mongodb_connection.php');
$collection = connect_mongodb();

// Upload Images

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");

function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

function uploadImg ($file2upload, $target, $collection, $valid_formats)
{
  //include('s3/s3upload/image_check.php');
  $msg='';
  $name = $_FILES[$file2upload]['name'];
  $size = $_FILES[$file2upload]['size'];
  $tmp = $_FILES[$file2upload]['tmp_name'];
  $ext = getExtension($name);

  if(strlen($name) > 0)
  {
    if(in_array($ext,$valid_formats))
    {
      if($size<(1024*1024))
      {
        include('s3/s3upload/s3_config.php');
        //Rename image name.
        $actual_image_name = time().".".$ext;
        if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
        {
          //$msg = "S3 Upload Successful.";
          $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
          //echo "<img src='$s3file' style='max-width:100px'/><br/>";
          //echo '<b>S3 File URL:</b>'.$s3file.'<br/>';
        }
        else
          $msg = "S3 Upload Fail.";
      }
      else
        $msg = "Image size Max 1 MB";
    }
    else
    {
      $msg = "Invalid file, please upload image file.";
    }
    $resu = $collection->update(array('VendorName' => $_GET["name"]) ,
                                array('$set' => array($target => $s3file)));
    if (NULL != $resu["err"])   $msg = $msg . 'There was a problem with the uploading... <br/>';
  }
  else
  {
    // $msg = "שים לב! לא נבחרה תמונת לוגו";
  }
  if ("" != $msg) echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
}

function uploadMultipleImg ($i, $img_queue_index, $file2upload, $target, $collection, $valid_formats)
{
  //include('s3/s3upload/image_check.php');
  $msg='';
  $name = $_FILES[$file2upload]['name'][$i];
  $size = $_FILES[$file2upload]['size'][$i];
  $tmp = $_FILES[$file2upload]['tmp_name'][$i];
  $ext = getExtension($name);

  if(strlen($name) > 0)
  {
    if(in_array($ext,$valid_formats))
    {
      if($size<(1024*1024))
      {
        include('s3/s3upload/s3_config.php');
        //Rename image name.
        $actual_image_name = time().".".$ext;
        if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
        {
          //$msg = $msg . "S3 Upload Successful.<br/>";
          $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
          //echo "<img src='$s3file' style='max-width:100px'/><br/>";
          //$msg = $msg . '<b>S3 File URL:</b>'.$s3file.'<br/>';
        }
        else
          $msg = "S3 Upload Fail.";
      }
      else
        $msg = "Image size Max 1 MB";
    }
    else
    {
      $msg = "Invalid file, please upload image file.";
    }
    $newTarget = $target . strval($img_queue_index+1);
    $resu = $collection->update(array('VendorName' => $_GET["name"]) ,
                                array('$set' => array($newTarget => $s3file)));
    if (NULL != $resu["err"])   $msg = $msg . 'There was a problem with the uploading... <br/>';
  }
  // If no images has been selected - no problem
  if ("" != $msg) echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
}

function count_imgs($vendor, $base_name)
{
  $i = 0;
  while (!(empty($vendor[$base_name.strval($i+1)]))) $i++;
  return $i;
}

function uploadImages($vendor, $collection, $base_name)
{

  $img_queue_index = count_imgs($vendor, $base_name);
  $fileCount = count($_FILES[$base_name]["name"]) + $img_queue_index;
  for ($i = 0; $i < $fileCount; $i++) {
    uploadMultipleImg($i, $img_queue_index, $base_name, $base_name, $collection, $valid_formats);
    $img_queue_index++;
  }
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $vendor = $collection->findOne(array('VendorName' => $_GET["name"]));
  uploadImg('ImgLogo', 'ImgLogo', $collection, $valid_formats);
  uploadImages($vendor, $collection, 'ImgTables');
  uploadImages($vendor, $collection, 'ImgHupa');
  uploadImages($vendor, $collection, 'ImgOthers');
  uploadImages($vendor, $collection, 'ImgReception');
  uploadImages($vendor, $collection, 'ImgWinter');
}

echo '<div class="col-sm-12" align="center">
        <h2 dir="rtl"> התמונות הועלו בהצלחה! יאיי!</h2><br/>
        <a href="vendor_details.php?name=' . $_GET["name"] . '"
        class="btn btn-primary btn-lg active" role="button">המשך לסיכום</a>
      </div>';

?>
</body>
</html>
