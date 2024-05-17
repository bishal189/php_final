<?php
require_once("config/config.php");
require_once("config/db.php");
require_once root('layouts/header.php');

if (!empty($_POST) && $_POST['submit'] == 'submit') {

  $username = $_POST['username'];
  // $password=md5($_POST['password']);
  $password = $_POST['password'];

  $user_select = $obj->Query("SELECT * FROM tbl_admin WHERE email='$username' and password='$password'");

  if ($user_select) {
    $user_select = $user_select[0];
    session_start();

    $_SESSION['admin-status'] = "loggedin";
    $_SESSION['mainuser'] = $user_select->username;
    $_SESSION['admin-login'] = 'true';
    echo "<script>window.location.href='" . base_url() . "'</script>";
  } else {
    $_SESSION['error'] = "Invalid username or password!";
  }
}

$a = "Digital Assignment";


?>

<div style="height:10vh"></div>

<div class="container mt-2 bg-snow rounded" style="margin-top: 40px!important;font-family: roboto, sans-serif!important;">
  <div class="row justify-content-center">
    <div class="col-md-5 shadow-lg p-4 bg-white">
      <h4 class="pt-2"> <a href="<?= exit_url(); ?>" class="text-info"> <?= $a ?> </a> &#124; Admin Login </h4>
      <hr>

      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-primary my-2">
          <?php echo $_SESSION['error'];
          unset($_SESSION['error']);  ?>
        </div>
      <?php }  ?>
      <form class="form-group" method="post">
        <div class="form-group mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required placeholder="Enter your email">
        </div>

        <div class="form-group mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required id="Visible" placeholder="Enter your password">
        </div>

        <button class="btn btn-info btn-block mt-4" type="submit" name="submit" value="submit">Login </button><br>

      </form>
    </div>

  </div>
</div>