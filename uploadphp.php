<?php

	if(isset($_SESSION["userid"])){
	$userid = $_SESSION["userid"];
	}

    require_once("include/connection.php");

	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: ".mysql_error()); 
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
	
$ip=$_SERVER['REMOTE_ADDR'];
	
if (isset($_POST['submit'])) {

if (isset($_POST['category']))  $category = $_POST['category'];

if (isset($_POST['latitude'])) { $latitude = $_POST['latitude'];} else{$latitude=0;}

if (isset($_POST['longitude']))  {$longitude = $_POST['longitude'];} else{$longitude=0;}

$text = $_POST['phototext'];

$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);

if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 1000000)
&& in_array($file_extension, $validextensions)) {

if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
} else {
$photouid = uniqid();	
$filename = $photouid . "." . $file_extension ;

move_uploaded_file($_FILES["file"]["tmp_name"], "gallery/" . $filename);
$imgFullpath = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'. "gallery/" . $filename ;

	if(isset($_SESSION["userid"])){
	$userid = $_SESSION["userid"];
	}else {
	header('Location:index.php');	
	}
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
$query = mysql_query("INSERT INTO upcast_photos_reg (photo_uid,photo_name,photo_text,photo_category_id,photo_path,photo_lat,photo_lng,photo_likes,username) 
											VALUES ('$photouid','$filename','$text','$category','$imgFullpath','$latitude','$longitude','0','$userid')");
if($query) { echo "Η εικόνα μεταφορτώθηκε επιτυχώς"; } 
else {echo "Η μεταφόρτωση της εικόνας απέτυχε"; }
}
} else {
echo "<span>***Invalid file Size or Type***<span>";
}
}
?>