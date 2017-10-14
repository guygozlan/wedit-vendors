<?php
/**
 * PHP AWS S3 Integration Library
 * 
 * @package    PHP AWS S3 Integration Library
 * @author     scriptigniter <scriptigniter@gmail.com>
 * @link       http://www.scriptigniter.com/phps3demo/
 */

define('AWS_ACCESS_KEY',"AKIAIEP6UENYL3IXOBNQ");
define('AWS_SECRET_KEY',"iL9ydm1gAchY3/uF2TnLTI5aNx7o8oz1DQmJjYEP");

define('BUCKET_NAME','wedit-vendors.com');//The bucket name you want to use for your project
define('AWS_URL','https://wedit-vendors.com.s3.amazonaws.com/');


//check AWS access key is set or not
if(trim(AWS_ACCESS_KEY,"{}")=="AWS_ACCESS_KEY")
{    
     exit("PHP S3 Integration configuration error! 
        Please input the AWS Access Key, AWS Secret Key, Bucket Name and Database connectivity in phps3integration_config.php file 
        or run the <a href=\"install.php\">installaion script</a> to setup automatically.");
}
require_once('awssdk/sdk.class.php');	


//Database connection
//mysql_connect("{{DATABASE_HOST}}","{{DATABASE_USERNAME}}","{{DATABASE_PASSWORD}}") or die(mysql_error());
//mysql_select_db("{{DATABASE_NAME}}") or die(mysql_error());

?>
