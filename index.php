<?php
$json = $_SERVER["QUERY_STRING"] ?? '';
$files = scandir("scripts/");
unset($files[0]);
unset($files[1]);
$success = 0;
$failure = 0;


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
    // var_dump($run);

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
    // var_dump($json_object);
    array_push($output, $json_object);
  }
}

foreach ($output as $status) {
    if ($json_object['status'] == 'Pass') {
        $success++;
    } elseif ($json_object['status'] == 'Fail') {
        $failure++;
    }
}

function testFileContent($string)
{
    if (preg_match('/^Hello\sWorld[,|.|!]*\sthis\sis\s[a-zA-Z]{2,}\s[a-zA-Z]{2,}(\s[a-zA-Z]{2,})?\swith\sHNGi7\sID\s(HNG-\d{3,})\susing\s[a-zA-Z]{3,}\sfor\sstage\s2\stask.?$/i', trim($string))) {
    return 'Pass';
  }
    // if (preg_match('/^Hello\sWorld[,|.|!]?\sthis\sis\s[a-zA-Z]{2,}\s[a-zA-Z]{2,}(\s[a-zA-Z]{2,})?\swith\sHNGi7\sID\s(HNG-\d{3,})\susing\s[a-zA-Z|#]{2,}\sfor\sstage\s2\stask\s[a-zA-Z|#]*@[a-z0-9-]+(\.[a-z0-9-]+).?$/i', trim($string))) {
    //     return 'Pass';
    // }
    return 'Fail';
}

ob_end_flush();

    if (isset($json) && $json == 'json') {
        echo json_encode($output);
    } else {
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Stage 2 Task</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
        </head>
        

        <body>
            <div class="container-fluid">
                <nav class="navbar navbar-light  fixed-top" style="background-color: #FFF;">
                    <span class="navbar-text bold">
                        HNGi7 Team Wonder Woman
                    </span>
                    <div class="float-right text-white">
                        <small class="text-dark">
                            Leader: <span class="btn btn-sm btn btn-outline-primary">@Xt</span>
                        </small> &nbsp;
                        <small class="text-dark">
                            FrontEnd: <span class="btn btn-sm btn btn-outline-success">@Haneefah</span>
                        </small> &nbsp;
                        <small class="text-dark">
                            DevOps: <span class="btn btn-sm btn btn-outline-info">@Itunuloluwa</span>
                        </small> &nbsp;
                    </div>
               </nav>
            </div>

            <div class="container padding-t">
                <div class="row  border mb-4">
                      <div class="col-md-4">
                        <div class="stati turquoise ">
                          <i class="fa fa-calculator"></i>
                          <div>
                            <span class="bold">Total Submitted</span>
                            <b><?php echo($success + $failure)  ?></b>
                            
                          </div> 
                        </div>
                      </div> 
                      <div class="col-md-4">
                        <div class="stati bg-turquoise ">
                          <i class="fa fa-check-circle"></i>
                          <div>
                            <span class="bold text-white">Total Passes</span>
                            <b><?php echo $success; ?></b>
                          </div> 
                        </div>
                      </div> 
                      <div class="col-md-4">
                        <div class="stati bg-alizarin  ">
                          <i class="fa fa-times-circle"></i>
                          <div>
                            <span class="bold text-white">Total Fail</span>
                            <b><?php echo $failure; ?></b>
                          </div> 
                        </div>
                      </div> 
                </div>

                <h4 class="text-light">Script Format:</h4>
               
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Messages</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn =1;
                                foreach ($output as  $value) {

                                  
                                    
                                    //extraction of email from string
                                    $name = $value['name'];
                                    $message = $value['output'];
                                    $email = $value['email'];
                                    $status = $value['status'];
                                    $id = $value['id'];

                                    if ($status == 'Pass') {
                                        $color = 'green';
                                    } else {
                                        $color = 'red';
                                    }

                                    // $string = $value[0];
                                    // $email_pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
                                    // preg_match_all($email_pattern, $string, $em_matches); ?>

                                    <?php //echo <<<EOL ?>
                                        <tr class="bold <?php echo $color; ?>">
                                            <td><?php echo $sn++;  ?></td>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $email;?></td>
                                            <td><?php echo $message;?></td>
                                            <td>
                                              <?php echo $status;?>
                                              <?php
                                                    if ($status == 'Pass') {
                                                        echo "<span class='text-success'>✔</span>";
                                                    } else {
                                                        echo "<span class='text-danger'>✖</span>";
                                                    } ?>
                                            </td>
                                        </tr>
                                   <?php //} EOL; ?>
                                <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
            

        </body>
     
    <!-- END: Page JS-->
        </html>
<?php } ob_start(); ?>

    <script src="js/vendors.min.js"></script>
    <script src="js/datatables.min.js"></script>

    <script src="js/datatables.bootstrap4.min.js"></script>
    <script >
        $(function() {
            $("#example1").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
            });
        });
    </script>

