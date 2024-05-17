<?php

if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}
$t_sem = $_GET['sem'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];

$assi_id  = $_GET['aid'];

$t_sub = $_GET['sub'];


include('teacherheader.php');

if (isset($_GET['action'])) { ?>
    <?php
    $a = $obj->Select("tbl_create_assignment", "*", "id", array($_GET['aid']));
    $assi_id = $_GET['aid'];
    $teacher_name = $a[0]['posted_by'];
    $semid = $_GET['sem'];
    $indi_assignment = $obj->Query("SELECT * from tbl_submit_assignment where assignment=$assi_id order by id desc");
    $listStu = $obj->Query("SELECT *  from tbl_student where semester = '$semid' order by sname asc");    ?>

    <style>
        .navbar {
            position: relative !important;
        }

        tr th {
            /* color: #fff !important; */
            font-family: nunito, sans-serif;
        }

        #style th {
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            color: #fff !important;
            font-family: nunito;

        }

        #style td {
            font-family: nunito, sans-serif;
        }
    </style>

    <?php if ($indi_assignment) {  ?>

        <div class="container-fluid pt-4 px-4" style="min-height: 100vh;">
            <div class="row">
                <div class="col-sm-12 px-4 mb-3">

                    <div class="mb-3">
                        <a href="manage_teacher_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&view_assignment"><i class="fas fa-arrow-circle-left" style="font-size: 1.5em;"></i>

                        </a>
                    </div>

                    <?php
                    $tt = $obj->Select("tbl_create_assignment", "*", "id", array($indi_assignment[0]->assignment));
                    $assign_title = $tt['0']['title'];
                    ?>
                    <h5>Assigment: <span class="text-primary"><?= $assign_title ?></span></h4>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table stuTbl table-bordered table-responsive-lite table-hover">
                                <tr style="position: sticky; top:0;background:#f0f0f0;color:#444 !important;">
                                    <th class="text-nowrap">SN</th>
                                    <th class="text-nowrap">Student</th>
                                    <th class="text-nowrap">Has submitted?</th>

                                </tr>

                                <?php foreach ($listStu as $key => $value) : ?>
                                    <tr>
                                        <td><?= ++$key; ?></td>
                                        <td><?= $value->sname; ?></td>
                                        <td>
                                            <?php
                                            $checkHasSubmitted = $obj->Query("SELECT * from tbl_submit_assignment where assignment = '$assi_id' and submitted_by = '$value->sname'");
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              if ($checkHasSubmitted) { ?>
                                                <i class="fas fa-check-circle text-success"></i> Yes
                                            <?php } else { ?>
                                                No
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table id="style" class="table table-bordered table-responsive-lite text-center table-hover">
                        <tr style="position: sticky; top:0;background:darkslategrey;">
                            <th>SN</th>
                            <th>Submitted By</th>
                            <th>Submitted File</th>

                            <th>Status</th>
                        </tr>

                        <?php foreach ($indi_assignment as $key => $value) : ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <?php

                                ?>

                                <td><?= $value->submitted_by; ?></td>
                                <td>

                                    <!-----------------------------Also review this.. Do not delete---->
                                    <!-- <?php if ($value->file != '') { ?>
                    

                        <?php if (is_file($value->file) && file_exists($value->file)) { ?>
                        <a href="submit_assignment/<?= $value->file; ?>">
                        <img src="submit_assignment/<?= $value->file; ?>"
                            alt="Assignment" width="100px"></a>
                    <?php  } else { ?>
                        <?= $value->file; ?>
                   <?php  }
                                            } else {
                                                echo "No file attached";
                                            } ?> -->

                                    <!-------------------------------------------------------->
                                    <!-- <?php if ($value->file != '') { ?>
                                        <a href="submit_assignment/<?= $value->file; ?>">
                                            <img src="submit_assignment/<?= $value->file; ?>" width="100px"></a>
                                    <?php  } else {
                                                echo "No file attached";
                                            } ?> -->

                                    <?php
                                    $extension = pathinfo($value->file, PATHINFO_EXTENSION);
                                    if ($extension == "pdf" | $extension == "docx") { ?>
                                        <a href="submit_assignment/<?= $value->file; ?>" class="btn btn-info btn-sm">View File</a>
                                    <?php } else { ?>
                                        <img src="submit_assignment/<?= $value->file; ?>" width="100px">
                                    <?php } ?>
                                    <?php if ($value->file != '') { ?>
                                    <?php  } else {
                                        echo "No file attached";
                                    } ?>

                                </td>

                                <td>
                                    <?php if ($value->status == 1) { ?>
                                        <button class="btn btn-sm btn-success"><i class="far fa-check"></i> checked</button>
                                        <hr>
                                        <p>Remarks : <?= $value->suggestion ?> </p>

                                    <?php } else { ?>
                                        <a class="btn btn-sm rounded-square btn-primary" href="check_assignment.php?id=<?= $value->id ?>&student=<?= $value->submitted_by ?>&sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>">&nbsp;&nbsp;&nbsp;Check&nbsp;&nbsp;&nbsp;</a>

                                    <?php } ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div style="height:100vh">
            <h5 style="color:red" class="ml-4 mt-4 text-center">No students have submitted to this assignment !</h5>
        </div>
    <?php } ?>
<?php } else { ?>
    <h5 class="text-danger text-center p-3">No students assignment found</h5>
    <div style="min-height:100vh"></div>
<?php } ?>