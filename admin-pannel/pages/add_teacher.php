<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
   echo "<script> window.location.href='" . base_url() . "'</script>";
}

if (isset($_GET['action'])) {
   if ($_GET['action'] == 'd') {
      $check = $_GET['id'];
      $checkSub = $obj->Select('assignedsubject', '*', 'tid', array($check));
      // if($checkSub)
      // {
      //  echo "yes";
      // }

      $hasStudentAssignment = $obj->select('tbl_submit_assignment', '*', 'tid', array($check));
      if ($hasStudentAssignment) {
         echo '<script>alert("Cannot delete teacher! Assigments are pending.");</script>';
         echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
      } else {
         $a = $obj->Delete("assignedsubject", "tid", array($check));
         $c = $obj->Delete("tbl_teacher_login", "teacher", array($check));
         $b = $obj->Delete("tbl_create_assignment", "tid", array($check));
         $d = $obj->Delete("tbl_teacher", "tid", array($_GET['id']));
         if ($a && $b && $c && $d) {
            echo '<script>alert("Teacher deleted successfully!");</script>';
            echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
         } else {
            echo '<script>alert("Error deleting teacher!");</script>';
            echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
         }
      }


      // $TeaNam = $techNaam_q[0]['tname'];

      //   $obj->Delete("tbl_teacher_login", "teacher", array($_GET['id']));

      //   $obj->Delete("tbl_create_assignment", "posted_by", array($TeaNam));

      //   $obj->Delete("tbl_teacher", "tid", array($_GET['id']));
      //echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
   } elseif (($_GET['action'] == 'd_assigned')) {
      $obj->Delete("assignedSubject", "id", array($_GET['id']));
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
   $tphone = $_POST['tphone'];


   $check_email = $obj->Query("SELECT * FROM tbl_teacher where temail='$temail'");
   $check_phone = $obj->Query("SELECT * FROM tbl_teacher where tphone='$tphone'");

   if ($check_email) { ?>
      <style>
         .collapse {
            display: block !important;
         }
      </style>
   <?php $_SESSION['emailError'] = "Email already exists!";
   } elseif ($check_phone) { ?>
      <style>
         .collapse {
            display: block !important;
         }
      </style>
      <?php $_SESSION['phoneError'] = "Phone already exists!"; ?>

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


<?php
//update teacher
if (isset($_POST['submit'])) {
   if ($_POST['submit'] == 'updateT') {
      unset($_POST['submit']);
      $IsUpdated = $obj->Update('assignedsubject', $_POST, 'tid', array($_POST['tid']));
      if ($IsUpdated) {
         echo '<script>alert("Data updated successfully!")</script>';
      }
   }
}


// assign teacher
if (isset($_POST['assign'])) {
   if (($_POST['assign']) == 'Assign') {
      $tsem = $_POST['sem'];
      $tsub = $_POST['sub'];
      $tname = $_POST['tid'];
      unset($_POST['assign']);

      $check_repeated = $obj->Query("SELECT * from assignedSubject where tid = $tname and sub = $tsub and sem = $tsem");
      $check_exists = $obj->Query("SELECT * from assignedSubject where sub = $tsub and sem = $tsem");


      if ($check_repeated) {
         echo '<script>alert("Teacher already assigned !")</script>';
         echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
      } elseif ($check_exists) {
         echo '<script>alert("Subject is already assigned to another teacher !")</script>';
         echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
      } else {

         $a = $obj->Insert("assignedsubject", $_POST);

         $assigned_tid = $_POST['tid'];

         $b = $obj->Query("UPDATE tbl_teacher set  isAssigned = 1 where tid = $assigned_tid ");

         echo '<script>alert("Teacher assigned successfully")</script>';
         echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
      }
   }
}

//update Teacher 
if (isset($_POST['updateT'])) {
   $old = $_POST;
   $tid = $_POST['tid'];
   // print_r($tid);
   // die;
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
   } elseif ($check_phone) { ?>
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

$all_teachers = $obj->select('tbl_teacher', '*', '', array(), ' ORDER BY tid desc');

$assigned_teachers = $obj->select('assignedSubject', '*', '', array(), ' ORDER BY id desc');



$teachers = $obj->select('tbl_teacher', '*', '', array(), ' GROUP by tname ORDER BY status');
$v_teachers = $obj->select('tbl_teacher', '*', '', array(), 'ORDER BY tid desc ');

// $v_teachers = $obj->select('tbl_teacher', '*', '', array(),'GROUP by tname desc');



$subject = $obj->select('addsubject');
$semester = $obj->Query("SELECT * from semesters order by name asc");
?>
<div class="container">
   <br>
   <div class="row">
      <div class="col-md-3 shadow-sm p-3">
         <div>
            <div class="card">
               <button class="btn btn-info bg-info text-light font-weight-bold" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> &nbsp;Add new teacher</button>
               </button>
            </div>
            <div class="collapse" id="collapseExample">
               <div class="card-body bg-white shadow-sm">
                  <form action="" method="post" class="form-group">
                     <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="tname" required class="form-control">
                        <a class="text-primary"> <?php if (isset($_SESSION['nameError'])) {
                                                      echo $_SESSION['nameError'];
                                                      unset($_SESSION['nameError']);
                                                   } ?></a>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="temail" class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <a class="text-primary"> <?php if (isset($_SESSION['emailError'])) {
                                                      echo $_SESSION['emailError'];
                                                      unset($_SESSION['emailError']);
                                                   } ?></a>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="taddress" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label>Phone</label>
                        <input type="text" maxlength="10" id="phone" name="tphone" class="form-control" pattern="\d{10}" title="Please enter exactly 10 digits" required />
                        <a class="text-primary"> <?php if (isset($_SESSION['phoneError'])) {
                                                      echo $_SESSION['phoneError'];
                                                      unset($_SESSION['phoneError']);
                                                   } ?></a>
                        <!-- <input type="number" id="phone" name="tphone" class="form-control" maxlength="10" pattern="[7-9]{1}[0-9]{9}"> -->
                     </div>
                     <!-- <script>
                        function validation(){
                           let x = document.forms["check"]["tphone"].value;
                           if(x.length!=10){
                              alert ('Phone Number must be exactly 10 digits.');
                              return false;
                           }
                                                }
                        </script> -->
                     <div class="form-group mb-3">
                        <label class="font-weight-bold" for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                     <button class="btn btn-success" name="submit" value="add">Add</button>
                  </form>
               </div>
            </div>
         </div>
         <!-- //Assign subject teacher  -->
         <div class="card card-header bg-secondary font-weight-bold mt-4">
            <i class="fad fa-chalkboard-teacher fa-2x"></i> Assign Subject Teacher ? </button>
         </div>
         <div class="card-body bg-light shadow">
            <form action="" method="POST">
               <div class="form-group">
                  <label>Teacher</label>
                  <select class="form-control" name="tid" required>
                     <option selected disabled value="">Choose a teacher</option>
                     <?php if ($teachers) { ?>
                        <?php foreach ($teachers as $key => $value) : ?>
                           <option value="<?= $value['tid']; ?>">
                              <?= $value['tname']; ?>
                           </option>
                        <?php endforeach; ?> <?php  }  ?>
                  </select>
               </div>
               <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control" name="sem" required onchange="studentAssignment(this.value)">
                     <option selected disabled value="">Choose a semester</option>
                     <?php if ($semester) { ?>
                        <?php foreach ($semester as $key => $value) : ?>
                           <option value="<?= $value->id; ?>">
                              <?= $value->name; ?>
                           </option>
                        <?php endforeach; ?> <?php  }  ?>
                  </select>
               </div>
               <div class="form-group" id="studentAssignment">
                  <?php if (isset($_SESSION['subError'])) { ?>
                     <div class="alert alert-primary p-2 my-2">
                        <span> <?php
                                 echo $_SESSION['subError'];
                                 unset($_SESSION['subError']);
                                 ?> </span>
                        <span class="text-info small" href="#" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" style="cursor: pointer;"><strong><i> More Info </i></strong></span>
                        <div class="collapse" id="collapseExample2">
                           <div class="bg-light p-2 text-dark small">
                              <strong><?= $msgTname ?></strong> teaches <strong><?= $msgTsub ?></strong> in <i><?= $msgTsem ?> semester.</i>
                           </div>
                        </div>
                     </div>
                  <?php  } ?>
               </div>
               <button class="btn btn-success btn-block" type="submit" name="assign" value="Assign">Assign</button>
            </form>
         </div>
      </div>
      <div class="col-md-8 columnhead pt-3" style="min-height:85vh;">
         <?php if ($v_teachers) { ?>
            <div class="col-md-12">

               <ul class="list-unstyled sem-nav d-flex">
                  <?php $semCounter = sizeof($semester);
                  $semIdx = 0;
                  ?>

               </ul>
               <span class="float-right text-light pb-4 position-absolute" style="top:0;right:18px"> <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search teachers..">
               </span>
               <br>
               <div class="card-header bg-white">
                  <style>
                     .nav-tabs .nav-link {
                        color: #444;
                        padding: 6px;
                     }

                     .nav-tabs .nav-link.active,
                     .nav-tabs .nav-item.show .nav-link {
                        color: #fff;
                        background-color: #029acf;
                        border-color: #ccc #ccc #FCFCFC;
                     }
                  </style>
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">All Teachers</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"> Assigned Teachers</a>
                     </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <table class="table table-hover table-responsive-lite" id="teacherSem_wise">
                           <thead>
                              <tr style="background: #f9f9f9;">
                                 <th>SN</th>
                                 <th>Name</th>
                                 <th>Address</th>
                                 <th>Phone</th>
                                 <th>Status</th>
                                 <th colspan="2" class="text-center">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach ($all_teachers as $key => $value) : ?>
                                 <tr>
                                    <td><?= ++$key ?></td>
                                    <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold"><?= $value['tname'] ?></a></td>
                                    <td class="text-nowrap"><?= $value['taddress'] ?></td>
                                    <td><?= $value['tphone'] ?></td>
                                    <td>
                                       <?php
                                       if ($value['status'] == 1) { ?>
                                          <a href="add_teacher.php?action=inactive&id=<?= $value['tid']; ?>">
                                             <i class="fas fa-check-circle " style="color:green"></i>
                                          </a>
                                       <?php  } elseif ($value['status'] == 0) { ?>
                                          <a href="add_teacher.php?action=active&id=<?= $value['tid']; ?>">
                                             <i class="fas fa-times-circle " style="color:red"></i>
                                          </a>
                                       <?php   }
                                       ?>
                                    </td>
                                    <td>
                                       <!-- Button trigger modal -->
                                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?= $value['tid']; ?>" data-backdrop="true">
                                          <i class="far fa-edit"></i>
                                       </button>

                                       <style>
                                          .modal {
                                             background-color: rgba(0, 0, 0, 0.7) !important;
                                          }
                                       </style>
                                       <!-- Modal -->
                                       <div class="modal fade" id="exampleModal<?= $value['tid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                             <div class="modal-content">
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
                                                         <label>Full Name</label>
                                                         <input type="text" name="tname" class="form-control" value="<?= $value['tname'] ?>">
                                                         <a class="text-primary"> <?php if (isset($_SESSION['nameError'])) {
                                                                                       echo $_SESSION['nameError'];
                                                                                       unset($_SESSION['nameError']);
                                                                                    } ?></a>
                                                      </div>
                                                      <div class="form-group">
                                                         <label>Email</label>
                                                         <input type="text" name="temail" class="form-control" value="<?= $value['temail'] ?>">
                                                         <a class="text-primary"> <?php if (isset($_SESSION['emailErrorEdit'])) {
                                                                                       echo $_SESSION['emailErrorEdit'];
                                                                                       unset($_SESSION['emailErrorEdit']);
                                                                                    } ?></a>
                                                      </div>
                                                      <div class="form-group">
                                                         <label>Address</label>
                                                         <input type="text" name="taddress" class="form-control" value="<?= $value['taddress'] ?>">
                                                      </div>
                                                      <div class="form-group">
                                                         <label>Phone</label>
                                                         <input type="text" maxlength="10" id="phone" name="tphone" value="<?= $value['tphone'] ?>" class="form-control" pattern="\d{10}" title="Please enter exactly 10 digits" /><a class="text-primary mx-2"><?php if (isset($_SESSION['phoneErrorEdit'])) {
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
                                          </div>
                                       </div>
                                    </td>
                                    <td><a href="<?= base_url('add_teacher.php?action=d&id=' . $value['tid']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                                 </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>

                     <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <?php if ($assigned_teachers) { ?>
                           <table class="table table-hover table-responsive-lite" id="deleted_updated_data">
                              <thead>
                                 <tr style="background: #f9f9f9;">
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Semester</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($assigned_teachers as $key => $value) : ?>
                                    <tr>
                                       <td><?= ++$key ?></td>
                                       <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold">
                                             <?php
                                             $t_quer = $obj->select('tbl_teacher', '*', 'tid', array($value['tid']));
                                             $t_name =   $t_quer[0]['tname']; ?>
                                             <?= $t_name ?>
                                          </a>
                                       </td>
                                       <td>
                                          <?php
                                          $sem_quer = $obj->select('semesters', '*', 'id', array($value['sem']));
                                          $sem_name =   $sem_quer[0]['name']; ?>
                                          <?= $sem_name ?>
                                       </td>
                                       <td>
                                          <?php
                                          $sub_quer = $obj->select('addsubject', '*', 'sub_id', array($value['sub']));
                                          $sub_name =   $sub_quer[0]['subjectname']; ?>
                                          <?= $sub_name ?>
                                       </td>
                                       <td><button class="btn btn-primary btn-sm" onclick="delete_indiv(<?= $value['id'] ?>);"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                 <?php endforeach; ?>
                              </tbody>
                           </table>
                        <?php } else { ?> <p class="text-primary pt-3">No teachers have been assigned to any subject !</p> <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         <?php } else { ?>
            <p class="p-3 my-5 text-primary">No teacher have been added yet !</p>
         <?php } ?>
      </div>
   </div>
</div>
<style>
   /* data-backdrop="false" */
   .modal-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
   }

   .modal {
      z-index: 1;
   }

   .modal-backdrop {
      background-color: transparent;
   }

   .modal-content {
      box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
   }

   .modal-body {
      background-color: #fff;
   }
</style>
<script>
   function showFunction() {
      var div = document.getElementById("msg");
      div.classList.toggle('hidden');
   }
</script>
<script>
   //filter teacher
   function semFunction(data, i) {
      let counter = "<?= $semCounter; ?>";
      $.ajax({
         type: "POST",
         url: 'filtered-teacher.php',
         data: {
            tag: data

         },
         success: function(e) {
            $('#teacherSem_wise').html(e);

         }
      })
   }


   //delete assigned teacher
   function delete_indiv(data) {
      let counter = "<?= $semCounter; ?>";
      $.ajax({
         type: "POST",
         url: 'delete_assigned_teacher.php',
         data: {
            tag: data

         },
         success: function(e) {
            $('#deleted_updated_data').html(e);

         }
      })
   }

   //fetch subject 
   function studentAssignment(val) {
      // alert(val);
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {

         if (this.readyState == 4 && this.status == 200) {
            document.getElementById('studentAssignment').innerHTML = this.responseText;

         }
      }
      xhr.open('GET', 'ajax/getSubject.php?sem=' + val, true);
      xhr.send();
   }
</script>
<script>
   //     $('#btn1').click(function() {
   //   // reset modal if it isn't visible
   //   if (!($('.modal.in').length)) {
   //     $('.modal-dialog').css({
   //       top: 0,
   //       left: 0
   //     });
   //   }
   //   $('#myModal').modal({
   //     backdrop: false,
   //     show: true
   //   });
   //   $('.modal-dialog').draggable({
   //     handle: ".modal-header"
   //   });
   // });
</script>