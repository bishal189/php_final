<?php
// print_r($_SESSION);
if (!isset($_SESSION['isStudent']) && $_SESSION['isStudent'] != 'true') {
    header('location:student_login.php');
}
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'submit') {
        $id = $_POST['assignment'];
        $deadline = $obj->select('tbl_create_assignment', 'deadline', 'id', array($id));
        $deadline = $deadline[0]['deadline'];

        if ($_POST['submitted_date'] > $deadline) {
            $_SESSION['error'] = "You've crossed deadline. Don't exceed the deadline from next time";
            header('location:submit_assignment.php');
            exit();
        }

        $assi_id = $_POST['assignment'];
        $assi_id = $_POST['assignment'];

        $studentt = $_SESSION['submitted_by'];
         

        $check = $obj->Query("SELECT * FROM  tbl_submit_assignment WHERE  assignment = '$assi_id' and submitted_by = '$studentt'");

        if ($check) {
            $_SESSION['assiError'] = "You've already submitted this assignment!";
        } else {



            $imgName = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = 'submit_assignment' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location); //upload file
            array_pop($_POST); //popping submit form post
            $_POST['file'] = $imgName;
$_POST['tid'] = 5;
echo $_POST['tid'];
die;
            if ($obj->Insert("tbl_submit_assignment", $_POST)) {
                $_SESSION['create'] = "Assignment submitted successfully!";
            } else {
                echo "fail";
                echo "<script> window.location.href='" . base_url('view_assignment_status.php') . "'</script>";
            }
        }
    }
}

include('studentheader.php');
?>
<style>
    label {
        font-size: 17px;
        font-family: roboto, sans-serif;
    }
</style>

<div class="container" style="min-height:80vh;"><br>
    <div class="row justify-content-start">
        <div class="col-md-8 shadow p-0">
            <div class="card shadow">
                <?php if (isset($_SESSION['create'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['create'];
                        unset($_SESSION['create']);  ?>
                    </div>
                <?php }  ?>

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']);  ?>
                    </div>
                <?php }  ?>
                <div class="card-header text-left pb-0  mb-0">
                    <h4 class=""> Submit Assignment</h4><br>
                </div>
            </div>

            <div class="card-body">

                <form action="" method="post" id="form" class="form-group" enctype="multipart/form-data">
               
                    <div class="form-group">
                        <?php

                        if (isset($_GET['id'])) {
                            $sub = $obj->select('tbl_create_assignment', '*', 'id', array($_GET['id']));
                        }
                        // print_r($sub);
                        ?>
                        <label class="font-weight-bold"><span>Assignment Title : </span></label>
                        <span><?php if (isset($sub[0]['id'])) echo $sub[0]['title']; ?></span>
                        <input type="hidden" name="assignment" value="<?php if (isset($old)) {
                                                                            echo $old['assignment'];
                                                                        } ?>">

                        <?php if (isset($_SESSION['assiError'])) { ?>
                            <a class="text-danger my-2 d-block">
                                <?php
                                echo $_SESSION['assiError'];
                                unset($_SESSION['assiError']); ?>
                            </a>
                        <?php } ?>

                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><span>Description :</span></label>
                        <span><?php if (isset($sub[0]['id'])) echo $sub[0]['description']; ?></span>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <?php

                        if (isset($_GET['id'])) {
                            $sub = $obj->select('tbl_create_assignment', '*', 'id', array($_GET['id']));
                        }
                        // print_r($sub);
                        ?>


                        <input type="hidden" name="assignment" readonly class="form-control" value="<?php if (isset($sub[0]['id'])) echo $sub[0]['id']; ?>">



                        <div class="form-group">
                            <input type="hidden" name="submitted_date" value="<?php echo date('Y-m-d') ?>" id="issueDate" class="form-control" readonly>
                            <a style="color:red" id="issueDateError"></a>

                        </div>

                        <div class="form-group" style="margin-top:-3rem">
                            <label class="font-weight-bold">Upload your file</label>
                            <input type="file" name="image" class="form-control" id="filename">

                            <a style="color:red" id="fileError"></a>

                        </div>




                        <!--For showing alert message -------------------------->
                        <?php if (isset($_SESSION['create'])) { ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['create'];
                                unset($_SESSION['create']);  ?>
                            </div>
                        <?php }  ?>

                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);  ?>
                            </div>
                        <?php }  ?>
                        <!------------------------End----------------------------->


                        <style>
                            button {
                                font-family: poppins, sans-serif;
                            }
                        </style>


                        <input type="hidden" name="submitted_by" value="<?php if (isset($_SESSION['submitted_by'])) {
                                                                            echo $_SESSION['submitted_by'];
                                                                        }
                                                                        ?>">
                        <button class="btn  btn-success" name="submit" value="submit" onclick="return validate()"> Submit </button>
                </form>

            </div>


        </div>
    </div>
</div>
<div style="height:14vh">
</div>


<script>
    function validate() {





        // file validation
        var val = document.getElementById('filename').value;
        if (val == '' | null) {
            document.getElementById('fileError').innerHTML = 'File must be attached!';
            return false;
        } else {
            document.getElementById('fileError').innerHTML = '';

        }

        // submission data validation
        var sD = document.getElementById('submissionDate').value;
        if (sD == '' | null) {
            document.getElementById('subDateError').innerHTML = 'Submission date is required!';
            return false;
        } else {
            document.getElementById('subDateError').innerHTML = '';

        }

        if (isD >= sD) {
            document.getElementById('subDateError').innerHTML = 'Submission date must be greater than issue date!';
            return false;
        } else {
            document.getElementById('subDateError').innerHTML = '';

        }



    }

    $(document).ready(function() {
        $('#subject').on('change', function() {
            var aid = $(this).val();
            var data = {
                aid: aid
            }
            $.ajax({
                type: "POST",
                url: 'get_deadline.php',
                data: data,
                success: function(e) {
                    $('#deadline').html(e);
                }
            })
        })
    })



    $(document).ready(function() {
        $('#subject').on('change', function() {
            var aid = $(this).val();
            var data = {
                aid: aid
            }
            $.ajax({
                type: "POST",
                url: 'get_issued_date.php',
                data: data,
                success: function(e) {
                    $('#date_of_issued').html(e);
                }
            })
        })
    })
</script>