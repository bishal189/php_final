<?php
if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}

$t_sem = $_GET['sem'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];

$t_sub = $_GET['sub'];

$tname = $_SESSION['posted_by'];

$data = $obj->Query("SELECT * from tbl_create_assignment where semester = '$t_sem_id' and subject = $t_sub and posted_by ='$tname' order by id desc");


$target = "manage_teacher_assignment.php?sem=$t_sem&sub=$t_sub";


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        // print_r($_GET['id']);
        $obj->Delete("tbl_create_assignment", "id", array($_GET['id']));

        echo "<script> window.location.href='" . base_url($target) . "'</script>";
    }
}
?>




<?php include('teacherheader.php') ?>

<style>
    .navbar {
        position: relative !important;
    }

    tr th {
        color: #fff !important;

        /*font-weight:500;*/
        /* font-size: 5px!important; */
        /*font-family: nunito, sans-serif;*/
    }

    a {
        cursor: pointer;
        text-decoration: none !important;
    }

    #style th {
        padding: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        /* color: #fff !important; */
        font-family: roboto, sans-serif;

    }

    #style td {
        text-align: center;
        font-family: nunito, sans-serif;
    }

    .detailview {
        border: 1px solid #e7e7e7;
        border-left: solid 4px orange;
        border-radius: 4px;
    }

    .detailview h6 {
        line-height: 1.6;
    }

    .sname {
        font-family: nunito, sans-serif;
    }
</style>


