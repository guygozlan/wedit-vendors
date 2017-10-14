<?php
function connect_mongodb()
{
  $collection = NULL;
  try {
    $mssg = "";
    //$m = new MongoClient("127.2.99.130:27017", array('username'=>'admin','password'=>'kN28LiwlMP3Y'));
    $m = new MongoClient("ds119675.mlab.com:19675", array('username'=>'guywedit','password'=>'guy150383'));
    $mssg = $mssg . "* Connection to database status: ";
    if ($m->connected) $mssg = $mssg . '<p style="color:green;"> Connected </p> <br />';
    else               $mssg = $mssg . '<p style="color:red;"  > Connection Failed </p> <br />';
    // select a database
    $db = $m->wedit;
    if (NULL == $db) $mssg = $mssg . '<p style="color:red;"  > Failed to load DB Wedit </p> <br />';
    // select a collection
    $collection = $db->createCollection("vendors");
    if (NULL == $collection) $mssg = $mssg . '<p style="color:red;"  > Failed to load Collection vendors </p> <br />';
  }
  catch ( MongoConnectionException $e )
  {
    //if there was an error, we catch and display the problem here
    $mssg = $mssg . '<p style="color:red;"> * Connection Issues: </p> <br />';
    $mssg = $mssg . '<p style="color:red;">' . $e->getMessage() . '</p> <br />';
  }
  catch ( MongoException $e )
  {
    $mssg = $mssg . '<p style="color:red;"> * Mongo Exeption: </p> <br />';
    $mssg = $mssg . '<p style="color:red;">' . $e->getMessage() . '</p> <br />';
  }
  echo '
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <strong>MongoDB info: </strong> ' . $mssg . '
    </div>
  ';
  return ($collection);
}
?>
