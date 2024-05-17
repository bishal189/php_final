<?php include('studentheader.php');

$s = $_SESSION['student'];

$a = $obj->Query("SELECT * FROM tbl_student where sname ='$s'");
$sem   = $a[0]->semester;

$sub_specif = $_GET['id'];

$loggedInStudent  =  $_SESSION['submitted_by'];


$data = $obj->Query("SELECT * FROM tbl_create_assignment where semester ='$sem' and subject = '$sub_specif' order by id desc");

$isViewedBy = $_SESSION['student'];


?>
<style>
    .navbar {
        position: relative !important;
    }

    tr th {
        color: #fff !important;
        /*font-weight:500;*/
        /* font-family: nunito, sans-serif; */
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

    #style tr:hover {
        background: #f1f1f1 !important;
    }

    .titlehead {
        color: #aa6708;
        border: 1px solid #e7e7e7;
        border-left: 4px solid #aa6708;
        border-radius: 4px;
        padding: 16px;
        padding-left: 10px;
        margin-bottom: 1rem;
        font-family: poppins, sans-serif;
        font-weight: 500;

    }
</style>
<div class="container-fluid" style="min-height:100vh"><br>
    <div class="p-4">
        <?php
        $sub_tid = $obj->select('assignedsubject', '*', 'sub', array($_GET['id']));
        if ($sub_tid) {
            $sub_teacher = $obj->select('tbl_teacher', '*', 'tid', array($sub_tid[0]['tid']));
            $t_profile_photo = $obj->select('tbl_teacher_login', '*', 'teacher', array($sub_teacher[0]['tid'])); ?>
            <div class="row justify-content-center ">
                <div class="col-sm-12">
                    <div style="background-color:#d9d9d9;">
                        <div class="row p-2 mx-1">
                            <div class="col-6">
                                <h6 class="strong d-block"> Subject Teacher </h6>


                                <img src="images/<?= $t_profile_photo[0]['avatar'] ?>" class="rounded-circle img-thumbnail" style="width:50px;height:50px">
                                <?= $sub_teacher[0]['tname'] ?>
                                </h6>
                            </div>

                            <div class="col-6 d-flex justify-content-end">
                                <h6 class="strong pt-2 mt-1"> Subject :
                                    <?= $_GET['sub']; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-sm-12">
                    <?php if ($data) { ?>
                        <div class="card bg-white border-0 shadow-sm px-3">

                            <!-- //scuccess/ -->
                            <?php if (isset($_SESSION['create'])) { ?>
                                <div class="alert alert-success my-3">
                                    <?php echo $_SESSION['create'];
                                    unset($_SESSION['create']);  ?>
                                </div>
                            <?php }  ?>

                            <!-- //deadline meet error  -->
                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger my-3">
                                    <?php echo $_SESSION['error'];
                                    unset($_SESSION['error']);  ?>
                                </div>
                            <?php }  ?>

                            <!-- //already submitted error  -->
                            <?php if (isset($_SESSION['assiError'])) { ?>
                                <div class="alert alert-danger my-3">
                                    <?php echo $_SESSION['assiError'];
                                    unset($_SESSION['assiError']);  ?>
                                </div>
                            <?php }  ?>

                            <?php foreach ($data as $key => $value) : ?>
                                <div class="row ">
                                    <div class="col-3">
                                        <a href="create_assignment/<?= $value->file; ?>"><img src="create_assignment/<?= $value->file; ?>" alt="" class="img-fluid p-3 mx-2"> </a>
                                    </div>

                                    <div class="col-9">
                                        <div class="card card-body my-3">
                                            <p> <span class="text-info"><i class="fas fa-pen "></i> <?= $value->created_date ?></span> </span></p>
                                            <h4><?= $value->title ?></h4>
                                            <span class="position-absolute text-danger" style="right:55px"> Due : <?= $value->deadline ?> </span>
                                            <div class="ans mt-3">
                                                <div class="row">
                                                    <?php
                                                    $checkIsSubmitted = $obj->Query("SELECT * from tbl_submit_assignment WHERE assignment = '$value->id' and submitted_by = '$loggedInStudent'");
                                                    if ($checkIsSubmitted) { ?>

                                                        <div class="col-12 d-flex justify-content-end text-end">
                                                            <a href="<?= base_url('view_assignment_status.php'); ?>">
                                                                <button class="btn btn-light text-success readonly">
                                                                    Submitted <strong><i class="fas fa-eye"></i></strong>
                                                                </button></a>
                                                        </div>

                                                    <?php } else { ?>
                                                        <div class="col-lg-6 text-left">
                                                            <a href="<?= base_url('assignment-detail.php?aid=' . $value->id); ?>" class="btn btn-secondary">
                                                                Post Answer
                                                            </a>
                                                        </div>
                                                    <?php }  ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php } else { ?> <p class="text-danger p-3">No assignment posted.</p> <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="d-flex justify-content-start">
                <strong class="pe-auto" onclick="history.back();"><i class="fas fa-chevron-circle-left fa-2x"></i></button>
            </div>
            <p class="text-danger text-center h6"> No assignment posted for <strong class="h5"><?= $_GET['sub'] ?></strong> </p> <?php } ?>
    </div>

</div>
<script>
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {
            type: "text/csv"
        });

        // Download link
        downloadLink = document.createElement("a");
        downloadLink.download = filename;

        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }


    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);

            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
</script>