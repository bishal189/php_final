<?php
if (!isset($_SESSION['isStudent']) && $_SESSION['isStudent'] != 'true') {
    header('location:student_login.php');
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $obj->Delete("tbl_submit_assignment", "id", array($_GET['id']));
        echo '<script>alert("Succesfully deleted!")</script>';

        echo "<script> window.location.href='" . base_url('student_sectionnew.php') . "'</script>";
    }
}


$data = $obj->select('tbl_submit_assignment', '*', 'submitted_by', array($_SESSION['submitted_by']));

include('studentheader.php');
?>


<style>
    .navbar {
        position: relative !important;
    }


    #style th {
        padding: 4px;
        text-align: center;
        /*font-weight: bold;*/
        font-size: 16px;
        color: #fff !important;
        font-family: roboto, sans-serif;

    }

    #style td,
    button {
        text-align: left;
        font-size: 15px;
        font-family: roboto, sans-serif;
    }
</style>

<?php if ($data) {  ?>

    <div class="container pt-4" style="min-height: 100vh;">

        <div class="row">
            <div class="col-md-12">

                <table id="style" class="table table-bordered table-responsive-lite">
                    <tr style="position: sticky; top:0;background:darkslategrey!important;text-align: left;">
                        <th>SN</th>
                        <th>Subject</th>
                        <th>Assignment</th>
                        <th>Submitted File</th>
                        <th>Posted Date</th>
                        <th>Submitted Date</th>
                        <th style="width:150px;">Status</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($data as $key => $value) : ?>
                        <tr class="bg-white">

                            <td class="text-nowrap"><?= ++$key; ?></td>
                            <?php $data = $obj->select('tbl_create_assignment', '*', 'id', array($value['assignment'])) ?>
                            <td class="text-nowrap">
                                <?php $sub_quer = $obj->select('addsubject', '*', 'sub_id', array($data[0]['subject'])) ?>
                                <?= $sub_quer[0]['subjectname']; ?>
                            </td>
                            <td style="word-wrap: break-word;min-width: 100px;max-width: 380px;">
                                <div style="background-color: #ededed;padding:0.6rem;border-left:3px solid #76afed">
                                    <h6><strong><?= $data[0]['title']; ?></strong></h6>
                                    <p>
                                        <?= $data[0]['description']; ?>
                                    </p>
                                </div>
                            </td>



                            <td class="text-nowrap">
                                <?php
                                $extension = pathinfo($value['file'], PATHINFO_EXTENSION);
                                if ($extension == "pdf" | $extension == "docx") { ?>
                                    <a href="submit_assignment/<?= $value['file']; ?>" class="btn btn-info btn-sm font-weight-bold">View File</a>
                                <?php } else { ?>
                                    <img src="submit_assignment/<?= $value['file']; ?>" width="100px">
                                <?php } ?>
                                <?php if ($value['file'] != '') { ?>
                                <?php  } else {
                                    echo "No file attached";
                                } ?>
                            </td>
                            <!-- <td class="text-nowrap"><?= $value['submitted_by']; ?></td> -->
                            <td class="text-nowrap"><?= $data[0]['created_date']; ?></td>
                            <td class="text-nowrap"><?= $value['submitted_date']; ?></td>

                            <td>
                                <?php if ($value['status'] == 1) { ?>
                                    <button class="btn btn-sm btn-success"><i class="far fa-check"></i> checked</button>
                                    <div style="word-wrap: break-word;min-width: 100px;max-width: 380px;">
                                        <p class="p-2">
                                            <!-- <strong><?= $value['grade']; ?></strong> -->
                                            <?= $value['suggestion']; ?>
                                        </p>
                                    <?php } else { ?>
                                        <a class="btn btn-sm btn-warning">&nbsp;&nbsp;Pending&nbsp;&nbsp;</a>

                                    <?php } ?>
                            </td>

                            <!--     <td>
                     <!--  <a href="edit_student_assignment.php?action=e&id=<?= $value['id']; ?>" class="text-primary font-weight-bold"><i class="fas fa-edit"></i> </a> -->

                            <!-- <a href="<?= base_url('edit_student_assignment.php?action=e&id=' . $value['id']) ?>"
                                class="btn btn-outline-info btn-sm"
                                onclick="return confirm('Are you sure want to edit?')"><i class="far fa-edit"></i></a> -->

                            </td>


                            <td>
                                <a href="<?= base_url('edit_student_assignment.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm font-weight-bold" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i> </a>

                            </td>


                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <!-- <button class="btn btn-info text-white" onClick="exportTableToCSV('assignment status.csv')"> <i class="fas fa-download"></i> Download Assignment List</button> -->
    </div>

    </div>
<?php } else { ?>
    <div style="height:100vh">
        <h4 style="color:red" class="ml-4 mt-4 text-center">You haven't submitted any assignment !</h4>
        <p class="text-center"><a href="<?= base_url('student_section.php'); ?>"> <i class="fas fa-eye"></i> See Assignment</a></p>
    </div>
<?php } ?>


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