<?php

header('Content-type: text/plain');
$hngid='HNG-01819';
$name='Mercy Kipyegon';
$email="mercyjemosop@gmail.com";
$language="PHP";
$hello= "Hello world, this is ".$name." with HNGi7 ID ".$hngid. " using ".$language. " for stage 2 task ".$email;

print json_encode($hello);

?>