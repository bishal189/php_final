<style>
  .logout h6,
  .logout a {
    font-family: verdana;
    cursor: pointer;
    display: inline;
    padding: 10px;
    color: #000;
  }

  .boxstyle h5 a {
    color: #000;
  }



  .banner,
  .login,
  .navbar {
    display: none !important;
  }

  .modal {
    /*background-color: #f1f1f1;*/
    top: 12%;
    display: none;
    /* Hidden by default */
    /*position: fixed; /* Stay in place */
    /*overflow: hidden;*/
  }

  /* Modal Content */
  .modal-content {
    /*left: 25%;*/
    background-color: #fff !important;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    color: #000;
    /*border: none!important;*/

  }

  .modal-content p {
    text-align: justify;
  }
</style>


<div class="container-fluid">
  <span style="font-size:14px;font-family:arial;"><a href="<?= base_url(); ?>">Digital Assignment</a>
  </span>
  <span style='font-size:14px;font-weight:bold;font-family:arial;border-left:2px solid brown;'>&nbsp;Student Panel</span>

  <div class="row  sticky-top" style="background-color:#fff;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(255, 245, 235) 0px 0px 0px 1px inset;">
    <div class="col-7">
      <h5 class="text-dark">
        <?php
        $username = $_SESSION['student'];

        $image_query = $obj->Query("SELECT * from tbl_student_login where username =  '$username'");
        $user_avatar = $image_query[0]->avatar;
        ?>
        <a class="navbar-brand px-2 d-inline-flex" href="student_sectionnew.php" style="color:#333 !important">
          <img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 55px;height: 55px;border-radius: 50%;">
          <span class="pt-3 px-2 text-dark"><?php
                                            if (isset($_SESSION['submitted_by'])) {

                                              echo $_SESSION['submitted_by'];
                                            }
                                            ?></span>
        </a>
      </h5>
    </div>
    <!-- <a href="<?= base_url('teacherprofile.php'); ?>"><span class="text-dark"> <i class="fa fa-user"></i>  Profile</a> -->

    <div class="col-4 logout pt-3">
      <h6><a href="<?= base_url('student_sectionnew.php'); ?>"><i class="fas fa-home"></i></a></h6>
      <h6 onclick="toogle_Profile()"> Profile</h6>
      <h6>
        <a class="text-danger rounded-pill ml-4 pl-4" href="<?= base_url('logout.php'); ?>" class="text-white font-weight-bold">Logout <i class="fas fa-sign-out-alt"></i></a>
      </h6>
    </div>
  </div>
  <?php
  // if (isset($_SESSION['submitted_by'])) {

    $students = $obj->select('tbl_student', '*', 'sname', array($_SESSION['submitted_by']));
    // echo "<pre>";

    // print_r($students);

    $edit_profile_query = $obj->select('tbl_student_login', '*', 'username', array($_SESSION['submitted_by']));
    $edit_profile_id = $edit_profile_query[0]['sid'];
  // }
  ?>

  <div class="modal" id="profileDiv" style="display:none">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-md-5 modal-content p-0" id="profileModal">
          <?php if ($students) { ?>
            <div class="card card-header" id="profiledivClose">
              <div>
                <h5 class="d-flex justify-content-end" id="close"><i class="fas fa-close text-danger" style="cursor:pointer;position: absolute;right:auto;margin-top:-14px;margin-right:-16px"></i></h5>
                <div class="float-left">
                  <style>
                    .active-icon {
                      position: relative;
                    }

                    .active-icon i {
                      position: absolute;
                      top: 6px;
                      left: 39px;
                      border: 1px solid #c7c7c7;
                      border-radius: 50%;
                    }
                  </style>
                  <div class="active-icon">
                    <img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 55px;height: 55px;border-radius: 50%;">
                    <?php
                    if ($students[0]['status'] == 1) { ?>
                      <i class="fa fa-circle" style="color:green" style="font-size:14px!important;"></i>
                    <?php  } elseif ($students[0]['status'] == 0) { ?>
                      <i class="fas fa-circle" style="color:grey;"></i>
                    <?php   }
                    ?>
                    <span class="font-weight-bold mx-2"><?= $students[0]['sname']; ?>&nbsp;</span>

                  </div>

                  <p style="font-size:14px!important;cursor: pointer;">
                    <a href="edit_student_profile.php?id=<?= $edit_profile_id ?>" class="text-secondary"><i class="fas fa-pen"></i>&nbsp; Change profile</a>
                  </p>
                </div>

                <div class="float-right">
                  <?php
                  $sem_qur = $obj->Select('semesters', '*', 'id', array($students[0]['semester']));
                  $sem = $sem_qur[0]['name'];
                  ?>

                  <ul class="list-unstyled">
                    <li>
                      Semester : <?= $sem ?>
                    </li>
                    <li>Roll No : <?= $students[0]['roll_no']; ?></li>
                  </ul>

                </div>
              </div>

            </div>
            <div class="card-body">
              <p> <i class="fas fa-map-marker-alt"></i> &nbsp;<?= $students[0]['saddress']; ?></p>
              <p> <i class="fas fa-envelope"></i> &nbsp;<?= $students[0]['email']; ?></p>
              <p> <i class="fas fa-phone"></i> &nbsp;<?= $students[0]['sphone']; ?></p>
            </div>

        </div>
      <?php } else { ?>
        <h5 class="text-danger">No data available !</h5>
      <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  var modal = document.getElementById("profile");

  var btn = document.getElementById("myBtn");

  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
    modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script> -->

<script>
  function toogle_Profile() {
    var x = document.getElementById("profileDiv");
    var y = document.getElementById("close");
    var z = x;
    var zz = document.getElementById("profiledivClose");

    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }

    y.onclick = function() {
      x.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == z) {
        z.style.display = "none";
      }
    }

  }
</script>