
<?php
$json = $_SERVER["QUERY_STRING"] ?? '';
$checkArray=array();
array_push(($checkArray),"Hello","World,", "this", "is", "with", "HNGi7","ID", "using", "for" ,"stage" ,"2" ,"task");
foreach(glob('scripts/*.php')as $filename){
  $r=shell_exec("/usr/bin/php $filename");
$array[$filename]=$r;
}

foreach(glob('scripts/*.js')as $filename){
  $r=shell_exec("node $filename");
$array[$filename]=$r;
}


foreach(glob('scripts/*.py')as $filename){
  $r=shell_exec("python $filename");
  $array[$filename]=$r;
}
$jsonarray=array();
$pass=0;
$total=sizeof($array);$b=0;
foreach($array as $key=>$value)
{
  // Hello World, this is somto with HNGi7 ID HNG-04817 using Python for stage 2 task somto@gmail.com 

$x=explode(" ",$value);
$length=sizeof($x);
$m=0;
$name="";
$id="";
$email="";
$lang="";
$f=explode("/",$key);
$file=$f[1];
$res=0;$em=0;

$output="$array[$key]";
for($i=0;$i<$length;$i++)
{if(isset($checkArray[$m])){
	if($x[$i]==$checkArray[$m])
	{
		//echo "<pre>this:$m=$x[$i]</pre>";
		$m++;$res++;
	}
	else if($m==4)
	{
		$name=$name.$x[$i];
	}
	else if($m==7)
	{
		$id=$x[$i];
	}
	else if($m==8)
	{
		$lang=$x[$i];
	}
	
     else
     {
     //echo "<pre>$m=$x[$i]</pre>";
      $m++;
     }

  
   }
   else if(isset($x[$i]))
   {
   
    $email=$x[$i];
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
if (preg_match($regex, $email)) {
 //echo $email ;
  $em=1;
} else { 
 //echo $email . " is an invalid email. Please try again.";
}

}

}
$status="Fail";
//echo "<pre>$b============$res $em</pre>";
if($res==12&&$em==1)
{if($email!=" "){
$status="Pass"; $pass++;}
}
 
$newarray=array("file"=> "$file","output"=> "$output","name"=>"$name","id"=> "$id","email"=> "$email","language"=> "$lang","status"=> "$status");

array_push(($jsonarray),$newarray);

}
$myJSON = json_encode($jsonarray);

ob_end_flush();

    if (isset($json) && $json == 'json') {
        echo $myJSON;
    } else {
?>
<!DOCTYPE html>
<html>
<head>
  <title>WONDER WOMAN</title>
  <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
.tt
{
  background-color: green;
}
.tti
{
  background-color: red;

}
</style>
</head>
<body>
<h2>total<?php echo ": $total"?></h2>
<h2>pass<?php echo ": $pass"?></h2>
<h2>fail<?php $fail=$total-$pass;echo ":$fail "?></h2>


<table>
  <tr><th>sno</th>
    <th>file</th>
    <th>Name</th>
    <th>OUTPUT</th>
  <th>Status</th>
  </tr>
  <?php
  $d=0;
foreach($jsonarray as $key=>$value)
{$rr=array();$d++;
  array_push($rr,$jsonarray[$key]);
  $o=$rr[0]["file"];
  $t=$rr[0]["name"];
    $e=$rr[0]["output"];
    $s=$rr[0]["status"];
    if($e=="")
    {$e="Nothing is printed";
    $t="nothing";
      echo " <tr class='tti'>
    <td>$d</td>
    <td>$o</td>
    <td>$t</td>
    <td>$e</td>
    <td>$s</td>
  </tr>";
    }else{
    if($s=="Pass"){
 echo " <tr class='tt'>
<td>$d</td>
    <td>$o</td>
    <td>$t</td>
    <td>$e</td>
    <td>$s</td>
  </tr>";}
  else
  {
    echo " <tr class='tti'>
    <td>$d</td>
    <td>$o</td>
    <td>$t</td>
    <td>$e</td>
    <td>$s</td>
  </tr>";
  }
}}
  ?>
</table>
</body>
</html>
<?php } ?>

