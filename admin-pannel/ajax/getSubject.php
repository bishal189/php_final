<?php
require_once('../config/config.php');
require_once('../config/db.php');
$result = $obj->Select("addsubject", "*", "semester", array($_GET['sem']));


?>

<label>Select Subject</label>
<select class="form-control" name="sub" required>
    <option selected disabled value="">Choose a subject</option> <?php if ($result) { ?>
        <?php foreach ($result as $key => $value) { ?>
            <option value="<?=$value['sub_id']; ?>">
                <?=$value['subjectname']; ?> 
            </option>
        <?php  } ?>
    <?php  }  else { ?>
<option selected disabled style="color:red">No subjects found</option>
<?php } ?>
?>
</select>