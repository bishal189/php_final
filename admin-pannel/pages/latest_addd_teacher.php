<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $obj->Delete("tbl_teacher", "tid", array($_GET['id']));

        echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
    } elseif ($_GET['action'] == 'inactive') {
        $status['status'] = 0;
        $obj->Update("tbl_teacher", $status, "tid", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
    } elseif ($_GET['action'] == 'active') {
        $status['status'] = 1;
        $obj->Update("tbl_teacher", $status, "tid", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
    }
}
// add teacher
if (isset($_POST['submit'])) {
    $old = $_POST;
    $temail = $_POST['temail'];
    $tname = $_POST['tname'];

    $chek_teacher = $obj->Query("SELECT * FROM tbl_teacher where tname='$tname'");

    $check_email = $obj->Query("SELECT * FROM tbl_teacher where temail='$temail'");


    if ($chek_teacher) { ?>
        <style>
            .collapse {
                display: block !important;
            }
        </style>
        <?php $_SESSION['nameError'] = "Teacher is already Registered!"; ?>

    <?php } else if ($check_email) { ?>
        <style>
            .collapse {
                display: block !important;
            }
        </style>
        <?php $_SESSION['emailError'] = "Email already exists!"; ?>
    <?php } else { 

        if ($_POST['submit'] == 'add') {
            unset($_POST['submit']);

            $obj->Insert("tbl_teacher", $_POST);
            echo '<script>alert("Teacher added successfully")</script>';
            echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
        }
    }
}
?>

<!-- // assign teacher -->
<?php
if (isset($_POST['assign'])) {
    $old = $_POST;

    $tsem = $_POST['tsemester'];

    $tsub = $_POST['tsubject'];
 
    $tname = $_POST['tname'];


    print_r($tname);
    // 
    
    $users = $obj->Query("UPDATE tbl_teacher set tsemester = '$tsem' and tsubject = '$tsub' where tname = '$tname'");

    print_r($users);
    die;





    $ta = $obj->select('tbl_teacher');
    die;





    if ($users) {
        // $_SESSION['nameError'] = "Teacher is already Registered!";
        $_SESSION['subError'] = "Subject is already assigned to another teacher";
    } else {

        if ($_POST['assign'] == 'Assign') {
            array_pop($_POST);

            $obj->Update("tbl_student", $_POST, "sid", array($_GET['id']));
            echo '<script>alert("Teacher added successfully")</script>';
            echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
        }
    }
}
$teachers = $obj->select('tbl_teacher');
$subject = $obj->select('addsubject');
$semester = $obj->Query("SELECT * from semesters order by name asc");
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3 shadow-sm p-3">
            <div class="card">
                <button class="btn btn-info bg-info text-light font-weight-bold" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> &nbsp;Add new teacher</button>
                </button>
            </div>

            <div class="collapse" id="collapseExample">
                <div class="card-body bg-white shadow-sm">
                    <form action="" method="post" class="form-group">
                        <div class="form-group">
                            <label>Teacher's Name</label>
                            <input type="text" name="tname" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['tname'];
                                                                                                    } ?>">
                            <a class="text-primary">
                                <?php if (isset($_SESSION['nameError'])) {
                                    echo $_SESSION['nameError'];
                                    unset($_SESSION['nameError']);
                                } ?></a>
                        </div>
                        <div class="form-group">
                            <label>Teacher's Email</label>
                            <input type="text" name="temail" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['temail'];
                                                                                                    } ?>">

                            <a class="text-primary">
                                <?php if (isset($_SESSION['emailError'])) {
                                    echo $_SESSION['emailError'];
                                    unset($_SESSION['emailError']);
                                } ?></a>
                        </div>

                        <div class="form-group">
                            <label>Teacher's Address</label>
                            <input type="text" name="taddress" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['taddress'];
                                                                                                    } ?>">
                        </div>

                        <div class="form-group">
                            <label>Teacher's Phone</label>
                            <input type="text" name="tphone" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['tphone'];
                                                                                                    } ?>" maxlength="10">
                        </div>

                        <!--  <label>Teacher's Subject</label>
