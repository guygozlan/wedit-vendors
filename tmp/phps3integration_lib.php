<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * PHP AWS S3 Integration Library
 * 
 * @package    CodeIgniter AWS S3 Integration Library
 * @author     scriptigniter <scriptigniter@gmail.com>
 * @link       http://www.scriptigniter.com/phps3demo/
 */
//Check configuration is set or not
require_once 'phps3integration_config.php';
$s3 = new AmazonS3();
$bucket_name = BUCKET_NAME;
$try = 1;
$sleep = 1;

/**
 * Upload post file to S3 Bucket
 * 
 * @access public
 * @param array $file_array (Required) $_FILES array of file to upload, eg. $_FILES['file']
 * @param string $s3_path path in S3 bucket to upload eg. "mydir" or pass "/" if want to upload at root of bucket
 * @param boolean $do_rename Set it if want to rename the file to avoid same name files in bucket. check get_new_name() function to see the logic to create new name
 * 
 * @return boolean|string <ul>
 * <li>FALSE: if file do not get upload</li>
 * <li>file name: if file successfully uploads to s3 bucket</li>
 * 
 */
function uploaded_file_to_s3($file_array, $s3_path = "/", $do_rename = FALSE) {
    global $s3;
    global $bucket_name;
    global $try;
    global $sleep;

    if ($s3_path == "") {
        return FALSE;
    }
    $s3_path = preg_replace("/(.+?)\/*$/", "\\1/", $s3_path);

    $new_file_name = $do_rename == TRUE ? get_new_name($file_array['name']) : $file_array['name'];
    $opt = array(
        'fileUpload' => $file_array['tmp_name'],
        'contentType' => mime_content_type_of_file($new_file_name)
    ); // use only standard storage as data may lose
    //Try multiple times to upload the file if not upload in one go by any reason.
    do {
        $r = $s3->create_object($bucket_name, $s3_path . $new_file_name, $opt);
        if ($r->isOK()) {

            return $new_file_name;
        }
        sleep($sleep);
        $sleep *= 2;
    } while (++$try < 6);

    return false;
}

/**
 * Upload any server file to S3 Bucket
 * 
 * @access public
 * @param array $source_path (Required) source folder path
 * @param string $file_name file name of the file to upload
 * @param string $s3_path path in bucket to upload, If not provided then it will take same value of source path
 * @param boolean $do_rename Set it if want to rename the file to avoid same name files in bucket. check get_new_name() function to see the logic to create new name
 * 
 * @return boolean|string <ul>
 * <li>FALSE: if file do not get upload</li>
 * <li>file name: if file successfully uploads to s3 bucket</li>
 * 
 */
function uploaded_file_to_s3_manually($source_path, $file_name, $s3_path = "", $do_rename = FALSE) {
    global $s3;
    global $bucket_name;
    global $try;
    global $sleep;

    if ($s3_path == "") {
        $s3_path = $source_path;
    }
    $source_path = preg_replace("/(.+?)\/*$/", "\\1/", $source_path);
    $s3_path = preg_replace("/(.+?)\/*$/", "\\1/", $s3_path);

    $new_file_name = $do_rename == TRUE ? get_new_name($file_name) : $file_name;

    $file_resource = fopen($source_path . $file_name, 'r');
    $opt = array(
        'fileUpload' => $file_resource,
        'contentType' => mime_content_type_of_file($new_file_name)
    ); // use only standard storage as data may lose
    //Try multiple times to upload the file if not upload in one go by any reason.   
    do {
        $r = $s3->create_object($bucket_name, $s3_path . $new_file_name, $opt);
        if ($r->isOK()) {
                return $new_file_name;
        }
        sleep($sleep);
        $sleep *= 2;
    } while (++$try < 6);

    return false;
}

/**
 * Delete an Amazon S3 object
 * 
 * @access public
 * @param string $file_path (Required) The file path for the object, from root of bucket. eg. "mydir/myfile.jpg"
 * @return boolean TRUE if successfully deleted, FALSE if falied to delete
 * 
 */
