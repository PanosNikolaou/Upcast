<?php

	session_start();
	if (isset($_SESSION["userid"])){
	}

    require_once("include/connection.php");
	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: ".mysql_error()); 
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
	
	$q = $_REQUEST["q"];
	
    mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
	$mysql = mysql_query("SELECT * FROM upcast_photos_reg");
	
	
$hint = "";

$i = 0;

while($a = mysql_fetch_array($mysql)){

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {

        if (stristr($q, substr($name, 0, $len))) {
			$i++;
            if ($hint === "") {
                $hint = $name;
            } 
			else {
				if(!stristr($hint,$name)){
                $hint .= ", ". $name;
				}
            }
        }
    }
}
}

echo $hint === "" ? "δεν υπάρχει πρόταση" : $hint;
?>