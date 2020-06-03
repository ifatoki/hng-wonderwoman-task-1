<?php

/*
	Author: Sello C. Fotoyi
	File: 01858-Sello.php
	Description: script which outputs a "Hello world",
				 along with author's name and HNGi7 ID,
				  as requested for HNGi7 Task 2.
	Date: 03 June 2020

*/

	define("FULL_NAME", "Sello Clinton Fotoyi",true);
	define("HNG_ID","HNG-01858",true);
	define("EMAIL", "selloclinton@gmail.com",true);
	$language = "php";
	
	
	echo "Hello World, this is ".FULL_NAME." with HNGi7 ID ".HNG_ID;
	echo " using ".$language " for stage 2 task ".EMAIL;
?>