function unlink_s3($file_path) {
    global $s3;
    global $bucket_name;
    global $try;
    global $sleep;

    //Try multiple times(3 times) to Delete the file if not deleted in one go by any reason.
    do {
        $response = $s3->delete_object($bucket_name, $file_path);
        if ($response->isOK()) {
            return true;
        }
        sleep($sleep);
        $sleep *= 2;
    } while (++$try < 3);
    return false;
}

/**
 * Copy a S3 object to specified bucket
 * 
 * @access public
 * @param array $source (Required) The bucket and file name to copy from. The following keys must be set: <ul>
 * 	<li><code>bucket</code> - <code>string</code> - Required - Specifies the name of the bucket containing the source object.</li>
 * 	<li><code>filename</code> - <code>string</code> - Required - Specifies the file name of the source object to copy.</li></ul>
 * @param array $dest (Required) The bucket and file name to copy to. The following keys must be set: <ul>
 * 	<li><code>bucket</code> - <code>string</code> - Required - Specifies the name of the bucket to copy the object to.</li>
 * 	<li><code>filename</code> - <code>string</code> - Required - Specifies the file name to copy the object to.</li></ul>
 * 
 * @return boolean 
 * 
 */
function copy_s3($source, $destination) {
    global $s3;
    $response = $s3->copy_object($source, $destination);
    if ($response->isOK()) {
        return true;
    }
    return false;
}


/**
 * Create a S3 Bucket
 * 
 * @access public
 * @param string $bucket_name (Required) The name of the bucket to create.
 * @param string $region The preferred geographical location for the bucket. [Allowed values: `AmazonS3::REGION_US_E1 `, `AmazonS3::REGION_US_W1`, `AmazonS3::REGION_EU_W1`, `AmazonS3::REGION_APAC_SE1`, `AmazonS3::REGION_APAC_NE1`]
 * @return boolean
 * 
 */
function create_bucket($bucket_name = "", $region = AmazonS3::REGION_US_STANDARD) {
    global $s3;
    global $try;
    global $sleep;
    $response = $s3->create_bucket($bucket_name, $region);
    if ($response->isOK()) {
        return true;
    }
    return false;
}

/**
 * Create a new unique name of a file by appending current timestamp and a random number
 * 
 * @access public
 * @param string $filename file name to get a unique name
 * @return string new unique name
 * 
 */
function get_new_name($filename = '') { //the received name is with extension so we have to return with extension
    $ext = get_extension($filename);
    $filename = str_replace($ext, '', $filename);
    $new_filename = '';
    $new_filename = $filename . time() . rand(1, 9999) . "." . $ext;
    return $new_filename;
}

/**
 * Get the extension name of a file name
 * 
 * @access public
 * @param string $filename file name
 * @return string extension name
 * 
 */
if (!function_exists('get_extension')) {
    function get_extension($name) {
        $i = strrpos($name, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($name) - $i;
        $ext = substr($name, $i + 1, $l);
        return $ext;
    }
}

/**
 * Get the Server HTTP URL of passed URI.
 * 
 * @access public
 * @param string URI
 * @return Server HTTP URL
 * 
 */
if (!function_exists('site_url')) {

    function site_url($uri = '') {
        return ($uri); //If you have a base path for your site then you can add here return ($base_path.$uri);
    }

}

/**
 * Get the S3 bucket http URL of passed S3 URI in your bucket
 * 
 * @access public
 * @param string URI
 * @return S3 HTTP URL of your bucket
 * 
 */
if (!function_exists('site_url_s3')) {

    function site_url_s3($uri = '') {
        return (AWS_URL . $uri);
    }

}

/**
 * Get the S3 bucket http URL of passed S3 URI and file name in your bucket
 * 
 * @access public
 * @param string $filename file name to get a unique name
 * @return string new unique name
 * 
 */

if (!function_exists('get_aws_path')) {

    function get_aws_path($path = '', $file_name = '') {
        $new_path = '';
        $new_path = AWS_URL . $path . $file_name;
        return $new_path;
    }

}

/**
 * Get the mime tpe of passed file name
 * 
 * @access public
 * @param string $filename file name to get a unique name
 * @return string new unique name
 * 
 */
if (!function_exists('mime_content_type_of_file')) {

    function mime_content_type_of_file($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

}