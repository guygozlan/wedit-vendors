<?php
//AWS account setting
define('AWS_ACCESS_KEY',"AKIAIEP6UENYL3IXOBNQ");
define('AWS_SECRET_KEY',"iL9ydm1gAchY3/uF2TnLTI5aNx7o8oz1DQmJjYEP");

define('BUCKET_NAME','wedit-vendors.com');//The bucket name you want to use for your project
define('AWS_URL','https://wedit-vendors.com.s3.amazonaws.com/');

//Database connection
mysql_connect("venues.c1euke2mhmuc.us-west-2.rds.amazonaws.com:3306","wedit","guy150383") or die(mysql_error());
mysql_select_db("venues") or die(mysql_error());
?>
