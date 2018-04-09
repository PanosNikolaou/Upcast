<?php	

	session_start();
    require_once("include/connection.php");

	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: ".mysql_error()); 
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
	
        /*
	if(isset($_GET['share'])){
	$uid = str_replace(" ","",$_GET['uid']);
        mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	$mysqlquery = mysql_query("SELECT * FROM upcast_photos_reg WHERE photo_uid='$uid'");
	$row = mysql_fetch_assoc($mysqlquery);
	$photo_path = $row['photo_path'];
	header("Location: http://www.facebook.com/sharer.php?u=$photo_path");
        }
	*/
        
	if(isset($_GET['like'])){
        $ip = $_SERVER['REMOTE_ADDR'];
        $sqlquery = mysql_query("INSERT INTO upcast_banned_ips (ipaddress) VALUES ('$ip')");
	if(!$sqlquery)
	echo "<script type='text/javascript'>alert('This ip has already voted');</script>"; 
	$uid = str_replace(" ","",$_GET['uid']);
        mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	$mysqlquery = mysql_query("SELECT * FROM upcast_photos_reg WHERE photo_uid='$uid'");
	$row = mysql_fetch_assoc($mysqlquery);
	$photo_likes = $row['photo_likes'];
	$photo_likes = $photo_likes + 1;
        mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	$mysql = mysql_query("UPDATE upcast_photos_reg SET photo_likes=$photo_likes WHERE photo_uid='$uid'");

	}
	
	$filtersarray = array();

	
	if(isset($_POST['people'])){
		//echo "people"; 
		$filtersarray[1] = "people";
	}
	if(isset($_POST['animals'])){
		//echo "animals"; 
		$filtersarray[2] = "animals";
	}
	if(isset($_POST['landscapes'])){
		//echo "landscapes"; 
		$filtersarray[3] = "landscapes";
	}	
	if(isset($_POST['other'])){
		//echo "other"; 
		$filtersarray[4] = "other";
	}	

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="Model.ico"/>
<title>UpCast</title>
<link rel="stylesheet" type="text/css" href="lightbox/css/jquery.lightbox-0.5.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="lightbox/js/jquery.lightbox-0.5.pack.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}

function outputUpdate(vol) {
	document.querySelector('#volume').value = vol;
}

</script>

</head>


<style type="text/css"> 
input[type=range] {
    /*removes default webkit styles*/
    -webkit-appearance: none;
    
    /*fix for FF unable to apply focus style bug */
    border: 1px solid white;
    
    /*required for proper track sizing in FF*/
    width: 300px;
}
input[type=range]::-webkit-slider-runnable-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: goldenrod;
    margin-top: -4px;
}
input[type=range]:focus {
    outline: none;
}
input[type=range]:focus::-webkit-slider-runnable-track {
    background: #ccc;
}

input[type=range]::-moz-range-track {
    width: 300px;
    height: 5px;
    background: #ddd;
    border: none;
    border-radius: 3px;
}
input[type=range]::-moz-range-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: goldenrod;
}

/*hide the outline behind the border*/
input[type=range]:-moz-focusring{
    outline: 1px solid white;
    outline-offset: -1px;
}

input[type=range]::-ms-track {
    width: 300px;
    height: 5px;
    
    /*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
    background: transparent;
    
    /*leave room for the larger thumb to overflow with a transparent border */
    border-color: transparent;
    border-width: 6px 0;

    /*remove default tick marks*/
    color: transparent;
}
input[type=range]::-ms-fill-lower {
    background: #777;
    border-radius: 10px;
}
input[type=range]::-ms-fill-upper {
    background: #ddd;
    border-radius: 10px;
}
input[type=range]::-ms-thumb {
    border: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    background: goldenrod;
}
input[type=range]:focus::-ms-fill-lower {
    background: #888;
}
input[type=range]:focus::-ms-fill-upper {
    background: #ccc;
}
</style> 
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">UpCast</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
                <?php
		if (isset($_SESSION["userid"])){                
                echo '<li><a href="usergallery.php">Έκθεση χρήστη</a></li>';
                }
		?>
	  	<li><a href="search.php">Αναζήτηση φωτογραφιών</a></li>
		<li><a href="searchmapphotos.php">Προβολή σε χάρτη</a></li>
                <?php
		if (isset($_SESSION["userid"])){                
                echo '<li><a href="upload.php">Μεταφόρτωση νέας εικόνας</a></li>';
                }
		?>
		<li><a href="topfive.php">Κορυφαίες εικόνες</a></li>
                <?php
		if (!isset($_SESSION["userid"])){                
		echo '<li><a href="login.php">Σύνδεση/Εγγραφή</a></li>';
                }
                else
                echo '<li><a href="logout.php">Αποσύνδεση</a></li>';
		?>
                <li><a href="contactus.php">Επικοινωνήστε μαζί μας</a></li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
