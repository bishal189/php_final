<?php
if(!isset($_SESSION['isTeacher'] ) && $_SESSION['isTeacher']!='true'){
    header('location:teacher_login.php');
    }
    $connection = mysqli_connect('localhost','root','','new_ams');
    if(isset($_POST['search'])){
        $search = $_POST['search'];

        $sql="SELECT * FROM tbl_submit_assignment WHERE  CONCAT('id', 'submitted_by')LIKE'%$search%'";
        }else{

        $sql="SELECT * FROM tbl_submit_assignment";

        $search="";
         } 
              $result=mysqli_query($connection,$sql);

              if (isset($_SESSION['teacher_id'])) {
$tid = $obj->select('tbl_teacher','tname','tid',array($_SESSION['teacher_id']));
// print_r($tid); die;/

$individualSub = $obj->select('tbl_create_assignment','*','posted_by',array($tid[0]['tname']));
// print_r($individualSub);



if($individualSub){

$data = $obj->select('tbl_create_assignment','*','subject',array($individualSub[0]['subject']));

}else{
    $data = '';
}
}
$data = $obj->select('tbl_submit_assignment as sa join tbl_create_assignment as ca on sa.assignment=ca.id', '*','ca.posted_by',array($individualSub[0]['posted_by']));

 ?>

<div class="row">
        <table  id="style" class="table table-bordered table-responsive-lite table-hover">
        <tr style="position: sticky; top:0;background:darkslategrey;">
                <th>SN</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Submitted By</th>
                <th>Submitted Date</th>
                <th>File</th>
                <th>Check</th>
         </tr>
        
            <?php foreach($data as $key=>$value) : ?>
            <tr> 
                <td><?=++$key;?></td>
                <?php  
               
                 ?>
                <td><?=$value['subject'];?></td>
                <td><?=$value['title'];?></td>
                <td><?=$value['submitted_by'];?></td>
                <td><?=$value['submitted_date'];?></td>
                <td>
                    <?php if($value['file'] != ''){ ?>
                    

                        <?php if(is_file($value['file']) && file_exists($value['file'])) { ?>
                        <a href="submit_assignment/<?=$value['file'];?>">
                        <img src="submit_assignment/<?=$value['file'];?>"
                            alt="Assignment" width="100px"></a>
                    <?php  }else{ ?>
                        <?=$value['file'];?>

                   <?php  }


                }else{echo"No file attached";} ?>
                </td>
                <td>
                    <?php if($value['status'] == 1){ ?>
                    <button class="btn  btn-success">checked</button>

                    <?php }  else{ ?>
                    <a class="btn btn-sm rounded-square btn-primary" href="<?=base_url('check_assignment.php?id='.$value['id']);?>">Check</a>
                    
                    <?php }?>
                </td>

            </tr>
            <?php endforeach; ?>
        </table>
    </div>