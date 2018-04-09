<?php
$width =200;
$height =200;
$adaptiveOffset =0.81;

    $imagick = new \Imagick(realpath($_SERVER['DOCUMENT_ROOT'] . '/upcast/gallery/5737abf4d01d6.jpg'));
    $adaptiveOffsetQuantum = intval($adaptiveOffset * \Imagick::getQuantum());
    $imagick->adaptiveThresholdImage($width, $height, $adaptiveOffsetQuantum);
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
?>