<form action="search.php" method="post" name="catform" class="form-inline" role="form">
<p class="bg-info"> <h4> Φιλτράρισμα βάση κατηγοριών </h4></p>
<label class="checkbox-inline"><input type="checkbox" checked="checked" name="people">Άνθρωποι</label>
<label class="checkbox-inline"><input type="checkbox" checked="checked" name="animals">Ζώα</label>
<label class="checkbox-inline"><input type="checkbox" checked="checked" name="landscapes">Τοπία</label>
<label class="checkbox-inline"><input type="checkbox" checked="checked" name="other">Άλλα</label>
<button type="submit" name="catsub" class="btn btn-success">Προβολή</button>
<p class="bg-info"> <h4> Αναζήτηση βάση κειμένου </h4></p>
<input type="text" size="50" class="form-control" onkeyup="showHint(this.value)" name="srctxt">
<p>Προτάσεις: <span id="txtHint"></span></p>
<button type="submit" name="srchsub" class="btn btn-success">Υποβολή</button>
<p class="bg-info"> <h4> Αναζήτηση βάση δημοφιλίας </h4></p>
<input type="range" min="0" max="100" value="50" name="lkrange" id="fader" step="1" oninput="outputUpdate(value)">
<output for="fader" id="volume">50</output>
<button type="submit" name="liksub" class="btn btn-success">Αναζήτηση</button>
</form>
</div>

<div id="container">
<?php
$directory = 'gallery';
$allowed_types=array('jpg','jpeg','gif','png');
$file_parts=array();
$ext='';
$title='';
$i=0;

$dir_handle = @opendir($directory) or die("There is an error with your image directory!");

while ($file = readdir($dir_handle)) 
{
	if($file=='.' || $file == '..') continue;
	
	$file_parts = explode('.',$file);
	$ext = strtolower(array_pop($file_parts));

	$title = implode('.',$file_parts);
	$title = htmlspecialchars($title);
	
	$nomargin='';
	
	if(in_array($ext,$allowed_types))
	{
		if(($i+1)%5==0) $nomargin='nomargin';
                mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
		$mysql = mysql_query("SELECT * FROM upcast_photos_reg WHERE photo_uid='$title'");
		$user = mysql_fetch_assoc($mysql);
		$description  = $user['photo_text'];
		$category = $user['photo_category_id'];
		$photo_like = $user['photo_likes'];
                $username = $user['username'];
			foreach($filtersarray as $x=>$x_value)
			{			
				if(strcmp($category,$x_value)==0){				
				if(isset($_POST['srchsub'])){
					$txtstring = $_POST['srctxt'];
					if($txtstring!=""){
					if(strchr($description,$txtstring)){				
						echo '
						<div class="picont">
						<div class="pic '.$nomargin.'" style="background:url('.$directory.'/'.$file.') no-repeat 50% 50%;">
						<a href="'.$directory.'/'.$file.'" title="'.$description .'" target="_blank">'.$description .'</a>
						<div class="desc">
						<form action="search.php">
						<button class="btn" name="like" type="submit">  Like 
						<img src="like.png" height="20"/>
						</button>
                                                <button class="btn btn-success" name="user" type="button">  ' .$username .'
                                                <img src="user.png" height="20"/>
                                                </button>
						<input type="hidden" name="uid" value="' . $title . '"><br>
						</form>
						</div>
						</div>
						</div>';	
						}						
					}
				}
				if(isset($_POST['catsub'])){
				if(strcmp($category,$x_value)==0){				
						echo '
						<div class="picont">
						<div class="pic '.$nomargin.'" style="background:url('.$directory.'/'.$file.') no-repeat 50% 50%;">
						<a href="'.$directory.'/'.$file.'" title="'.$description .'" target="_blank">'.$description .'</a>
						<div class="desc">
						<form action="search.php">
						<button class="btn" name="like" type="submit">  Like 
						<img src="like.png" height="20"/>
						</button>
                                                <button class="btn btn-success" name="user" type="button">  ' .$username .'
                                                <img src="user.png" height="20"/>
                                                </button>
						<input type="hidden" name="uid" value="' . $title . '"><br>
						</form>
						</div>
						</div>
						</div>';
				}
				}
				}
			}
				if(isset($_POST['liksub'])){
					$likeresult = mysql_query("SELECT SUM(photo_likes) FROM upcast_photos_reg");

					while($row = mysql_fetch_array($likeresult)){
					$totlike = $row['SUM(photo_likes)'];
					}
					$var1 = $_POST['lkrange'];
					$var2 = round(($photo_like*100)/$totlike,2);
					if($var1<=$var2){
						echo '
						<div class="picont">
						<div class="pic '.$nomargin.'" style="background:url('.$directory.'/'.$file.') no-repeat 50% 50%;">
		<a href="'.$directory.'/'.$file.'" title="'.$description .'" target="_blank">'.$description .'</a>
                <div class="desc">
                <button class="btn btn-warning" name="user" type="button">  Δημοφιλία: '. round(($photo_like*100)/$totlike,2) .'%
                <img src="popularity.png" height="20"/>
                </div>
                                                </button>

						</div>
						</div>';
					}
				}
			
		$i++;
	}
}
closedir($dir_handle);

?>
<div class="clear"></div>
</div>

</body>
</html>
