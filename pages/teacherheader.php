<div class="px-4">
  <span style="font-size:14px;font-family:arial;"><a href="<?= base_url(); ?>">Digital Assignment</a></span>
  <span style='font-size:14px;font-weight:bold;font-family:arial;border-left:2px solid brown;'>&nbsp;Teacher Panel</span>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-top border-primary sticky-top w-100">


  <?php
  $username = $_SESSION['posted_by'];

  $image_query = $obj->Query("SELECT * from tbl_teacher_login where username =  '$username'");
  $user_avatar = $image_query[0]->avatar;
  ?>
  <a class="navbar-brand px-2 d-inline-flex" href="teacher_section.php" style="color:#333 !important">
    <img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 55px;height: 55px;border-radius: 50%;">
    <span class="pt-3 px-2 text-dark"><?php
                                      if (isset($_SESSION['posted_by'])) {

                                        echo $_SESSION['posted_by'];
                                      }
                                      ?></span>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('teacher_section.php') ?>"><i class="fas fa-home"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Profile
        </a>
      </li>

    </ul>
    <div class="d-inline">
      <ul class="list-unstyled">
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="<?= base_url('logout.php') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>

</nav>
</div>
<?php include('t_breadcumb.php'); ?>


<div class="collapse shadow my-4" id="collapseExample" style="position: absolute;top:80px;right:200px;width:500px;z-index:999">
  <div class="card card-body bg-white ">
    <?php
    if (isset($_SESSION['posted_by'])) {

      $teachers = $obj->select('tbl_teacher', '*', 'tid', array($_SESSION['teacher_id']));
    }
    ?>
    <?php if ($teachers) { ?>

      <!-- <span class="font-weight-bold h5"><?= $teachers[0]['tname']; ?>&nbsp;
      
        <?php
        if ($teachers[0]['status'] == 1) { ?>
          <i class="fa fa-circle" style="color:green" style="font-size:14px!important;"></i>
        <?php  } elseif ($teachers[0]['status'] == 0) { ?>
          <i class="fas fa-circle" style="color:grey;"></i>

        <?php   }
        ?>
      </span> -->


      <a class="navbar-brand px-2 d-inline-flex text-dark" href="teacher_section.php">

        <img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 55px;height: 55px;border-radius: 50%;">
        <span class="my-1 px-2"><?php
                                if (isset($_SESSION['posted_by'])) {

                                  echo $_SESSION['posted_by'];
                                }
                                ?></span>
      </a>


      <span>
        <a href="teacherprofile.php?id=<?= $teachers[0]['tid'] ?>" class="text-secondary small"><i class="fas fa-pen"></i>&nbsp; Change profile</a>
      </span>



      <a data-toggle="collapse" data-target="#collapseExample" style="cursor:pointer;position:absolute;top:10px;right:30px" class="h5 bg-light px-3 py-2"><i class="fas fa-close text-danger"></i>
      </a>
      <hr>

      <!-- //subject  -->
      <?php
      $teacherData = $obj->Select('assignedsubject', '*', 'tid', array($_SESSION['teacher_id']));
      if ($teacherData) {  ?>
        <?php foreach ($teacherData as $key => $value) : ?>
          <span>
            <span class="float-left font-weight-bold px-2">

              Subject : <?php
                        $subj = $obj->select("addsubject", "*", "sub_id", array($value['sub']));
                        echo $subj[0]['subjectname'];
                        $sem_str = $obj->select("semesters", "*", "id", array($value['sem']));
                        $sem  =  $sem_str[0]['name'];

                        ?>
            </span>
            <span class="d-flex justify-content-end px-4 font-weight-bold">Semester : <?= $sem ?></span>
          </span>
          <hr>
        <?php endforeach; ?>
      <?php } ?>

      <p> <i class="fas fa-map-marker-alt"></i> &nbsp;<?= $teachers[0]['taddress']; ?></p>
      <p> <i class="fas fa-envelope"></i> &nbsp;<?= $teachers[0]['temail']; ?></p>
      <p> <i class="fas fa-phone"></i> &nbsp;<?= $teachers[0]['tphone']; ?></p>
    <?php } else { ?>
      <h5 class="text-danger">No data available !</h5>
    <?php } ?>
  </div>
</div>
</div>

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
  .navbar-home {
    display: none !important;
  }


  a:hover {
    color: blue !;
  }

  .modal {
    top: 12%;
    display: none;
    /* Hidden by default */
    /*position: fixed; /* Stay in place */

  }

  /* Modal Content */
  .modal-content {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    /*left: 25%;*/
    background: #fff !important;
    color: #000;
    /*border: none!important;*/

  }

  .modal-content p {
    text-align: justify;
  }
</style>