<input type="text" name="tsubject" class="form-control" required
    value="<?php
            // if(isset($old)){echo $old['tsubject'];} 
            ?>"> -->

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>

                            </select>
                        </div>

                        <button class="btn btn-success" name="submit" value="add">Add</button>

                    </form>

                </div>
            </div>




            <!-- //Assign subject teacher  -->

            <div class="card card-header bg-secondary font-weight-bold mt-4 text-nowrap">
                <i class="fad fa-chalkboard-teacher fa-2x"></i> Assign Subject Teacher ? </button>
            </div>
            <div class="card-body bg-light shadow">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="tsemester">
                            <option selected="" disabled="">Choose a semester</option>
                            <?php if ($semester) { ?>
                                <?php foreach ($semester as $key => $value) : ?>
                                    <option value="<?= $value->id; ?>"><?= $value->name; ?></option>
                                <?php endforeach; ?>
                            <?php  }  ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Teacher</label>
                        <select class="form-control" name="tname">
                            <option selected="" disabled="">Choose a teacher</option>
                            <?php if ($teachers) { ?>
                                <?php foreach ($teachers as $key => $value) : ?>
                                    <option value="<?= $value['tid']; ?>"><?= $value['tname']; ?></option>
                                <?php endforeach; ?>
                            <?php  }  ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <select class="form-control" name="tsubject">
                            <option selected="" disabled="">Choose a subject</option>
                            <?php if ($subject) { ?>
                                <?php foreach ($subject as $key => $value) : ?>
                                    <option value="<?= $value['sub_id']; ?>"><?= $value['subjectname']; ?></option>
                                <?php endforeach; ?>
                            <?php  }  ?>
                        </select>
                        <a style="color: red;">
                            <?php if (isset($_SESSION['subError'])) {
                                echo $_SESSION['subError'];
                                unset($_SESSION['subError']);
                            } ?></a>
                    </div>
                    <button class="btn btn-success btn-block" name="assign" value="Assign">Assign</button>
                </form>
            </div>
        </div>






        <div class="col-md-8 columnhead pt-3 ml-3" style="min-height:85vh;">


            <?php if ($teachers) { ?>

                <div class="col-md-12">
                    <h3 class="font-weight-bold pb-3 text-left" style="font-size:1.3rem;">List of teachers</h3>

                    <table class="table table-hover table-responsive-lite text-center">
                        <thead>
                            <tr style="background: #f9f9f9;">
                                <th>SN</th>
                                <th>Name</th>
                                <th>Semester</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th colspan="3" class="text-center">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($teachers as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold"><?= $value['tname']; ?></a></td>
                                    <td>
                                        <?php
                                        $sem_query = $obj->Select("semesters", "*", "id", array($value['tsemester']));
                                        $sem =  $sem_query[0]['name'];
                                        ?>

                                        <?= $sem ?></td>
                                    <td>
                                        <?php
                                        $sub_query = $obj->Select("addsubject", "*", "sub_id", array($value['tsubject']));
                                        $sub =  $sub_query[0]['subjectname'];
                                        ?>

                                        <?= $sub ?></td>

                                    <td><?php
                                        if ($value['status'] == 1) { ?>
                                            <a href="add_teacher.php?action=inactive&id=<?= $value['tid']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                                        <?php  } elseif ($value['status'] == 0) { ?>
                                            <a href="add_teacher.php?action=active&id=<?= $value['tid']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>

                                        <?php   }

                                        ?>
                                    </td>


                                    <td><a href="<?= base_url('edit_manage_teachers.php?action=e&id=' . $value['tid']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                                    </td>


                                    <td><a href="<?= base_url('add_teacher.php?action=d&id=' . $value['tid']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <p class="p-3 text-primary">No teacher have registered yet !</p>

            <?php } ?>
        </div>
    </div>
</div>
<script>
    function showFunction() {
        var div = document.getElementById("msg");
        div.classList.toggle('hidden');
    }
</script>