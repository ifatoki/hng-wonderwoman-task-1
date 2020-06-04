<?php
header('Content-Type: application/json');
function refine($output, $pattern, $filename)
{
    $filename_array = explode('/', $filename);
    $filename = $filename_array[1];
    $pass = preg_match($pattern, $output);
    if ($pass) {
        $status = "pass";
        $array_of_sentence = explode(" ", $output);
        $email = trim(end($array_of_sentence));
    } else {
        $status = "fail";
        $email = 'nil';
    }
    $id_search = preg_match('/HNG-\d{5}/', $output, $id_array);
    if ($id_search) {
        $hng_id = $id_array[0];
    } else {
        $hng_id = 'nill';
    }
    $name_search = preg_match('/\bis (.{1,}\s)+with/', $output, $name_array);
    if ($name_search) {
        $name = $name_array[1];
    } else {
        $name = 'nill';
    }
    $lang_search = preg_match('/using (.*) for/', $output, $lang_array);
    if ($lang_search) {
        $language = $lang_array[1];
    } else {
        $language = 'nill';
    }
    $result = array('file' => $filename, 'output' => trim($output), 'name' => $name, 'id' => $hng_id, 'email' => $email, 'language' => $language, 'status' => $status);
    return $result;
}
$pattern = '/^Hello World, this is (.{1,}\s)+with HNGi7 ID HNG-\d{5} using (.*) for stage 2 task (?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))\s*\n*$/i';
$data = array();
foreach (glob('scripts/*.js') as $filename) {
    $output = shell_exec("node $filename");
    $output_array = refine($output, $pattern, $filename);
    array_push($data, $output_array);
}

foreach (glob('scripts/*.py') as $filename) {
    $output = shell_exec("python3 $filename");
    $output_array = refine($output, $pattern, $filename);
    array_push($data, $output_array);
}
foreach (glob('scripts/*.php') as $filename) {
    $output = shell_exec("php $filename");
    $pass = preg_match($pattern, $output);
    $output_array = refine($output, $pattern, $filename);
    array_push($data, $output_array);
}

$encodedJSON = json_encode($data, JSON_PRETTY_PRINT);
echo $encodedJSON;

$pass_count = 0;
$total_cases = 0;
foreach ($data as $info) {
    if ($info['status'] == 'pass') {
        $pass_count = $pass_count + 1;
    }
}

// echo $pass_count . 'passed';
// echo count($data) . 'cases';