<?php 


$teachers = $obj->select('tbl_teacher','*','tid',array($_GET['tid']));

?>

<div class="col-md-12 pt-3 ">

    <a href="add_teacher.php"><i class="fas fa-arrow-circle-left fa-2x"></i>

    </a>

    <h4 class="pt-4">Teacher's Detail</h4>
    <br>
    <?php if($teachers){ ?>

    <div class="col-md-12 bg-white">
        <table class="table table-hover table-responsive-lite">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $key => $value): ?>
                <tr>
                    <td><?=++$key?></td>
                    <td><?=$value['tname'];?></td>
                    <td><?=$value['temail'];?></td>
                    <td><?=$value['taddress'];?></td>
                    <td><?=$value['tphone'];?></td>
                    <td><?php 
                            if($value['status'] == 1){ ?>
                        <i class="fas fa-check-circle" style="color:green"></i> Active
                        <?php  }elseif($value['status'] == 0){ ?>
                        <i class="fas fa-times-circle" style="color:red"></i> Unknown

                        <?php   }
                ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php }else{ ?>
    <p>No teacher have registered yet !</p>

    <?php } ?>
</div>