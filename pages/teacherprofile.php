<?php
if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
	header('location:teacher_login.php');
} ?>
<?php
include('teacherheader.php');
// if (isset($_SESSION['posted_by'])) {
// 	$teachers = $obj->select('tbl_teacher', '*', 'tid', array($_SESSION['teacher_id']));
// 	// print_r($teachers);
// }

$edit = $obj->Select("tbl_teacher_login", "*", "username", array($_SESSION['posted_by']));


// print_r($edit);

// $edit_id = $edit[0]['tid'];
// // die;


// $t_email = $edit[0]['email'];
// // print_r($t_email);
 

// $teacher_details = $obj->Select("tbl_teacher", "*", "temail", array($t_email));
// echo "<pre>";
// print_r($teacher_details);

// $temail = $teacher_details[0]['temail'];
// $tphone = $teacher_details[0]['tphone'];
// $taddress = $teacher_details[0]['taddress'];
// $tname = $teacher_details[0]['tname'];




// $teacher_table_query = $obj->select('tbl_teacher_login', '*', 'username', array($_SESSION['posted_by']));

// $teacher_table_email = $teacher_table_query[0]['email'];
// $teacher_table_username = $teacher_table_query[0]['username'];

// $teacher_table_teacher_name = $obj->Query("SELECT * from tbl_teacher where temail = '$teacher_table_email'");


if (isset($_POST['submit'])) {
	if ($_POST['submit'] == 'update') {
		// print_r($_POST);
		// die;
$tid=$_POST['tid'];
// print_r($tid);
// die;
		if ($_FILES['avatar']['name'] != '') {

		$imgName = $_FILES['avatar']['name'];
		$tmp_name = $_FILES['avatar']['tmp_name'];
		$location = 'images' . '/' . $imgName;
		move_uploaded_file($tmp_name, $location); //upload file
		$_POST['avatar'] = $imgName;
		// print_r($_POST['avatar']);
		$avatar['avatar'] = $_POST['avatar'];
		}
		unset($_POST['submit']);


		$update_query = $obj->update('tbl_teacher_login', $_POST,'tid',array($tid));

		// $update_details =  $obj->Query("UPDATE tbl_teacher_login SET username = '$tname_e',email = '$t_email_e' where email = $teacher_table_email");

		if ($update_query) {
			echo "<script>alert('Profile updated successfully');</script>";
			echo "<script> window.location.href='" . base_url('teacherprofile.php') . "'</script>";
		}
	}
}

//   print_r($_SESSION);



// if (!$edit) {
//     echo "<script> window.location.href='" . base_url('edit_student_profile.php') . "'</script>";
// }




?>




<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="shadow-p-4 mt-3">
				<h4 class="card-header">Change Profile</h4>
				<form action="" method="post" class="form-group card-body" enctype="multipart/form-data">
					<input type="hidden" name="tid" value="<?=$edit[0]['tid']?>">
					<div class="d-flex">
						<?php
						$username = $_SESSION['posted_by'];

						$image_query = $obj->Query("SELECT * from tbl_teacher_login where username =  '$username'");
						$user_avatar = $image_query[0]->avatar;
						?>
						<img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 105px;height: 105px;border-radius: 50%;">
						<div class="p-2">
							<div class="form-group">
								<input type="file" name="avatar">
							</div>


							<button class="btn btn-success" name="submit" value="update">Update</button>

						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
</div>
</div>


<style>
	label {
		font-weight: bold;
	}

	footer {
		display: none;
	}
</style>