<?php 
require_once ("config/config.php");
require_once ("config/db.php");
$connection = mysqli_connect('localhost','root','','new_ams');

if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
    unset($_POST['submit']);
    $_POST['password'] = md5($_POST['password']);
    $obj->insert("tbl_teacher_login",$_POST);
}

?>
   <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="text-center">Sign Up</h2>
        <form class="form-group" method="post" style="margin:70px;">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control " value="" required="required">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control " value="" required="required">
                <span class="invalid-feedback"></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Back to <a href="teacher_login.php">Login</a>.</p>
        </form>
   </div>
    <div class="col-md-3"></div>
</div>
