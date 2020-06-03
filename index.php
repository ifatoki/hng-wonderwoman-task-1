<?php
$json = $_SERVER["QUERY_STRING"] ?? '';
$checkArray=array();
array_push(($checkArray),"Hello","World,", "this", "is", "with", "HNGi7","ID","and" ,"email" , "using", "for" ,"stage" ,"2" ,"task");
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
$total=sizeof($array);
foreach($array as $key=>$value)
{
  // Hello World, this is somto with HNGi7 ID HNG-04817 and email somto@gmail.com using Python for stage 2 task

$x=explode(" ",$value);
$length=sizeof($x);
$m=0;
$name="";
$id="";
$email="";
$lang="";
$f=explode("/",$key);
$file=$f[1];
$res=0;
$output="$array[$key]";
for($i=0;$i<$length;$i++)
{
	if($x[$i]==$checkArray[$m])
	{
		
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
	else if($m==9)
	{
		$email=$x[$i];
	}
	else if($m==10)
	{
		$lang=$x[$i];
	}
     else
     {
     	$m++;
     }

}
$status="Fail";
//echo "<pre>$res</pre>";
if($res==13)
{
$status="Pass"; $pass++;
}
 
$newarray=array("file"=> "$file","output"=> "$output","name"=>"$name","id"=> "$id","email"=> "$email","language"=> "$lang","status"=> "$status");

array_push(($jsonarray),$newarray);

}
$myJSON = json_encode($jsonarray);
//print_r($jsonarray);
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
  <tr>
    <th>Email</th>
    <th>OUTPUT</th>
  <th>Status</th>
  </tr>
  <?php
foreach($jsonarray as $key=>$value)
{$rr=array();
	array_push($rr,$jsonarray[$key]);
	$t=$rr[0]["name"];
    $e=$rr[0]["output"];
    $s=$rr[0]["status"];
    if($s=="Pass"){
 echo " <tr class='tt'>
    <td>$t</td>
    <td>$e</td>
    <td>$s</td>
  </tr>";}
  else
  {
  	echo " <tr class='tti'>
    <td>$t</td>
    <td>$e</td>
    <td>$s</td>
  </tr>";
  }
}
  ?>
</table>
</body>
</html>
<?php } ?>
