
<!DOCTYPE html>
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
  <div id="main">
    <h1>Wedit Vendor DB System Login</h1>
    <div id="login">
    <h2>Login Form</h2>
    <form action="" method="post">
      <label>UserName :</label>
      <input id="name" name="username" placeholder="username" type="text">
      <label>Password :</label>
      <input id="password" name="password" placeholder="**********" type="password">
      <input name="submit" type="submit" value=" Login ">
      <span><?php echo $error; ?></span>
    </form>
    </div>
  </div>

  <?php
  include('login.php'); 

  if(isset($_SESSION['login_user'])){
  header("location: home.php");
  }
  ?>

</body>
</html>
