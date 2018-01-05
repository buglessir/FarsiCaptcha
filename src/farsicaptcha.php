<?php

	/*
		Copyright (C) 2018 - Mohammad Esmaeilzadeh
		Author URL: http://www.bugless.ir/
		Author Email: bugless.ir@yahoo.com
		This is a simple PHP Captcha with Farsi numbers.
	*/

	session_start();

	// Default code length is 5 ( It's changeable with last substr() argument )
	$number = substr(rand(12345, 99999), 0, 5);

	// Convert English numbers to Farsi
	function farsidigit($text)
	{
		$text = str_replace('0' , '٠' , $text);
		$text = str_replace('1' , '١' , $text);
		$text = str_replace('2' , '٢' , $text);
		$text = str_replace('3' , '٣' , $text);
		$text = str_replace('4' , '۴' , $text);
		$text = str_replace('5' , '۵' , $text);
		$text = str_replace('6' , '۶' , $text);
		$text = str_replace('7' , '٧' , $text);
		$text = str_replace('8' , '٨' , $text);
		$text = str_replace('9' , '٩' , $text);

		return $text;
	}

	// Fill session with English numbers
	$_SESSION['farsicaptchacode'] = $number;

	// Setting captcha image size
	$img = imagecreate(70, 35);
	imagecolorallocate($img, 239, 239, 239);

	// Setting background lines and numbers color
	$line_color = imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200));
	$text_color = imagecolorallocate($img, rand(10, 200), rand(10, 200), rand(10, 200));

	// Drawing random background lines
	for( $i=0; $i<10; $i++ )
	{
		imageline($img, rand(20, 5*$i), rand(0, 10*$i), rand(20, 30*$i), rand(30, 30+$i), $line_color);
	}

	// Setting image text with converted Farsi numbers
	$text = farsidigit($number);

	// Free TTF font path ( You can change this with other Farsi fonts )
	$font = 'FreeFarsi.ttf';

	// Setting image
	imagefttext($img, 18, rand(0, 5), rand(5, 10), rand(25, 35), $text_color, $font, $text);

	// Creating image with jpg format ( Setting output )
	header('Content-Type:image/jpeg');
	imagejpeg($img);
	imagedestroy($img);

?>
