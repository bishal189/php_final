<?php

if (!isset($_SESSION['assignment-status']) || $_SESSION['assignment-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}

$t_sem = $_GET['sem'];
$t_sub = $_GET['sub'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];


if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        if ($_FILES['image']['name'] != '') {

            $imgName = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $location = 'create_assignment' . '/' . $imgName;
            move_uploaded_file($tmp_name, $location); //upload file
            $_POST['file'] = $imgName;
        }
        unset($_POST['submit']);

        print_r($_POST);
        $obj->Update("tbl_create_assignment", $_POST, "id", array($_GET['id']));

        $target = "manage_teacher_assignment.php?sem=$t_sem&sub=$t_sub";

        echo "<script> window.location.href='" . base_url($target) . "'</script>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("tbl_create_assignment", "*", "id", array($_GET['id']));

    if (!$edit) {
        echo "<script> window.location.href='" . base_url('edit_assignment.php') . "'</script>";
    }
}


?>
<?php include('teacherheader.php') ?>
<div class="container" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-sm-12 mb-5">
            <div class="card card-header bg-info text-white">
                <h4> <i class="fas fa-edit"></i>
                    Edit Assignment</h4>
            </div>
            <div class="card-body bg-white shadow-sm">
                <form action="" method="post" id="form" class="form-group" enctype="multipart/form-data">
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

                    <div class="form-group">
                        <label style="font-family: nunito, sans-serif;font-weight:600">Assignment Title</label>
                        <input type="text" name="title" class="form-control" id="assignment_title" required value="<?= $edit[0]['title']; ?>">
                        <a style="color:red" id="titleError"></a>
                    </div>

                    <div class="form-group">
                        <label style="font-family: nunito, sans-serif;font-weight:600"> Description</label><br>
                        <textarea rows="3" cols="50" name="description" id="assignment_desc" required>
                        <?= $edit[0]['description']; ?>
                        </textarea>


                        <a style="color:red" id="descError"></a>
                    </div>

                    <div class="form-group w-25">
                        <?php if ($edit[0]['file'] != '') { ?>
                            <a href="create_assignment/<?= $value->file; ?>"><img src="create_assignment/<?= $edit[0]['file']; ?>" alt="Assignment" width="100px"></a>
                        <?php  } else {
                            echo "No file attached";
                        } ?>

                        <label style="font-family: nunito, sans-serif;font-weight:600">File/Images</label>
                        <input type="file" name="image" class="form-control" id="filename" style="background-color: #fff;">
                        <a style="color:red" id="fileError"></a>
                    </div>


                    <div class="form-group w-25" hidden>
                        <label style="font-family: nunito, sans-serif;font-weight:600">Issued Date</label>
                        <input type="date" name="created_date" required value="<?= $edit[0]['created_date'] ?>" id="issueDate" class="form-control">
                        <a style="color:red" id="issueDateError"></a>
                    </div>

                    <div class="form-group w-25">
                        <label style="font-family: nunito, sans-serif;font-weight:600">Submission Date</label>
                        <input type="date" name="deadline" class="form-control" value="<?= $edit[0]['deadline'] ?>" id="submissionDate" required>
                        <a style="color:red" id="subDateError"></a>

                    </div>
                    <input type="hidden" name="posted_by" value="<?= $_SESSION['posted_by']; ?>">
                    <button class="btn btn-success my-3" name="submit" value="add" onclick="return validate()"> Update Assignment <i class="fas fa-send text-success "></i></button>
                </form>
            </div>

        </div>
        <div class="col-md-6 shadow p-4 d-none">
            <form action="" method="post">
                <div class="form-group">

                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required value="<?= $edit[0]['title']; ?>">
                    <a style="color: red;">
                        <?php if (isset($_SESSION['nameError'])) {
                            echo $_SESSION['nameError'];
                            unset($_SESSION['nameError']);
                        } ?></a>

                    <label>Select Subject
                    </label>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "digital_assignment");
                    // Check connection
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    ?>
                    <select id="subject" class="form-control" name="subject">
                        <?php
                        $result = mysqli_query($connection, "SELECT subjectname FROM addsubject order by subjectname");
                        while ($row = mysqli_fetch_array($result))
                            echo "<option value='" . $row['subjectname'] . "'>" . $row['subjectname'] . "</option>";
                        ?>
                    </select>


                    <label>Posted Date</label>
                    <input type="text" name="created_date" class="form-control" required value="<?= $edit[0]['created_date']; ?>">

                    <label>Deadline</label>
                    <input type="text" name="deadline" class="form-control" value="<?= $edit[0]['deadline']; ?>">


                    <label>File</label>
                    <input type="file" name="file" class="form-control" value="<?= $edit[0]['file']; ?>" required>
                </div>
                <button class="btn btn-success" name="submit" value="add">Update</button>
            </form>
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