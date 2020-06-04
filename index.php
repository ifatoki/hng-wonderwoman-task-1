<?php
// $pattern = '/Hello World, this is [.*\s*]+with HNGi7 ID HNG-[\d*] using [.*] for stage 2 task/';
$pattern = '/Hello World, this is (.{1,}\s)+with HNGi7 ID HNG-\d{5} using (.*) for stage 2 task (.+)@(.+).(com|COM)$/';
foreach (glob('scripts/*.js') as $filename) {
    $r = shell_exec("node $filename");
    $parts = preg_match($pattern, $r);
    echo $r . "</br>" . $parts . "</br>";
}

foreach (glob('scripts/*.py') as $filename) {
    $r = shell_exec("python3 $filename");
    $parts = preg_match($pattern, $r);
    echo $r . "</br>" . $parts . "</br>";
}
foreach (glob('scripts/*.php') as $filename) {
    $r = shell_exec("php $filename");
    $parts = preg_match($pattern, $r);
    echo $r . "</br>" . $parts . "</br>";
}

$sample = 'Hello World, this is Onifade Boluwatife with HNGi7 ID HNG-12345 using python for stage 2 task';
$test = preg_match($pattern, $sample);
echo ($test);
// $pattern = "/[.*\s*]+/";
// $text = "My favourite colors are red, green and blue";
// $parts = preg_match($pattern, $text);

// echo $parts;

// $pattern = "/ca[kf]e/";
// $text = "He was eating cake in the cafe.";
// $matches = preg_match_all($pattern, $text, $array);
// echo $matches . " matches were found."