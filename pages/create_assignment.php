<?php
// print_r($_SESSION);

$t_sem = $_GET['sem'];
$t_sub = $_GET['sub'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];

    
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'submit') {
        
        
        $old = $_POST;
        // $teacher_sub = $obj->select('tbl_teacher', '*', 'tid', array($_SESSION['teacher_id']));
        // if ($teacher_sub) {
        //     $subject = $teacher_sub[0]['tsubject'];

        // }

        $check = $obj->select('tbl_create_assignment', '*', 'title', array($_POST['title']));
        // print_r(($check));
        if ($check) {
            $_SESSION['titleError'] = "This assignment already exists!";
        } else {

            $imgName = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = 'create_assignment' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location); //upload file
            unset($_POST['submit']);
            $_POST['file'] = $imgName;

            $_POST['semester'] = $t_sem_id;
            $_POST['subject'] = $t_sub;
            $_POST['tid'] =$_SESSION['teacher'];
            // print_r($t_sub);

            $target = "manage_teacher_assignment.php?sem=$t_sem&sub=$t_sub";

            $obj->Insert("tbl_create_assignment", $_POST); //insert query
            echo '<script>alert("Assignment created successfully")</script>';
            echo "<script> window.location.href='" . base_url($target) . "'</script>";
        }
    }
}


if (isset($_SESSION['teacher_id'])) {
    $teacher_sub = $obj->select('tbl_teacher', '*', 'tid', array($_SESSION['teacher_id']));
    if ($teacher_sub) {
        $subject = $teacher_sub[0]['tsubject'];
        // echo $subject;
        // print_r($teacher_sub);
    }
}
include('teacherheader.php');
?>

<style>
    body {
        background-color: #f0f0ff;
    }
</style>
<a href="activity.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>"><i class="fas fa-arrow-circle-left p-2 text-success" style="font-size: 1.5em;"></i></a>
<div class="container body-container rounded"><br>

    <div class="row justify-content-center">

        <div class="col-sm-12 mb-5">
            <div class="card card-header">
                <h4> <i class="fas fa-plus"></i>
                    Create Assignment</h4>
            </div>
            <div class="card-body bg-white shadow-sm">
                <form action="" method="post" id="form" class="form-group" enctype="multipart/form-data">

                    <div class="error">

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

                    </div>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "digital_assignment");
                    // Check connection
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    ?>


                    <style>
                        .navbar-home {
                            display: none;
                        }

                        button {
                            font-family: poppins, sans-serif;
                        }
                    </style>


                    <div class="form-group" style="display:none;">
                        <label style="font-family: nunito, sans-serif;font-weight:600">
                            Subject
                        </label>
                        <?php
                        $result = mysqli_query($connection, "SELECT subjectname FROM addsubject where sub_id = $subject order by subjectname");
                        $result = mysqli_fetch_array($result);

                        // while($row = mysqli_fetch_array($result)) 
                        //     echo "<option selected disabled value='" . $row['subjectname'] . "'>" . $row['subjectname'] . "</option>"; 
                        ?>
                        <input type="text" name="subject" class="form-control" value="<?php if (isset($result['subjectname'])) echo  $result['subjectname']; ?>" readonly>
                    </div>

                    <div class="" id="errorSub" style="color:red"></div>

                    <div class="form-group">
                        <label style="font-family: nunito, sans-serif;font-weight:600">Assignment Title</label>
                        <input type="text" name="title" class="form-control" id="assignment_title" required value="<?php if (isset($old)) {
                                                                                                                        echo $old['title'];
                                                                                                                    } ?>">

                        <a style="color: red;">
                            <?php if (isset($_SESSION['titleError'])) {
                                echo $_SESSION['titleError'];
                                unset($_SESSION['titleError']);
                            } ?></a>

                    </div>

                    <div class="form-group">
                        <label style="font-family: nunito, sans-serif;font-weight:600"> Description</label><br>
                        <textarea rows="3" cols="50" name="description" id="assignment_desc" required="required"></textarea>

                        <a style="color:red" id="descError"></a>
                    </div>

                    <div class="form-group w-25">
                        <label style="font-family: nunito, sans-serif;font-weight:600">File/Images</label>
                        <input type="file" name="image" class="form-control" id="filename" accept=".pdf,.docx, image/*" style="background-color: #fff;">
                        <a style="color:red" id="fileError"></a>
                    </div>


                    <div class="form-group w-25" hidden>
                        <label style="font-family: nunito, sans-serif;font-weight:600">Issued Date</label>
                        <input type="date" name="created_date" readonly value="<?php echo date('Y-m-d') ?>" id="issueDate" class="form-control" required="required">
                        <a style="color:red" id="issueDateError"></a>
                    </div>

                    <div class="form-group w-25">
                        <label style="font-family: nunito, sans-serif;font-weight:600">Submission Date</label>
                        <input type="date" name="deadline" class="form-control" id="submissionDate" required="required">
                        <a style="color:red" id="subDateError"></a>

                    </div>
                    <input type="hidden" name="posted_by" value="<?= $_SESSION['posted_by']; ?>">
                    <button class="btn btn-success my-3" name="submit" value="submit" onclick="return validate()"> Post Assignment <i class="fas fa-send text-success "></i></button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function validate() {
        // issue data validation
        var isD = document.getElementById('issueDate').value;
        if (isD == '' | null) {
            document.getElementById('issueDateError').innerHTML = 'Issue date is required!';
            return false;
        } else {
            document.getElementById('issueDateError').innerHTML = '';

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
            document.getElementById('subDateError').innerHTML = 'Submission date must be greater than issued date!';
            return false;
        } else {
            document.getElementById('subDateError').innerHTML = '';

        }



    }
</script>

<script src="<?= base_url('lib/ckeditor/ckeditor.js') ?>"></script>

<script>
    CKEDITOR.replace('description');
</script>