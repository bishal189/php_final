<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $obj->Delete("addsubject", "sub_id", array($_GET['id']));

        echo "<script> window.location.href='" . base_url('subject.php') . "'</script>";
    }
}
// print_r($_SESSION);
if (isset($_POST['submit'])) {
    $old = $_POST;
    $sem = $_POST['semester'];
    $sub = $_POST['subjectname'];
    $sub_name = $obj->Query("SELECT * from addsubject where semester = '$sem' and subjectname = '$sub'");
    $sub_code = $obj->Select("addsubject", "*", "subjectcode", array($_POST['subjectcode']));

    // print_r($users);

    if ($sub_name) {
        $_SESSION['nameError'] = "Subject is already added!";
    } elseif ($sub_code) {
        $_SESSION['codeError'] = "Subject Code is already used by another subejct!";
    } else {

        if ($_POST['submit'] == 'add') {
            array_pop($_POST);

            $obj->Insert("addsubject", $_POST);
            echo '<script>alert("Subject added successfully")</script>';

            echo "<script> window.location.href='" . base_url('subject.php') . "'</script>";
        }
    }
}


$subjects = $obj->select('addsubject');
$semester = $obj->Query("SELECT * from semesters order by name asc");

?>
<style>
    .hidden {
        display: none;
    }
</style>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-3 shadow-sm pt-3">
            <button class="btn btn-info btn-block font-weight-bold" onclick="showFunction()"><i class="fa fa-plus"></i> &nbsp;Add new subject</button>
            <div class="hiddenn" id="msg">
                <form action="" method="post" class="form-group" id="errSub">
                    <br>

                    <div class="form-group">
                        <label for="Semester" id="Semester">Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="" disabled selected>Choose a semester</option>
                            <?php foreach ($semester as $key => $value) : ?>
                                <option value="<?= $value->id ?>"><?= $value->name ?> sem</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group" id="errSub">

                        <label>Subject Name</label>
                        <input type="text" name="subjectname" class="form-control" required value="<?php if (isset($old)) {
                                                                                                        echo $old['subjectname'];
                                                                                                    } ?>">
                        <?php if (isset($_SESSION['nameError'])) { ?>
                            <a style="color: red;" class="d-block my-2">
                                <?php

                                echo $_SESSION['nameError'];
                                unset($_SESSION['nameError']);
                                ?>
                            <?php } ?></a>
                            <label>Subject Code</label>
                            <input type="text" name="subjectcode" class="form-control" required value="<?php if (isset($old)) {
                                                                                                            echo $old['subjectcode'];
                                                                                                        } ?>">

                            <a style="color: red;">
                                <?php if (isset($_SESSION['codeError'])) {
                                    echo $_SESSION['codeError'];
                                    unset($_SESSION['codeError']);
                                } ?></a>



                    </div>

                    <button class="btn btn-success btn-block" name="submit" value="add">Add</button>
                </form>
            </div>
        </div>
        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-8 columnhead pt-3">
            <h5 class="font-weight-bold pb-3 text-left" style="margin-left: 14px;">Subject (Semester-wise)</h3>
                <ul class="list-unstyled sem-nav d-flex">
                    <?php $semCounter = sizeof($semester);
                    $semIdx = 0;
                    ?>

                    <li><a class="btn btn-light" href="<?= base_url('subject.php') ?>">
                            All</a>
                    </li>

                    <?php foreach ($semester as $key => $value) : ?>

                        <li class="mx-2"> <button class="btn btn-light active " onClick="semFunction('<?= $value->id; ?>','<?= $semIdx; ?>')">
                                <?= $value->name; ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <span class="float-right text-light pb-4 position-absolute" style="top:10px;right:18px"> <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search subjects..">
                </span>
                <br>
                <div class="card-header card-body bg-info">
                    <h4 class="font-weight-bold text-white">
                        All Subjects
                    </h4>
                </div>
                <?php if ($subjects) { ?>

                    <table class="table table-hover table-responsive-lite" id="subjectSem_wise">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Semester</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th colspan="3">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php
                                        $a = $obj->Select('semesters', '*', 'id', array($value['semester']));
                                        $b =  $a[0]['name'];
                                        ?>
                                        <?= $b; ?></td>
                                    <td><?= $value['subjectname']; ?></td>
                                    <td><?= $value['subjectcode']; ?></td>
                                    <td><a href="<?= base_url('subject.php?action=d&id=' . $value['sub_id']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php } else { ?>
                    <p class="text-primary p-3">No Subject has been added yet !</p>

                <?php } ?>
        </div>

    </div>
</div>

<script>
    function showFunction() {
        var div = document.getElementById("msg");
        div.classList.toggle('hidden');
    }
</script>
<script>
    function semFunction(data, i) {
        let counter = "<?= $semCounter; ?>";
        $.ajax({
            type: "POST",
            url: 'filtered-subject.php',
            data: {
                tag: data

            },
            success: function(e) {
                $('#subjectSem_wise').html(e);

            }
        })
    }
</script>