<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status']!='loggedin') {
	echo "<script> window.location.href='".base_url()."'</script>";
}
if (isset($_POST['submit'])) {
	if ($_POST['submit']=='add') {
		array_pop($_POST);
		if($_POST['username'] != $_SESSION['whois']){
			$_SESSION['whois'] = $_POST['username'];
		}
		// $pass=md5($_POST['plane_password']);
		// $_POST['password'] = $pass;
		// print_r($_POST);

		$obj->Update("backend",$_POST,"id",array($_GET['id']));
		echo "<script> window.location.href='".base_url('admin-control.php')."'</script>";
	}
}

if (isset($_GET['action']) && $_GET['action']=='e') {
	$edit = $obj->Select("backend","*","id",array($_GET['id']));
	
}


?>

<h2>Edit Admin</h2>
<div class="col-md-6">
    <form action="" method="post" class="form-group">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required value="<?=$edit[0]['username']?>">
        </div>
        <!-- <div class="form-group">
            <label>Password</label>
            <input type="text" name="plane_password" required class="form-control"
                value="<?=$edit[0]['plane_password']?>">
        </div> -->
        <button class="btn btn-success" name="submit" value="add">Update</button>
    </form>
</div>