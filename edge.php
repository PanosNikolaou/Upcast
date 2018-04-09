<?php
if(isset($_POST["passengers"])){
$radius =$_POST["passengers"];
}else {$radius = 1;
}
    $imagick = new \Imagick(realpath($_SERVER['DOCUMENT_ROOT'] . '/upcast/gallery/5734e7a938ba8.jpg'));
    $imagick->edgeImage($radius);
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
?>