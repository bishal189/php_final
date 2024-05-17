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
<?php
$nameArray = array();
$marksArray = array();
$countAssignmentArray = array();
foreach ($listStu as $key => $value) :
    array_push($countAssignmentArray, $obj->Query("SELECT count(id) as howManyAssi from tbl_submit_assignment  where submitted_by = '$value->sname'")[0]->howManyAssi);
    array_push($marksArray, intval($obj->Query("SELECT sum(grade) as marks_gain from tbl_submit_assignment where submitted_by = '$value->sname'")[0]->marks_gain));
    array_push($nameArray, $value->sname);
endforeach;
$leaderBoard = array($countAssignmentArray, $marksArray, $nameArray);
?>
<!-- <pre><?php print_r($leaderBoard) ?></pre> -->


<?php
//Swap Function
function swap(&$array0, &$array1, &$array2, $left, $right)
{
    $temp_marksArray = $array0[$right];
    $temp_nameArray = $array1[$right];
    $temp_countAssignmentArray = $array2[$right];


    $array0[$right] = $array0[$left];
    $array1[$right] = $array1[$left];
    $array2[$right] = $array2[$left];


    $array0[$left] = $temp_marksArray;
    $array1[$left] = $temp_nameArray;
    $array2[$left] = $temp_countAssignmentArray;
}
//Quick Sort Function
function quicksort(&$array0, &$array1, &$array2, $left, $right)
{
    if ($left < $right) {
        $boundary = $left;
        for ($i = $left + 1; $i < $right; $i++) {
            if ($array0[$i] > $array0[$left]) {
                swap($array0, $array1, $array2, $i, ++$boundary);
            }
        }
        swap($array0, $array1, $array2, $left, $boundary);
        quicksort($array0, $array1, $array2, $left, $boundary);
        quicksort($array0, $array1, $array2, $boundary + 1, $right);
    }
}
$array0 = $marksArray;
$array1 = $nameArray;
$array2 = $countAssignmentArray;
quicksort($array0, $array1, $array2, 0, count($array0));

$leaderBoard = array("countAssignment" => $array2, "totalMarks" => $array0, "nameArray" => $array1);

?>
<!-- <pre><?php print_r($leaderBoard) ?></pre> -->

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
                        <div class="col-6 ">Total Assignments : <a href="manage_teacher_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&view_assignment"><?= $total_assi ?>
                            </div></a>
                            <div class="col-6 d-flex justify-content-end">
                                Total Marks : <?= $total_marks ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <?php
            if ($total_marks == 0) { ?>
                <h5 class="text-danger p-3">No results for this subject .</h5>
            <?php } else { ?>
                <table class="table stuTbl table-bordered table-responsive-lite table-hover">
                    <tr style="position: sticky; top:0;background:#f0f0f0;color:#444 !important;">
                        <th>SN</th>
                        <th>Student</th>
                        <th>Assignment Submitted</th>
                        <th>Percentage</th>
                    </tr>

                    <?php
                    for ($index = 0; $index < count($leaderBoard['totalMarks']); $index++) { ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $leaderBoard['nameArray'][$index] ?></td>
                            <td>
                                <?= $leaderBoard['countAssignment'][$index] ?>
                            </td>

                            <td>
                                <?= number_format((float)round(($leaderBoard['totalMarks'][$index] / $total_marks) * 100, 2), 2, '.', ',')  ?> %
                            </td>


                        </tr>
                    <?php } ?>

                </table>
            <?php }  ?>


        </div>
    </div>
    <div style="height:40vh">
    </div>