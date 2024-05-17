<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $obj->Delete("semesters", "id", array($_GET['id']));

        echo "<script> window.location.href='" . base_url('add_semester.php') . "'</script>";
    } elseif ($_GET['action'] == 'inactive') {
        $status['status'] = 0;
        $obj->Update("semesters", $status, "id", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_semester.php') . "'</script>";
    } elseif ($_GET['action'] == 'active') {
        $status['status'] = 1;
        $obj->Update("semesters", $status, "id", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('add_semester.php') . "'</script>";
    }
}
// print_r($_SESSION);
if (isset($_POST['submit'])) {
    $old = $_POST;
    $sem_check = $obj->Select("semesters", "*", "name", array($_POST['name']));
    // print_r($users);

    if ($sem_check) {
        $_SESSION['nameError'] = "Semester is already added!";
    } else {

        if ($_POST['submit'] == 'add') {
            array_pop($_POST);

            $obj->Insert("semesters", $_POST);
            $_SESSION['message'] = "New semester added successfully!";
        }
    }
}
$semester = $obj->select('semesters');

?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3 shadow-sm p-3">
            <button class="btn btn-info" onclick="showFunction()"><i class="fa fa-plus"></i> &nbsp;Add new Semester</button>
            <style>
                .hidden {
                    display: none;
                }
            </style>

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-info mt-3">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']); ?>
                </div>
            <?php } ?>


            <div class="hiddenn" id="msg">
                <form action="" method="post" class="form-group"><br>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="name" class="form-control">
                            <option value="" disabled selected>Choose a semester</option>

                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="1st">First (I)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="2nd">Second (II)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="3rd">Third (III)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="4th">Fourth (IV)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="5th">Fifth (V)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="6th">Sixth (VI)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="7th">Seventh (VII)</option>
                            <option <?php if (isset($old)) { ?> <?php echo $old['name'];
                                                            } ?> value="8th">Eighth (VIII)</option>

                        </select>
                        <a style="color: red;">
                            <?php if (isset($_SESSION['nameError'])) {
                                echo $_SESSION['nameError'];
                                unset($_SESSION['nameError']);
                            } ?></a>
                    </div>


                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>
                    </div>


                    <button class="btn btn-success" name="submit" value="add">Add</button>

                </form>
            </div>
        </div>
        <div class="col-md-8 shadow pt-3 columnhead ml-3" style="min-height:85vh;">


            <?php if ($semester) { ?>

                <div class="col-md-12">
                    <h4 class=" font-weight-bold pb-3 text-left" style="font-size:1.3rem;">Semesters</h4>
                    <table class="table table-hover table-responsive-lite">
                        <thead>
                            <tr style="background: #f9f9f9;">
                                <th>SN</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($semester as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['name']; ?></td>
                                    <td><?php
                                        if ($value['status'] == 1) { ?>
                                            <a href="add_semester.php?action=inactive&id=<?= $value['id']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                                        <?php  } elseif ($value['status'] == 0) { ?>
                                            <a href="add_semester.php?action=active&id=<?= $value['id']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>

                                        <?php   }

                                        ?>
                                    </td>


                                    <td><a href="<?= base_url('edit_semester.php?action=e&id=' . $value['id']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit this?')"><i class="far fa-edit"></i></a>
                                    </td>


                                    <td><a href="<?= base_url('add_semester.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <p class="p-3 text-primary">No semesters added yet!</p>

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