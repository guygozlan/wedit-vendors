<?php
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

include('mongodb_connection.php');
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
$collection = connect_mongodb();
$target = 'ImgWinter';
$file2upload = 'ImgWinter';

$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'tmp';   //2

// echo 'Num of images: ' . count($_FILES['ImgWinter']["name"]) . '<br/>';

// include('s3/s3upload/s3_config.php');
// if(isset($_POST['submit'])){
  if (!empty($_FILES)) {
    // echo 'In not Empty !';
    // $name = $_FILES[$file2upload]['name'];
    // $size = $_FILES[$file2upload]['size'];
    // $tmp = $_FILES[$file2upload]['tmp_name'];
    // $ext = getExtension($name);

    $tempFile = $_FILES['WinterImg']['tmp_name'];          //3
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['WinterImg']['name'];  //5
    move_uploaded_file($tempFile,$targetFile); //6

    // $actual_image_name = time().".".$ext;
    // if($s3->putObjectFile($targetFile, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
    // {
    //   $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
    // }
  }
// }

// // function uploadImg ($file2upload, $target, $collection, $valid_formats)
// if(is_array($_FILES))
// {
//   $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
//   include('mongodb_connection.php');
//   $collection = connect_mongodb();
//   $target = 'ImgWinter';
//   $file2upload = 'file';
//   //include('s3/s3upload/image_check.php');
//   $msg='';
//   $name = $_FILES[$file2upload]['name'];
//   $size = $_FILES[$file2upload]['size'];
//   $tmp = $_FILES[$file2upload]['tmp_name'];
//   $ext = getExtension($name);
//
//   if(strlen($name) > 0)
//   {
//     if(in_array($ext,$valid_formats))
//     {
//       if($size<(1024*1024))
//       {
//         include('s3/s3upload/s3_config.php');
//         //Rename image name.
//         $actual_image_name = time().".".$ext;
//         if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
//         {
//           //$msg = "S3 Upload Successful.";
//           $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
//           //echo "<img src='$s3file' style='max-width:100px'/><br/>";
//           //echo '<b>S3 File URL:</b>'.$s3file.'<br/>';
//         }
//         else
//           $msg = "S3 Upload Fail.";
//       }
//       else
//         $msg = "Image size Max 1 MB";
//     }
//     else
//     {
//       $msg = "Invalid file, please upload image file.";
//     }
//     $resu = $collection->update(array('VendorName' => $_GET["name"]) ,
//                                 array('$set' => array($target => $s3file)));
//     if (NULL != $resu["err"])   $msg = $msg . 'There was a problem with the uploading... <br/>';
//   }
//   else
//   {
//     // $msg = "שים לב! לא נבחרה תמונת לוגו";
//   }
//   if ("" != $msg) echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
// }
?>
