<?php

$json = $_SERVER["QUERY_STRING"] ?? '';
$files = scandir("scripts/");
unset($files[0]);
unset($files[1]);



$output = [];

foreach ($files as $file) {
  $extension = explode('.', $file);
  // Initialize output template for JSON
  $json_object = ['name' => '', 'id' => '', 'language' => '', 'status' => '', 'output' => '', 'file' => '', 'email' => ''];
  $script_types = ['php' => 'php', 'js' => 'node', 'py' => 'python'];

  //skip unsupported file formats
  if (!array_key_exists($extension[1], $script_types)) {
    echo 'files with extension .' . $extension[1] . ' not allowed';
  } else {
    $run = $script_types[$extension[1]];
    $file_output = exec($run . " scripts/" . $file);
    var_dump($run);

    /**We are trying to capture all the important info needed for the JSON output  */
    if (preg_match('/Hello World, this is (.*?) with HNGi7 ID (.*?) using (.*?) for stage 2 task (.*)/', $file_output, $match) == 1) {

      /**Here, we want to remove the email part from the string before testing with Regex */
      $string_to_test = substr_replace($file_output, 'task', strpos($file_output, 'task'));

      $json_object['name'] = $match[1];
      $json_object['id'] = $match[2];
      $json_object['language'] = $match[3];
      $json_object['status'] = testFileContent($string_to_test);
      $json_object['output'] = $string_to_test;
      $json_object['file'] = $file;
      $json_object['email'] = $match[4];
    }
    var_dump($json_object);
    array_push($output, $json_object);
  }
}


function testFileContent($string)
{
  if (preg_match('/^Hello\sWorld[,|.|!]*\sthis\sis\s[a-zA-Z]{2,}\s[a-zA-Z]{2,}(\s[a-zA-Z]{2,})?\swith\sHNGi7\sID\s(HNG-\d{3,})\susing\s[a-zA-Z]{3,}\sfor\sstage\s2\stask.?$/i', trim($string))) {
    return 'Pass';
  }
  return 'Fail';
}
ob_end_flush();





if (isset($json) && $json == 'json') {
  echo json_encode($output);
} else {
?>
  <html>

  <head>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
  </head>

  <body>
    <!-- <h1>Script Format:</h1> -->
    <div class="container">
      <?php

      foreach ($output as $out) {
        $color = $out['status'] == 'Pass' ? 'green' : 'red';
        $name = $out['name'];
        $message = $out['output'];
        $status = $out['status'];
        $id = $out['id'];
        echo <<<EOL
          <div class="container-item $color">
            <p>$name</p>
            <p>$id</p>
            <p>$status</p>
          </div>
        EOL;
      }
      ?>
    </div>
  </body>

  </html>
<?php
}
ob_start();
?>