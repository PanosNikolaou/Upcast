<?php
	$image = new Imagick($_SERVER['DOCUMENT_ROOT'] . '/upcast/gallery/5737abf4d01d6.jpg');
    $imagick_type_channel_statistics = $image->getImageChannelStatistics();

	echo '<pre>';	
    print_r($imagick_type_channel_statistics);
	print( "</br>" );
	echo '</pre>';
?>