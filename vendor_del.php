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
$vendor_name = $_GET["name"];
$message = "הזדמנות אחרונה. בטוח שאת רוצה למחוק את " . $vendor_name . " ?";
echo "<script type='text/javascript'>
if (confirm('$message'))
{
  window.location.replace('vendor_del_operation.php?name=$vendor_name')
} else {
  window.location.replace('home.php')
};
</script>";
?>

</body>
</html>
