<?php

header('Content-type: text/plain');
$hngid='HNG-01819';
$name='Mercy Kipyegon';
$email="mercyjemosop@gmail.com";
$language="PHP";
$hello= "Hello world, this is ".$name.", Email ".$email." with HNGi7 ID ".$hngid. " using ".$language. " for stage 2 task, ";
$str=array($hello, "name"=>$name, "id"=>$hngid,  "email"=>$email, "language"=>$language);
print json_encode($str);

?>