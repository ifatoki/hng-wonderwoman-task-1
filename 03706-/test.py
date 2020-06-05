Python 3.8.2 (tags/v3.8.2:7b3ab59, Feb 25 2020, 22:45:29) [MSC v.1916 32 bit (Intel)] on win32
Type "help", "copyright", "credits" or "license()" for more information.
>>> 
= RESTART: C:/Users/SARAH AYIM/AppData/Local/Programs/Python/Python38-32/Index.php.py
Hello World, this is Sarah Anyim with HNGi7 ID 03706 using Python for stage 2 task
>>> 
= RESTART: C:/Users/SARAH AYIM/AppData/Local/Programs/Python/Python38-32/Index.php.py
Hello World, this is Sarah Anyim with HNGi7 ID 03706 using Python for stage 2 task anyimsarah@gmail.com
>>> 
<?php 
$dir = getcwd(); 

if (is_dir($dir)){ 
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		$command = escapeshellcmd($file);
		$output = exec($command); 
		flush(); echo "<b>filename:</b>  " . $file . "<br>";
		if($output!==0){
			echo 'Pass <br>';	
			flush ();echo $output . "<br>";
		}
		else{
			echo 'Fail<br><br>';
		}
	}
    closedir($dh);
  }
}
?>


