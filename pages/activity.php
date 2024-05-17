<?php
if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}

$t_sem = $_GET['sem'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];



$t_sub =  $_GET['sub'];
// $teacher = $obj->select('tbl_teacher');
// print_r($_SESSION);
?>

<?php include('teacherheader.php') ?>


<div style="height:10vh"></div>
<style>
    .boxstyle {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.16) 0px 0px 0px 1px;
    }
</style>

<div class="container" style="min-height:105vh">
    <div class="row justify-content-center text-center">
        <div class="col-md-3 boxstyle pt-4 pb-4 sh">
            <a href="create_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&create_assignment" class="text-dark">
                <i class="fas fa-plus fa-2x"></i>
                <h5 class="text-dark text-center"><br>
                    Create Assignment</h5>
            </a>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-3 boxstyle pt-4 pb-4">
            <a href="manage_teacher_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&view_assignment" class="text-dark">
                <i class="fas fa-eye fa-2x"></i>

                <h5 class="text-dark"><a href="manage_teacher_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&view_assignment"><br> View Assignments</h5>
            </a>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-3 boxstyle pt-4 pb-4 d-none">
            <i class="fas fa-eye fa-2x"></i>
            <h5 class="text-dark"><a href="view_students_assignment.php"><br>
                    Student's Assignment </a></h5>
        </div>

        <div class="col-md-3 boxstyle pt-4 pb-4 sh">
            <a href="leaderboard.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>" class="text-dark">
                <i class="fas fa-list fa-2x"></i>

                <h5 class="text-dark text-center"><br>
                    LeaderBoard</h5>
            </a>
        </div>
    </div>
</div>