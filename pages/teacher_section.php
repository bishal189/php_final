<?php
if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}

// $teacher = $obj->select('tbl_teacher');
// print_r($_SESSION);
?>

<?php include('teacherheader.php') ?>


<div style="height:10vh"></div>
<style>
    .boxstyle {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.16) 0px 0px 0px 1px;
        padding: 2.5rem 1rem;
    }

    .not_in_Homepage {
        display: none;
    }
</style>


<?php
$teacher_str = $obj->select('tbl_teacher_login', '*', 'tid', array($_SESSION['tid']));
$realId =   $teacher_str[0]['teacher'];

$teacher_data = $obj->select('assignedsubject', '*', 'tid', array($realId), ' Group by sem order by id desc');

// // die;
// $teacher_section = $teacher_str[0]['tsemester'];
// $teacher_subject = $teacher_str[0]['tsubject'];
?>

<div class="container" style="min-height:105vh">
    <div class="row text-center">
        <?php foreach ($teacher_data as $key => $value) : ?>
            <?php
            $t_sem_str = $obj->select('semesters', '*', 'id', array($value['sem']));
            $t_sem =  $t_sem_str[0]['name'];
            $t_sem_id =  $t_sem_str[0]['id'];
            // print_r($t_sem_id);

            // $tname  = $_SESSION['posted_by'];

            $tid = $_SESSION['teacher_id'];

            // print_r($tname);

            // $sem_ = $obj->select('tbl_teacher', '*', '', array($value['tsemester']));

            $t_sub_str = $obj->Query("SELECT * from assignedsubject where tid = '$tid'");
            $t_sub =  $t_sub_str[0]->sub;

            // print_r($t_sub);
            ?>
            <div class="col-md-3 text-center mb-3">
                <div class="card card-header">
                <h5>Semester</h5> <?= $t_sem ?>
                </div>
                <div class="card-body sh">
                    <!-- <a href="create_assignment.php?sem=<?= $t_sem ?>" class="text-dark">                -->
                    
                            <?php $relativeSub = $obj->Query("SELECT * from assignedsubject where sem = '$t_sem' and tid = $realId");
                            ?>

                            <ul class="list-unstyled">
                                <?php foreach ($relativeSub as $key => $value) : ?>
                                    <a href="activity.php?sem=<?= $t_sem ?>&sub=<?=$value->sub?>" class="text-dark">
                                    <li class="btn btn-primary d-block my-2">
                                        <?php
                                        $t_sub_strr = $obj->Query("SELECT * from addsubject where sub_id = $value->sub");
                                        $t_sub_name =  $t_sub_strr[0]->subjectname;
                                        ?>
                                        <?= $t_sub_name ?>

                                    </li>
                                    </a>
                                <?php endforeach ?>

                            </ul>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<div class="container d-none" style="min-height:105vh">
    <div class="row justify-content-center text-center">
        <div class="col-md-3 boxstyle pt-4 pb-4 sh">
            <a href="create_assignment.php" class="text-dark">
                <i class="fas fa-plus fa-2x"></i>
                <h5 class="text-dark text-center"><br>
                    Create Assignment</h5>
            </a>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3 boxstyle pt-4 pb-4">
            <a href="manage_teacher_assignment.php" class="text-dark">
                <i class="fas fa-list fa-2x"></i>
                <h5 class="text-dark"><a href="manage_teacher_assignment.php"><br> View Assignments</h5>
            </a>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-3 boxstyle pt-4 pb-4 d-none">
            <i class="fas fa-eye fa-2x"></i>
            <h5 class="text-dark"><a href="view_students_assignment.php"><br>
                    Student's Assignment </a></h5>
        </div>
    </div>
</div>