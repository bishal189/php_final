<?php

if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}
if (isset($_POST['submit'])) {

    $old = $_POST;
    $s  = $_POST['sname'];
    $roll  = $_POST['roll_no'];
    $phone  = $_POST['sphone'];
    $sem  = $_POST['semester'];
    $checkEmail =  $obj->Select("tbl_student", '', "email", array($_POST['email']));
    $checkRoll = $obj->Query("SELECT * from tbl_student WHERE roll_no = $roll and semester = $sem");
    $checkPhone = $obj->Query("SELECT * from tbl_student WHERE sphone = $phone");


    // $entered_roll = $_POST['roll_no'];

    // $check_if_roll_exists_in_same_semester = $obj->Query("SELECT * from tbl_student where roll_no = $entered_roll and semester =  $usersem");

    // if ($check_if_roll_exists_in_same_semester) {
    //     $_SESSION['rollError'] = "Roll no. can't be similar.";
    // } else {
        if ($checkEmail) {
            $_SESSION['emailError'] = "This email already Exists!";
        } elseif ($checkRoll) {
            $_SESSION['rollError'] = "This Roll No already Exists!";
        } elseif ($checkPhone) {
            $_SESSION['phoneError'] = "This phone  No already Exists!";
        } else { if ($_POST['submit'] == 'add') {
            array_pop($_POST);

            $obj->Update("tbl_student", $_POST, "sid", array($_GET['id']));
            echo '<script>alert("Data updated successfully")</script>';
            echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("tbl_student", "*", "sid", array($_GET['id']));
    if (!$edit) {
        echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
    }
}

$semester = $obj->select('semesters', '*', '', array(), ' Order by name asc');


?>



<div class="container pt-4">
<a href="add_student.php"><i class="fas fa-arrow-circle-left fa-2x"></i>

</a>
    <h3 class="font-weight-bold pt-4">Edit Student detail</h3>
    <div class="row">
        <div class="col-md-5 pt-4">
            <form action="" method="post" class="form-group">
                <div class="form-group">
                    <!-- <label for="college">College Name</label>   -->

                    <label>Student's Name</label>
                    <input type="text" name="sname" class="form-control" required value="<?= $edit[0]['sname']; ?>">

                    <label> Semester</label>
                    <?php $subject_e = $edit[0]['semester'];
                    $sem_Query = $obj->Select("semesters", "*", "id", array($subject_e));
                    $sem = $sem_Query[0]['name'];
                    $sem_id = $sem_Query[0]['id'];

                    ?>
                    <select name="semester" class="form-control">
                        <option value="" disabled selected>Choose a semester</option>

                        <?php foreach ($semester as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $subject_e) { ?> selected<?php } ?>><?= $value['name'] ?> sem</option>
                        <?php endforeach ?>
                    </select>

                    <label>Roll No</label>
                    <input type="text" name="roll_no" class="form-control" required value="<?= $edit[0]['roll_no']; ?> ">
                    <a style="color: red;">
                        <?php if (isset($_SESSION['rollError'])) {
                            echo $_SESSION['rollError'];
                            unset($_SESSION['rollError']);
                        } ?></a><br>


                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required value="<?= $edit[0]['email']; ?>"><?php if (isset($_SESSION['emailError'])) {
                            echo $_SESSION['emailError'];
                            unset($_SESSION['emailError']);
                        } ?></a><br>

                    <label>Address</label>
                    <input type="text" name="saddress" class="form-control" required value="<?= $edit[0]['saddress']; ?>"><br>


                    <label>Phone</label>
                    <input type="text" name="sphone" class="form-control" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required value="<?= $edit[0]['sphone']; ?>"><?php if (isset($_SESSION['phoneError'])) {
                            echo $_SESSION['phoneError'];
                            unset($_SESSION['phoneError']);
                        } ?></a><br>



                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?php if ($edit[0]['status'] == 1) {
                                                echo "checked";
                                            } ?>>Active</option>
                        <option value="0" <?php if ($edit[0]['status'] == 0) {
                                                echo "checked";
                                            } ?>>Inactive</option>

                    </select>
                </div>


                <button class="btn btn-success" name="submit" value="add">Update</button>
            </form>
        </div>