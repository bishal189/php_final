<?php
require_once("config/config.php");
require_once("config/db.php");

$check = $_POST['tag'];
$filt_student = $obj->select('tbl_student', '*', 'semester', array($check));
$sem_qq = $obj->select('semesters', '*', 'id', array($check));
$sem_name = $sem_qq[0]['name'];

?>


<?php if ($filt_student) { ?>

   <table class="table table-hover table-responsive table-responsive-lite" id="studentSem_wise">
      <thead>
         <tr style="background: #f9f9f9;">
            <th>SN</th>
            <th>Name</th>
            <th>Semester</th>
            <th>Roll</th>
            <th>Status</th>
            <th colspan="2" class="text-center">Action</th>
         </tr>
      </thead>
      <tbody> <?php foreach ($filt_student as $key => $value) : ?>

            <tr>
               <td><?= ++$key ?></td>
               <td><a href="student_view_more.php?tid=<?= $value['sid']; ?>" class="text-info font-weight-bold"><?= $value['sname']; ?></a></td>
               <td class="text-nowrap"> <?php
                                          $sem_query = $obj->Select("semesters", "*", "id", array($value['semester']));

                                          if ($sem_query && $sem_query[0]['name'] !== null) {
                                             echo $sem_query[0]['name'];
                                          } else { ?> <span class="border-bottom border-danger">
                        Not assigned </span> <?php } ?> </span>
               </td>
               <td><?= $value['roll_no']; ?></td>

               <td><?php
                     if ($value['status'] == 1) { ?> <a href="add_student.php?action=inactive&id=<?= $value['sid']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                  <?php  } elseif ($value['status'] == 0) { ?> <a href="add_student.php?action=active&id=<?= $value['sid']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>
                  <?php   }
                  ?>
               </td>
               <td><a href="<?= base_url('edit_manage_students.php?action=e&id=' . $value['sid']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
               </td>

               <td><a href="<?= base_url('add_student.php?action=d&id=' . $value['sid']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
            </tr> <?php endforeach; ?>
      </tbody>
   </table>

<?php } else { ?>
   <p class="p-3 text-primary"> No Student in <?= $sem_name ?> semester. </p>
<?php } ?>