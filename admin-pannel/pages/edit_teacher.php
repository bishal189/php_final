<?php

if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}

if (isset($_POST['updateT'])) {
    $old = $_POST;
    $tid = $_POST['tid'];
    $temail = $_POST['temail'];
    $tname = $_POST['tname'];
    $tphone = $_POST['tphone'];
 
    $check_email = $obj->Query("SELECT * FROM tbl_teacher WHERE NOT (tid = '$tid') AND temail='$temail'");
    $check_phone = $obj->Query("SELECT * FROM tbl_teacher  WHERE NOT (tid = '$tid') AND tphone='$tphone'");
 
    
       if ($check_email) { ?>
          <style>
             .collapse {
                display: block !important;
             }
          </style>
          <?php $_SESSION['emailErrorEdit'] = "Email already exists!"; 
          } elseif($check_phone) { ?>
             <style>
                .collapse {
                   display: block !important;
                }
             </style>
             <?php $_SESSION['phoneErrorEdit'] = "Phone already exists!"; ?>
    
    <?php } else if ($_POST['updateT'] == 'update') {
          unset($_POST['updateT']);
    
       $tid = $_POST['tid'];
       $obj->Update("tbl_teacher", $_POST, "tid", array($tid));
       echo '<script>alert("Data updated successfully")</script>';
       echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
    }
 }
// }

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("tbl_teacher", "*", "tid", array($_GET['id']));
    if (!$edit) {
        echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
    }
}

$semester = $obj->select('semesters', '*', '', array(), ' Order by name asc');


?>



<div class="container pt-4">
    <a href="add_teacher.php"><i class="fas fa-arrow-circle-left fa-2x"></i>

    </a>
    <h3 class="font-weight-bold pt-4">Edit Teacher detail</h3>
    <div class="row">
        <div class="col-md-5 pt-4">
            <form action="" method="post" class="form-group">
                <input type="hidden" name="tid" value="<?= $value['tid'] ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Teacher | <span class="text-info"><?= $value['tname'] ?></span> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Teacher's Name</label>
                        <input type="text" name="tname" class="form-control" value="<?= $value['tname'] ?>">
                        <a class="text-primary"> <?php if (isset($_SESSION['nameError'])) {
                                                        echo $_SESSION['nameError'];
                                                        unset($_SESSION['nameError']);
                                                    } ?></a>
                    </div>
                    <div class="form-group">
                        <label>Teacher's Email</label>
                        <input type="text" name="temail" class="form-control" value="<?= $value['temail'] ?>">
                        <a class="text-primary"> <?php if (isset($_SESSION['emailErrorEdit'])) {
                                                        echo $_SESSION['emailErrorEdit'];
                                                        unset($_SESSION['emailErrorEdit']);
                                                    } ?></a>
                    </div>
                    <div class="form-group">
                        <label>Teacher's Address</label>
                        <input type="text" name="taddress" class="form-control" value="<?= $value['taddress'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Teacher's Phone</label>
                        <input type="text" maxlength="10" id="phone" name="tphone" value="<?= $value['tphone'] ?>" class="form-control" pattern="\d{10}" title="Please enter exactly 10 digits" /><a class="text-primary"><?php if (isset($_SESSION['phoneErrorEdit'])) {
                                                                                                                                                                                                                                echo $_SESSION['phoneErrorEdit'];
                                                                                                                                                                                                                                unset($_SESSION['phoneErrorEdit']);
                                                                                                                                                                                                                            } ?></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="updateT" value="update">Save changes</button>
                </div>
            </form>
        </div>