<?php
$json = $_SERVER["QUERY_STRING"] ?? '';
$files = scandir("scripts/");

unset($files[0]);
unset($files[1]);
$output = [];
$output2 = [];
$outputJSON = [];
$data = [];
$success = 0;
$failure = 0;

foreach ($files as $file) {
  $filename = $file;
    $extension = explode('.', $file);

    switch ($extension[1]) {
        case 'php':
            $startScript = "php";
            break;
        case 'js':
            $startScript = "node";
            break;
        case 'py':
            $startScript = "python";
            break;
    }


    $f = exec($startScript . " scripts/".$file);

    @$data[$extension[0]]->content = $f;
    $data[$extension[0]]->status = testFileContent($f);
    $data[$extension[0]]->name = $extension[0];

    // Get email
    $array_of_sentence = explode(" ", $f);
    $email = trim(end($array_of_sentence));

    // Get name
    $name_search = preg_match('/\bis (.{1,}\s)+with/', $f, $name_array);
    if ($name_search) {
        $name = $name_array[1];
    } else {
        $name = 'nill';
    }

    // Get ID
    $id_search = preg_match('/HNG-\d{5}/', $f, $id_array);
    if ($id_search) {
        $hng_id = $id_array[0];
    } else {
        $hng_id = 'nill';
    }

    $output[] = [$f, testFileContent($f), $filename, $extension[1], $name, $email, $hng_id];


    $output2[] = array('file' => $filename, 'output' => $f, 'name' => $name, 'id' => $hng_id, 
      'email' => $email, 'language' => $extension[1], 'status' => testFileContent($f));



    // $startScript = ['php' => 'php',  'py' => 'python', 'js' => 'node'];
    // if (!array_key_exists($extension[1], $startScript)) {
    //     echo 'files with extension .' . $extension[1] . ' not allowed';
    // } else {
    //     $run = $startScript[$extension[1]];
    //     // $file_output = exec($run . " scripts/" . $file);

    //     $f = exec($run . " scripts/" . $file);

    //     @$data[$extension[0]]->content = $f;
    //     $data[$extension[0]]->status = testFileContent($f);
    //     $data[$extension[0]]->name = $extension[0];
    //     $output[] = [$f, testFileContent($f), $extension[0], $extension[1]];
    // }
}

foreach ($output as $status) {
    if ($status[1] == 'Pass') {
        $success++;
    } elseif ($status[1] == 'Fail') {
        $failure++;
    }
}


function testFileContent($string)
{
    if (preg_match('/^Hello World, this is (.{1,}\s)+with HNGi7 ID HNG-\d{5} using (.*) for stage 2 task (?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/i', trim($string))) {
        return 'Pass';
    }
    return 'Fail';
}

// echo '<pre>';
// print_r($output);
// echo '</pre>';


if (isset($json) && $json == 'json') {
    header('Content-Type: application/json');
    // return $result;
    echo json_encode($output2, JSON_PRETTY_PRINT);
} else {
?>
<?php ob_end_flush(); ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Stage 2 Task</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/animate.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            <b><?php echo ($success + $failure)  ?></b>

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
            <ul class="alert message clearfix">
                    <h2 class="animated flash infinite bold text-center">Attention!!! Attention!!! Attention!!! </h2>
                  <strong>Please ensure that your output redered certifies through the instructions below:</strong>
                    <div class="text-uppercase"><u>Message Pattern</u></div>
                    
                    <li>👉 Ensure you have no exclamation mark [!] after Hello World</li>
                    <li>👉 Ensure you have only two names [Firstname and lastname] only</li>
                    <li>👉 Ensure you have no full stop after the phrase [task]</li>
                    <li>👉 Ensure you added an email address to</li>
                    <div> See example below</div>
                    <li>👉 Hello World, this is <b class="text-dark">Ciroma Adekunle</b> with HNGi7 ID <b class="text-dark">HNG-1010</b> using <b class="text-dark">Javascript</b> for stage 2 task <b class="text-dark">abc@example.com</b></li>
                  
                  <span class="float-right">Enter your id to find your project 👇</span>
            </ul>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>S/N</th>
                            <th>File Name</th>
                            <th>file type</th>
                            <!-- <th>Action step</th> -->
                            <th>Email</th>
                            <th>Messages</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sn = 1;
                        foreach ($output as  $value) {
                            if ($value[1] == 'Pass') {
                                $color = 'green';
                            } else {
                                $color = 'red';
                            }
                            //extraction of email from string
                            $string = $value[0];
                            $email_pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
                            preg_match_all($email_pattern, $string, $em_matches);



                            $content_pattern = '/Hello World, this is (.*?) with HNGi7 ID (.*?) using (.*?) for stage 2 task (.*)/';
                            preg_match_all($content_pattern, $string, $match)


                            // echo '<pre>';
                            // print_r($em_matches[0]);
                            // echo '</pre>';


                        ?>


                            <tr class="bold <?php echo $color; ?>">
                                <td><?php echo $sn++; ?></td>

                                <td><?php
                                    echo $value[2] ?? '';
                                    // echo str_replace("-", " ", $value[2]) ?? '';
                                    ?></td>
                                <td><?php echo $value[3]; ?></td>

                                <td><?php
                                    if (!empty($em_matches[0]) && isset($email_pattern)) {
                                        echo $em_matches[0][0];
                                    } elseif (empty($em_matches[0]) && empty($value[0])) {
                                        echo ' Email is empty and 👉';
                                    } elseif (empty($em_matches[0]) && !empty($value[0])) {
                                        echo ' Email empty';
                                    } elseif (empty($em_matches[0]) && !isset($email_pattern)) {
                                        echo 'Email Pattern not match';
                                    }
                                    ?></td>
                                <td>
                                    <?php
                                    if (empty($value[0])) {
                                        echo 'Content not rendered properly';
                                    } elseif (!empty($value[0])) {
                                        echo $value[0];
                                    } elseif (!empty($value[0]) && !isset($content_pattern)) {
                                        echo 'Messages pattern not match';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo  $value[1] ?>
                                    <?php
                                    if ($value[1] == 'Pass') {
                                        echo "<span class='text-success'>✔</span>";
                                    } else {
                                        echo "<span class='text-danger'>✖</span>";
                                    } ?>
                                </td>
                            </tr>

                        <?php
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>


    </body>

    <!-- END: Page JS-->
    <script src="js/vendors.min.js"></script>
    <script src="js/datatables.min.js"></script>

    <script src="js/datatables.bootstrap4.min.js"></script>
    <script>
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

    </html>
<?php }
ob_start(); ?>

