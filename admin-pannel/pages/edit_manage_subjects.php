<?php

if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
	echo "<script> window.location.href='" . base_url() . "'</script>";
}
if (isset($_POST['submit'])) {
	if ($_POST['submit'] == 'add') {
		array_pop($_POST);
		$obj->Update("addsubject", $_POST, "sub_id", array($_GET['id']));
		echo '<script>alert("Data updated successfully")</script>';
		echo "<script> window.location.href='" . base_url('subject.php') . "'</script>";
	}
}


if (isset($_GET['action']) && $_GET['action'] == 'e') {
	$edit = $obj->Select("addsubject", "*", "sub_id", array($_GET['id']));
	// print_r($edit);

	if (!$edit) {
		echo "<script> window.location.href='" . base_url('subject.php') . "'</script>";
	}
}

$semester = $obj->select('semesters', '*', '', array(), ' Order by name asc');

?>


<div class="container pt-4">
	<h4 class="font-weight-bold text-secondary">Edit Subject </h4>
	<div class="row">
		<div class="col-md-6 bg-white my-3 p-4">
			<form action="" method="post" class="form-group">

				<div class="form-group">
					<label for="Semester" id="Semester">Semester</label>
					<?php $subject_e = $edit[0]['semester'];
					$sem_Query = $obj->Select("semesters", "*", "id", array($subject_e));
					$sem = $sem_Query[0]['name'];
					$sem_id = $sem_Query[0]['id'];

					?>
					<select name="semester" class="form-control">
						<option value="" disabled selected>Choose a semester</option>

						<?php foreach ($semester as $key => $value) : ?>
							<option value="<?= $value['id'] ?>" <?php if ($value['id'] == $subject_e) { ?> selected<?php } ?>><?= $value['name'] ?> sem</option>
						<?php endforeach ?>
					</select>
 
				</div>


				<div class="form-group">
					<label class="">Subject Name</label>
					<input type="text" name="subjectname" class="form-control" required value="<?= $edit[0]['subjectname']; ?>">
					<a style="color: red;">
						<?php if (isset($_SESSION['nameError'])) {
							echo $_SESSION['nameError'];
							unset($_SESSION['nameError']);
						} ?></a>
				</div>
				<div class="form-group">
					<label class="">Subject Code</label>
					<input type="text" name="subjectcode" class="form-control" required value="<?= $edit[0]['subjectcode']; ?>">

				</div>


				<button class="btn btn-success" name="submit" value="add">Update</button>
			</form>
		</div>
	</div>
</div>