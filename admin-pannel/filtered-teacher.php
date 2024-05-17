<?php
require_once ("config/config.php");
require_once ("config/db.php");

$check = $_POST['tag'];

$filt_teacher = $obj->select('tbl_teacher','*', 'tsemester',array($check));
$sem_qq = $obj->select('semesters','*', 'id',array($check));
$sem_name = $sem_qq[0]['name'];

?>


<?php if($filt_teacher ){ ?>


<table class="table table-hover table-responsive table-responsive-lite" id="teacherSem_wise">
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
                  <tbody> <?php foreach ($filt_teacher as $key => $value) : ?>

                        <tr>
                           <td><?= ++$key ?></td>
                           <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold"><?= $value['tname']; ?></a></td>
                           <td class="text-nowrap"> <?php
                                                                                 $sem_query = $obj->Select("semesters", "*", "id", array($value['tsemester']));

                                                                                 if ($sem_query && $sem_query[0]['name'] !== null) {
                                                                                    echo $sem_query[0]['name'];
                                                                                 } else { ?> <span class="border-bottom border-danger">
                                    Not assigned </span> <?php } ?> </span>
                           </td>
                           <td class="text-nowrap"> <?php
                                                                                 $sub_query = $obj->Select("addsubject", "*", "sub_id", array($value['tsubject']));

                                                                                 if ($sub_query && $sub_query[0]['subjectname'] !== null) {
                                                                                    echo $sub_query[0]['subjectname'];
                                                                                 } else { ?> <span class="border-bottom border-danger"> Not assigned </span> <?php } ?>
                           </td>
                           <td><?php
                                                                                 if ($value['status'] == 1) { ?> <a href="add_teacher.php?action=inactive&id=<?= $value['tid']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                              <?php  } elseif ($value['status'] == 0) { ?> <a href="add_teacher.php?action=active&id=<?= $value['tid']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>
                              <?php   }
                              ?>
                           </td>
                           <!-- <td><a href="<?= base_url('edit_manage_teachers.php?action=e&id=' . $value['tid']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                           </td> -->
                           <td>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter<?= $value['tid'] ?>" id="btn1" onclick="myFunction();"><i class="far fa-edit"></i> </button>
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter<?= $value['tid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header card-header">
                                          <h4 class="font-weight-bold">Edit teachers details</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body text-left">
                                          <form action="" method="post" class="form-group">
                                             <input type="hidden" name="tid" value="<?= $value['tid']; ?>">
                                             <div class="form-group mb-3">
                                                <label class="font-weight-bold">Teacher's Name</label>
                                                <input type="text" name="tname" class="form-control" required value="<?= $value['tname']; ?>">
                                                <?php if (isset($_SESSION['nameError'])) { ?> <a class="text-primary p-1 my-2"> <?php
                                                                                                                                 echo $_SESSION['editNameError'];
                                                                                                                                 unset($_SESSION['editNameError']);
                                                                                                                                 ?> </a> <?php  } ?>
                                             </div>
                                             <div class="form-group mb-3">
                                                <label class="font-weight-bold">Teacher's Email</label>
                                                <input type="text" name="temail" class="form-control" required value="<?= $value['temail']; ?>">
                                                <?php if (isset($_SESSION['nameError'])) { ?> <a class="text-primary p-1 my-2"> <?php
                                                                                                                                 echo $_SESSION['editEmailError'];
                                                                                                                                 unset($_SESSION['editEmailError']);
                                                                                                                                 ?> </a> <?php  } ?>
                                             </div>
                                             <div class="form-group mb-3">
                                                <label class="font-weight-bold">Teacher's Address</label>
                                                <input type="text" name="taddress" class="form-control" required value="<?= $value['taddress']; ?>">
                                             </div>
                                             <div class="form-group mb-3">
                                                <label class="font-weight-bold">Teacher's Phone</label>
                                                <input type="text" name="tphone" class="form-control" required value="<?= $value['tphone']; ?>">
                                             </div>
                                             <div class="form-group mb-3">
                                                <label class="font-weight-bold" for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                   <option value="1" <?php if ($value['status'] == 1) {
                                                                                    echo "checked";
                                                                                 } ?>>Active</option>
                                                   <option value="0" <?php if ($value['status'] == 0) {
                                                                                    echo "checked";
                                                                                 } ?>>Inactive</option>
                                                </select>
                                             </div>
                                       </div>
                                       <div class="modal-footer card-footer shadow">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button class="btn btn-success" name="updateTeacher" value="update">Update</button>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                           </td>
                           <td><a href="<?= base_url('add_teacher.php?action=d&id=' . $value['tid']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                        </tr> <?php endforeach; ?>
                  </tbody>
               </table>

               <?php } else { ?> 
                <h4 class="p-3 text-primary"> No teacher in <?=$sem_name?> semester. </h4>
                <?php } ?>



