<?php

$assi_detail = $obj->select('tbl_create_assignment', '*', 'id', array($_GET['aid']));
$loggedInStudent  =  $_SESSION['submitted_by'];


if ($assi_detail) {
    $aid = $_GET['aid'];
    $checkIsSubmitted = $obj->Query("SELECT * from tbl_submit_assignment WHERE assignment = '$aid' and submitted_by = '$loggedInStudent'");

    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == 'submitAssi') {

            $id = $_GET['aid'];
            $deadline = $obj->select('tbl_create_assignment', 'deadline', 'id', array($id));
            $deadline = $deadline[0]['deadline'];

            if ($_POST['submitted_date'] > $deadline) {
                $_SESSION['error'] = "You've crossed deadline ! Please submit your assignment in time.";
            } else {
                $assi_id = $_GET['aid'];
                $assi_id = $_GET['aid'];
                $studentt = $_SESSION['submitted_by'];

                $check = $obj->Query("SELECT * FROM  tbl_submit_assignment WHERE  assignment = '$assi_id' and submitted_by = '$studentt'");

                if ($check) {
                    $_SESSION['assiError'] = "You've already submitted this assignment !";
                } else {
                    $imgName = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $location = 'submit_assignment' . '/' . $imgName;
                    move_uploaded_file($tmp_name, $location); //upload file
                    array_pop($_POST); //popping submit form post
                    $_POST['file'] = $imgName;

                    $_POST['assignment'] = $_GET['aid'];

                    $_POST['submitted_by'] = $_SESSION['submitted_by'];


                    if ($obj->Insert("tbl_submit_assignment", $_POST)) {
                        echo "<script>alert('Assignment submitted successfully')</script>";
                        echo "<script> window.location.href='" . base_url('assignment-detail.php?aid=' . $aid) . "'</script>";
                        $_SESSION['create'] = "";
                    } else {
                        echo "fail";
                        echo "<script> window.location.href='" . base_url('view_assignment_status.php') . "'</script>";
                    }
                }
            }
        }
    }


    // setcookie("username", $loggedInStudent, time() + (30 * 24 * 60 * 60), "/");

    $isViewedBy = $_SESSION['student'];
    $isViewed = $obj->Query("SELECT * from tbl_student_login where username = '$isViewedBy'");

    $viewerId = $isViewed[0]->sid;

    $check = $obj->Query("SELECT * from viewers where aid = $aid and sid = $viewerId");

    if (!$check) {
        $action = $obj->Query("INSERT INTO viewers (sid, aid) VALUES ('$viewerId', '$aid')");
    }
}


?>

<div class="container-fluid px-4 bg-white my-5">
    <div class="row">
        <?php
        if ($assi_detail) { ?>

            <div class="col-lg-12 mb-3">
                <!-- //scuccess/ -->
                <?php if (isset($_SESSION['create'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['create'];
                        unset($_SESSION['create']);  ?>
                    </div>
                <?php }  ?>



            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="create_assignment/<?= $assi_detail[0]['file']; ?>"><img src="create_assignment/<?= $assi_detail[0]['file']; ?>" alt="" class="img-fluid p-3 mx-2"> </a>
                    </div>

                    <div class="col-lg-9">
                        <div class="row">
                            <div <?php if ($checkIsSubmitted) { ?> class="col-lg-10 d-flex mb-3" <?php } else { ?> class="col-lg-6 d-flex mb-3" <?php } ?>>
                                <div class="card card-body my-3">
                                    <p> <span class="text-info"><i class="fas fa-pen "></i> <?= $assi_detail[0]['created_date'] ?></span> </span></p>
                                    <h4><?= $assi_detail[0]['title'] ?></h4>
                                    <strong class="position-absolute text-danger" style="right:55px"> Due : <?= $assi_detail[0]['deadline'] ?> </strong>

                                    <div class="qn" style="height:30vh;overflow:hidden;overflow-y:scroll">
                                        <?= $assi_detail[0]['description'] ?>
                                    </div>
                                    <?php

                                    if ($checkIsSubmitted) { ?>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-success readonly">
                                                Submitted <strong><i class="fas fa-check"></i></strong>
                                            </span>

                                            <a href="<?= base_url('view_assignment_status.php'); ?>">
                                                <button class="btn btn-light readonly">
                                                    View<strong> <i class="fas fa-eye"></i></strong>
                                                </button></a>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <style>
                                .qn::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            <?php
                            if (!$checkIsSubmitted) { ?>
                                <div class="col-lg-6 d-flex mb-3">
                                    <form action="" method="POST" enctype="multipart/form-data" class="my-3 bg-light p-3">
                                    <input type="hidden" name="tid" value="<?= $assi_detail[0]['tid'] ?>  " >

                                    <div class="form-group mb-3">
                                            <label style="font-family: nunito, sans-serif;font-weight:600">Write your answer</label><br>
                                            <textarea rows="3" cols="50" name="description" id="assignment_desc" class="form-control"></textarea>
                                            <a style="color:red" id="descError"></a>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="filee" class="font-weight-bold">Upload your file</label>
                                            <input type="file" name="image" class="form-control border-0" id="filee" accept=".docx,.pdf,image/jpeg,image/png,image/jpg">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="submitted_date" value="<?php echo date('Y-m-d') ?>" id="issueDate" class="form-control" readonly>
                                            <a style="color:red" id="issueDateError"></a>
                                        </div>

                                        <?php if (isset($_SESSION['error'])) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $_SESSION['error'];
                                                unset($_SESSION['error']);  ?>
                                            </div>
                                        <?php }  ?>

                                        <button class="btn btn-primary" type="submit" name="submit" value="submitAssi">Submit</button>
                                    </form>

                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php } else { ?>
    <h5 class="text-danger px-4 my-4">Assignment not found!</h5>
<?php } ?>
</div>