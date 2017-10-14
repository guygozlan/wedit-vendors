<?php
// Bucket Name
$bucket="wedit-vendors.com";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIEP6UENYL3IXOBNQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>
