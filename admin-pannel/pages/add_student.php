<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {

        $id = $_GET['id'];

        $stuNaam_q = $obj->select("tbl_student", "*", 'sid', array($_GET['id']));

        $stuNam = $stuNaam_q[0]['sname'];

        $obj->Delete("tbl_student_login", "student", array($_GET['id']));

        $obj->Delete("tbl_submit_assignment", "submitted_by", array($stuNam));

        $obj->Delete("tbl_student", "sid", array($_GET['id']));


        echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
    } elseif ($_GET['action'] == 'inactive') {
        $status['status'] = 0;
        $obj->Update("tbl_student", $status, "sid", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
    } elseif ($_GET['action'] == 'active') {
        $status['status'] = 1;
        $obj->Update("tbl_student", $status, "sid", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
    }
}

// print_r($_SESSION);
if (isset($_POST['submit'])) {
    $old = $_POST;
    $s  = $_POST['sname'];
    $roll  = $_POST['roll_no'];
    $phone  = $_POST['sphone'];
    $sem  = $_POST['semester'];
    $checkEmail =  $obj->Select("tbl_student", '', "email", array($_POST['email']));
    $checkRoll = $obj->Query("SELECT * from tbl_student WHERE roll_no = $roll and semester = $sem");
    $checkPhone = $obj->Query("SELECT * from tbl_student WHERE sphone = $phone");



    if ($checkEmail) {
        $_SESSION['emailError'] = "This email already Exists!";
    } elseif ($checkRoll) {
        $_SESSION['rollError'] = "This Roll No already Exists!";
    } elseif ($checkPhone) {
        $_SESSION['phoneError'] = "This phone  No already Exists!";
    } else {
        if ($_POST['submit'] == 'add') {
            unset($_POST['submit']);
            $obj->Insert("tbl_student", $_POST);
            echo '<script>alert("Student added successfully")</script>';
            echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
        }
    }
}

$students = $obj->select('tbl_student', '*', '', array(), ' Order by sid desc');
$semester = $obj->Query("SELECT * from semesters order by name asc");
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3 shadow-sm p-3">
            <button class="btn btn-info btn-block font-weight-bold" onclick="showFunction()"><i class="fa fa-plus"></i> &nbsp;Add new student</button>
            <style>
                .hidden {
                    display: none;
                }
            </style>
            <div class="hiddenn" id="msg">
                <form action="" method="post" class="form-group"><br>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="sname" class="form-control" required value="<?php if (isset($old)) {
                                                                                                    echo $old['sname'];
                                                                                                } ?>">
                        <a style="color: red;">
                            <?php if (isset($_SESSION['nameError'])) {
                                echo $_SESSION['nameError'];
                                unset($_SESSION['nameError']);
                            } ?></a>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required value="<?php if (isset($old)) {
                                                                                                    echo $old['email'];
                                                                                                } ?>">
                        <a style="color: red;">
                            <?php if (isset($_SESSION['emailError'])) {
                                echo $_SESSION['emailError'];
                                unset($_SESSION['emailError']);
                            } ?></a>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="semester" required>
                            <option selected="" disabled="" value="">Choose a semester</option>
                            <?php if ($semester) { ?>
                                <?php foreach ($semester as $key => $value) : ?>
                                    <option value="<?= $value->id; ?>"><?= $value->name; ?></option>
                                <?php endforeach; ?>
                            <?php  }  ?>
                        </select>
                        <a style="color: red;">
                            <?php if (isset($_SESSION['semError'])) {
                                echo $_SESSION['semError'];
                                unset($_SESSION['semError']);
                            } ?></a>

                    </div>


                    <div class="form-group">
                        <label> Roll No</label>
                        <input type="number" name="roll_no" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['roll_no'];
                                                                                                    } ?>" maxlength="6">
                        <a style="color: red;">
                            <?php if (isset($_SESSION['rollError'])) {
                                echo $_SESSION['rollError'];
                                unset($_SESSION['rollError']);
                            } ?></a>
                    </div>



                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="saddress" class="form-control" required value="<?php if (isset($old)) {
                                                                                                    echo $old['saddress'];
                                                                                                } ?>">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="sphone" class="form-control" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required value="<?php if (isset($old)) {
                                                                                                                                                                            echo $old['sphone'];
                                                                                                                                                                        } ?>">
                        <a style="color: red;">
                            <?php if (isset($_SESSION['phoneError'])) {
                                echo $_SESSION['phoneError'];
                                unset($_SESSION['phoneError']);
                            } ?></a>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>
                    </div>

                    <button class="btn btn-success btn-block" name="submit" value="add">Add</button>

                </form>
            </div>
        </div>
        <div class="col-md-8 shadow pt-3 columnhead ml-3" style="min-height:85vh;">

            <h5 class="font-weight-bold pb-3 text-left" style="margin-left: 14px;">Student (Semester-wise)</h3>
                <ul class="list-unstyled sem-nav d-flex">
                    <?php $semCounter = sizeof($semester);
                    $semIdx = 0;
                    ?>

                    <li style="margin-left: 14px;"><a class="btn btn-light" href="<?= base_url('add_student.php') ?>">
                            All</a>
                    </li>

                    <?php foreach ($semester as $key => $value) : ?>

                        <li class="mx-2"> <button class="btn btn-light active" onClick="semFunction('<?= $value->id; ?>','<?= $semIdx; ?>')">
                                <?= $value->name; ?></button>
                        </li>
                    <?php endforeach; ?>

                </ul>
                <span class="float-right text-light pb-4 position-absolute" style="top:10px;right:20px"> <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search students..">
                </span>
                <div class="col-sm-12">
                    
                    <div class="card-header bg-info mt-4">
                        
                        <h4 class="font-weight-bold text-white">
                            All Students
                        </h4>
                    </div>
                    <?php if ($students) { ?>

                        <table class="table table-hover table-responsive-lite" id="studentSem_wise">
                            <thead>
                                <tr style="background: #f9f9f9;">
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Semester</th>
                                    <th>Roll</th>
                                    <th>Status</th>
                                    <th colspan="1">Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $key => $value) : ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><a href="student_view_more.php?tid=<?= $value['sid']; ?>" class="text-info font-weight-bold"><?= $value['sname']; ?></a></td>
                                        <td><?php
                                            $sem_query = $obj->Select("semesters", "*", "id", array($value['semester']));
                                            if ($sem_query) {
                                                $sem =  $sem_query[0]['name'];
                                                echo $sem;
                                            }
                                            ?></td>
                                        <td><?= $value['roll_no']; ?></td>
                                        <td><?php
                                            if ($value['status'] == 1) { ?>
                                                <a href="add_student.php?action=inactive&id=<?= $value['sid']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                                            <?php  } elseif ($value['status'] == 0) { ?>
                                                <a href="add_student.php?action=active&id=<?= $value['sid']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>

                                            <?php   }

                                            ?>
                                        </td>


                                        <!-- <td><a href="<?= base_url('edit_manage_students.php?action=e&id=' . $value['sid']) ?>" class="btn btn-outline-info btn-sm"><i class="far fa-edit"></i></a>
                                        </td> -->


                                        <td><a href="<?= base_url('add_student.php?action=d&id=' . $value['sid']) ?>" class="btn btn-outline-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i> Delete</a></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                    <?php } else { ?>
                        <p class="text-primary p-3">No student have been added yet !</p>

                    <?php } ?>

                </div>


        </div>
    </div>
</div>

<script>
    function showFunction() {
        var div = document.getElementById("msg");
        div.classList.toggle('hidden');
    }
</script>
<script>
    function semFunction(data, i) {
        
        let counter = "<?= $semCounter; ?>";
        $.ajax({
            type: "POST",
            url: 'filtered-student.php',
            data: {
                tag: data

            },
            success: function(e) {
                $('#studentSem_wise').html(e);

            }
        })
    }
</script>