<?php if ($data) {  ?>
    <br>

    <div class="container-fluid px-5 pt-2" style="min-height: 100vh;">

        <div class="d-flex justify-content-between mb-3">
            <a href="activity.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>"><i class="fas fa-arrow-circle-left mt-0 ml-2 text-success" style="font-size: 1.5em;"></i></a>


            <span class="d-flex justify-content-end"> <a href="create_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&create_assignment" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create New </a></span>
        </div>


        <div class="contsainer detasilview" style="font-family:nunito, sans-serif;">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'check_total') {

                $total_count =  $obj->Query("SELECT COUNT(id) as total_nums FROM tbl_submit_assignment WHERE assignment = " . $_GET['aid']);

                $total_stu = $obj->Query("SELECT count(*) as total from tbl_student");
                $remaining = $total_stu[0]->total - $total_count[0]->total_nums;

            ?>

                <h6> Total Students :
                    <!-----------target in up------------------->
                    <a class="text-dark"> &nbsp;<?= $total_stu[0]->total; ?></a>
                    <a class="text-primary ml-2" style="background: snow;padding: .5rem;" data-toggle="modal" data-target=".bs-example-modal-lg">View </a>
                </h6>

                <h6>No of Student who have submitted : <a class="text-dark"><?= $total_count[0]->total_nums; ?></a><a class="text-primary ml-2" href="<?= base_url('view_students_assignment.php'); ?>">View </a>
                </h6>

                <h6>No of Student who haven't submitted : <a href="##" class="text-dark"><?= $remaining ?></a>
                </h6>
            <?php }
            ?>
        </div>
        <style>
            body {
                background: #f9f9f9 !important;
            }
        </style>

        <div class="row">
            <table id="style" class="table table-bordered table-hover table-responsive-lite">
                <tr style="position: sticky; top:0;background:darkslategrey!important;">
                    <th>SN</th>
                    <th> Assignment</th>
                    <th>Question</th>

                    <!-- <th>Posted by</th>  -->
                    <th colspan="2">Action</th>
                </tr>
                <?php foreach ($data as $key => $value) : ?>

                    <tr>
                        <td><?= ++$key; ?></td>
                        <td class="text-left">
                            <h6 class="font-weight-bold"> <?= $value->title; ?>
                            </h6>

                            <div class="d-lg-flex justify-content-between">
                                <div>
                                    <p class="small mb-0 text-secondary">Created: <span>
                                            <?= $value->created_date; ?></span>
                                    </p>
                                    <p class="small mb-0 text-secondary">Deadline: <span class="opacity-50"><?= $value->deadline; ?></span></p>
                                </div>

                                <div>
                                    <p class="text-left text-secondary small" data-toggle="modal" data-target="#seenModal<?= $value->id ?>">
                                        <!-- //algorithm     -->
                                        <?php
                                        $viewers_q = $obj->select('viewers', '*', 'aid', array($value->id));
                                         echo "<span>Seen by: </span>";
                                        if ($viewers_q) {
                                            $num_viewers = count($viewers_q);
                                           
                                            echo "<span>$num_viewers</span>";
                                        } else {
                                          
                                            echo "<span class='text-danger'>Nobody</span>";
                                        }
                                        ?>
                                    </p>

                                </div>
                            </div>


                            <!-- Modal -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" onclick="showDetails('<?= $value->id ?>')" data-target="#seenModal<?= $value->id ?>">
                                Show Viewers
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="seenModal<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="seenModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="seenModalLabel"><?= $value->title ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- This is the hidden div that will display the viewer details -->
                                        <div class="modal-body" style="display: none">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-dark">Student Name</th>
                                                        
                                                        <th scope="col" class="text-dark">Time</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php
                                                    $v_students = $obj->query("
                                                        SELECT s.username, v.time 
                                                        FROM viewers v 
                                                        INNER JOIN tbl_student_login s ON v.sid = s.sid 
                                                        WHERE v.aid = '{$value->id}'
                                                    ");
                                                    
                                                    if ($v_students) {
                                                        foreach ($v_students as $index => $viewer) {
                                                            echo "<tr>";
                                                            echo "<td>{$viewer->username}</td>";
                                                            
                                                            echo "<td>{$viewer->time}</td>"; // Display the time column from the viewers table
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='3' class='text-center'>No viewers found</td></tr>";
                                                    }
                                                    ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                       
                                    </div>
                                </div>
                            </div>

                            <!-- This is the JavaScript function that shows the hidden div when the user clicks the "View Details" button -->
                            <script>
                                function showDetails(id) {
                                    // Get the hidden div that displays the viewer details
                                    var detailsDiv = document.getElementById('seenModal' + id).querySelector('.modal-body');

                                    // Show the hidden div
                                    detailsDiv.style.display = 'block';
                                }
                            </script>


                        <td>
                            <?php if ($value->file != '') { ?>
                                <a href="create_assignment/<?= $value->file; ?>"><img src="create_assignment/<?= $value->file; ?>" alt="Assignment" width="100px"></a>
                            <?php  } else {
                                echo "No file attached";
                            } ?>
                        </td>

                        <!-- <td><?= $value->posted_by; ?></td> -->
                        <!-- <td>
                            <a href="edit_assignment.php?action=e&id=<?= $value->id; ?>&sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>" class="text-primary font-weight-bold"><i class="fas fa-edit"></i> </a>    
                        </td> -->
                        <td>
                            <a href="view_students_assignment.php?action=detail&sem=<?= $t_sem ?>&sub=<?= $t_sub ?>&aid=<?= $value->id ?>" class=" text-light btn btn-sm bg-secondary"><i class="fas fa-eye"></i> View Detail </a>
                        </td>
                        <td class="">
                            <?php
                            $isDeletable = $obj->select('tbl_submit_assignment', '*', 'assignment', array($value->id));
                            if ($isDeletable) { ?>
                                <a class="text-danger font-weight-bold" data-toggle="tooltip" data-placement="top" title="Can't delete this. Some students assignments might get affected"><i class="fas fa-trash-alt"></i> </a>
                            <?php } else { ?>
                                <a href="manage_teacher_assignment.php?id=<?= $value->id ?>&action=d&sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&view_assignment" class="text-danger font-weight-bold" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i> </a>
                            <?php }  ?>
                        </td>


                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>


<?php } else { ?>
    <div style="height:100vh">
        <h4 style="color:red" class="ml-4 mt-4 text-center">Looks like you've not created any assignment.</h4>
        <p class="text-center"><a href="create_assignment.php?sem=<?= $t_sem ?>&sub=<?= $t_sub; ?>&create_assignment"> <i class="fas fa-plus"></i> Create Assignment</a></p>
    </div>
<?php } ?>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>