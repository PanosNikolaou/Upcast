<?php	

	session_start();
    require_once("include/connection.php");

	if(isset($_SESSION["userid"])){
	$username = $_SESSION["userid"];
	}else {
	header('Location:index.php');	
	}


	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: ".mysql_error()); 
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="Model.ico"/>
<title>UpCast</title>
<link rel="stylesheet" type="text/css" href="lightbox/css/jquery.lightbox-0.5.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="lightbox/js/jquery.lightbox-0.5.pack.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">UpCast</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
	    <li><a href="usergallery.php">Έκθεση χρήστη</a></li>
		<li><a href="search.php">Αναζήτηση φωτογραφιών</a></li>
		<li><a href="searchmapphotos.php">Προβολή σε χάρτη</a></li>
	        <li><a href="upload.php">Μεταφόρτωση νέας εικόνας</a></li>
		<li><a href="topfive.php">Κορυφαίες εικόνες</a></li>
                <li><a href="logout.php">Αποσύνδεση</a></li>
		<li><a href="contactus.php">Επικοινωνήστε μαζί μας</a></li>
      </ul>      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="container">

<?php
$directory = 'gallery';
$allowed_types=array('jpg','jpeg','gif','png');
$file_parts=array();
$ext='';
$title='';
$i=0;

$dir_handle = @opendir($directory) or die("There is an error with your image directory!");

mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
$result = mysql_query("SELECT * FROM upcast_photos_reg WHERE username = '$username' ");

while ($file = readdir($dir_handle)) 
{
	if($file=='.' || $file == '..') continue;
	
	$file_parts = explode('.',$file);
	$ext = strtolower(array_pop($file_parts));

	$title = implode('.',$file_parts);
	$title = htmlspecialchars($title);
	
	$nomargin='';

	while($row = mysql_fetch_array( $result )) {
	$nomargin='';
	$photouid = $row['photo_uid'];
	$photo_name = $row['photo_name'];
		if(in_array($ext,$allowed_types))
		{
		if(($i+1)%5==0) $nomargin='nomargin';
                mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
		$mysql = mysql_query("SELECT * FROM upcast_photos_reg WHERE photo_uid='$photouid'");
		$user = mysql_fetch_assoc($mysql);
		$descritption = $user['photo_text'];
		$likes = $row['photo_likes'];
		
		echo '
		<div class="picont">
		<div class="pic '.$nomargin.'" style="background:url('.$directory.'/'.$photo_name.') no-repeat 50% 50%;">
		<a href="'.$directory.'/'.$photo_name.'" title="'. $photouid .'" target="_blank">'.$row['photo_uid'].'</a>
		<div class="desc">                 
                <button class="btn btn-success" name="user" type="button">  '. $likes .'
                <img src="like.png" height="20"/>
                </div>
		</div>		
		</div>';
		$i++;
	}
	}
}

closedir($dir_handle);

?>


<div class="clear"></div>
</div>
</div>
     <div class="panel-footer">
      <div class="container">
        <p class="text-muted">Copyright NIT</p>
      </div>
	</div>  
</body>
</html>
