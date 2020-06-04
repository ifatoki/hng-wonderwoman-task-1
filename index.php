<?php
$json = $_SERVER["QUERY_STRING"] ?? '';
$files = scandir("scripts/");

unset($files[0]);
unset($files[1]);
$output = [];
$outputJSON = [];
$data = [];
$success = 0;
$failure = 0;

foreach ($files as $file) {
    $extension = explode('.', $file);
    $startScript = ['php' => 'php',  'py' => 'python'];

    if (!array_key_exists($extension[1], $startScript)) {
        echo 'files with extension .' . $extension[1] . ' not allowed';
    } else {
        $run = $startScript[$extension[1]];
        // $file_output = exec($run . " scripts/" . $file);
        $f = exec($run . " scripts/" . $file);

        $regex_result = testFileContent($f);
        if ($regex_result === 'Pass') {
            $action_step = 'Good job ' . $extension[0] . ' your output is fine 😃';
        } elseif ($regex_result === 'Fail') {
            if (!strpos('@', $f)) {
                $action_step = $extension[0] . ' please include email in your output to pass this test';
            }
        }

        $data[$extension[0]]->content = $f;
        $data[$extension[0]]->status = $regex_result;
        $data[$extension[0]]->name = $extension[0];
        $output[] = [$f, $regex_result, $extension[0], $extension[1], $action_step];
    }
}

foreach ($output as $status) {
    if ($status[1] == 'Pass') {
        $success++;
    } elseif ($status[1] == 'Fail') {
        $failure++;
    }
}


// function extract_emails_from($string) {
//          preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
//          return $matches[0];
// }

// foreach($emails as $email) {
//     echo trim($email).'<br/>';
// }

function testFileContent($string)
{
    if (preg_match('/^Hello\sWorld[,|.|!]?\sthis\sis\s[a-zA-Z]{2,}\s[a-zA-Z]{2,}(\s[a-zA-Z]{2,})?\swith\sHNGi7\sID\s(HNG-\d{3,})\susing\s[a-zA-Z|#]{2,}\sfor\sstage\s2\stask\s[\.^A-Za-z0-9\s]*@[a-z0-9-]+(\.[\.^A-Za-z0-9\s]+).?$/i', trim($string))) {
        return 'Pass';
    }
    return 'Fail';
}

// ob_end_flush();
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

            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>S/N</th>
                            <th>File Name</th>
                            <th>file type</th>
                            <th>Action step</th>
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
                            preg_match_all($email_pattern, $string, $em_matches); ?>


                            <tr class="bold <?php echo $color; ?>">
                                <td><?php echo $sn++; ?></td>

                                <td><?php
                                    echo $value[2] ?? '';
                                    // echo str_replace("-", " ", $value[2]) ?? '';
                                    ?></td>
                                <td><?php echo $value[3]; ?></td>
                                <td><?php echo $value[4]; ?></td>
                                <td><?php echo $em_matches[0][0] ?? ''; ?></td>
                                <td><?php echo  $value[0] ?></td>
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

    </html>
<?php }
ob_start(); ?>

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