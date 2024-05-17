<?php 


$students = $obj->select('tbl_student','*','sid',array($_GET['tid']));

?>

<div class="col-md-12 pt-3">

    <a href="add_student.php"><i class="fas fa-arrow-circle-left fa-2x"></i>

    </a>

    <h4 class="pt-4">Student's Detail</h4>
    <br>
    <?php if($students){ ?>

    <div class="col-md-12">
        <table class="table table-bordered table-hover table-responsive-lite">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Student's Name</th>
                    <th>Email</th>
                    <th> Roll No</th>
                    <th> Address</th>
                    <th>Phone</th>
                    <th>Status</th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $key => $value): ?>
                <tr>
                    <td><?=++$key?></td>
                    <td><?=$value['sname'];?></td>
                    <td><?=$value['email'];?></td>
                    <td><?=$value['roll_no'];?></td>
                    <td><?=$value['saddress'];?></td>
                    <td><?=$value['sphone'];?></td>
                    <td><?php 
                            if($value['status'] == 1){ ?>
                        <i class="fas fa-check-circle fa-2x" style="color:green"></i>
                        <?php  }elseif($value['status'] == 0){ ?>
                        <i class="fas fa-times-circle fa-2x" style="color:red"></i>

                        <?php   }
                ?>
                    </td>




                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php }else{ ?>
    <p>No Student have registered yet !</p>

    <?php } ?>
</div>