<?php
// init the image objects
$image1 = new imagick();
$image2 = new imagick();

// set the fuzz factor (must be done BEFORE reading in the images)
$image1->SetOption('fuzz', '2%');

// read in the images
$image1->readImage($_SERVER['DOCUMENT_ROOT'] . '/upcast/gallery/5734e723e0360.jpg');
$image2->readImage($_SERVER['DOCUMENT_ROOT'] . '/upcast/gallery/5734e7a938ba8.jpg');

// compare the images using METRIC=1 (Absolute Error)
$result = $image1->compareImages($image2, 1);

// print out the result
echo "The image comparison 2% Fuzz factor is: " . $result[1];
?>