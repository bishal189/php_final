<?php
$t_sem = $_GET['sem'];
$t_sub = $_GET['sub'];


if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}
$stusem = $_GET['sem'];

$listStu = $obj->Query("SELECT *  from tbl_student where semester = '$stusem' order by sname asc ");

?>
<?php include('teacherheader.php'); ?>

<a href="activity.php?sem=<?= $t_sem ?>&sub=<?=$t_sub;?>"><i class="fas fa-arrow-circle-left mx-2 text-success" style="font-size: 1.5em;"></i></a>
<div class="container mt-4">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="alert-info p-3">
                        <?php
                        $subjectt = $_GET['sub'];


                        $tot_marks_subwise = $obj->Query("SELECT count(id) as count_tot_assi from tbl_create_assignment where subject = '$subjectt'");

                        $total_assi = $tot_marks_subwise[0]->count_tot_assi;

                        $total_marks = $total_assi * 5;
                        ?>
                        <div class="row font-weight-bold">
                            <div class="col-6 ">Total Assignments : <?= $total_assi ?>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                Total Marks : <?= $total_marks ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <table class="table stuTbl table-bordered table-responsive-lite table-hover">
                <tr style="position: sticky; top:0;background:#f0f0f0;color:#444 !important;">
                    <th>SN</th>
                    <th>Student</th>
                    <th>Assignment Submitted</th>
                    <th>Percentage</th>
                </tr>

                <?php foreach ($listStu as $key => $value) : ?>
                    <tr>
                        <td><?= ++$key; ?></td>
                        <td><?= $value->sname; ?></td>
                        <td>
                            <?php
                            $howManyAssiSubmitted = $obj->Query("SELECT count(id) as howManyAssi from tbl_submit_assignment  where submitted_by = '$value->sname'")
                            ?>

                            <?= $howManyAssiSubmitted[0]->howManyAssi ?>
                        </td>

                        <td>
                            <?php
                            $marks_gain_quer = $obj->Query("SELECT sum(grade) as marks_gain from tbl_submit_assignment where submitted_by = '$value->sname'");

                            $stu_marks_final = ($marks_gain_quer[0]->marks_gain);

                            $final_mark =   ($stu_marks_final / $total_marks) * 100;
                            echo $final_mark;
                            ?>
                        </td>
                        

                    </tr>
                <?php endforeach; ?>

            </table>


        </div>
    </div>
    <div style="height:40vh">
    </div>