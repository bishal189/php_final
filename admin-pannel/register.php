<?php 
require_once ("config/config.php");
require_once ("config/db.php");

if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
    unset($_POST['submit']);
    $_POST['password'] = md5($_POST['password']);
    $obj->insert("tbl_admin",$_POST);
}
 
    // $pagePath=root('pages/'.$url);
require_once root('layouts/header.php');
?>

<style>
    .body{
    font: 14px sans-serif;
    }

    .wrapper {
     width: 350px;
    padding: 20px;
    }
</style>

   
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control " value="" required="required">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control " value="" required="required">
                <input type="checkbox" onclick="showMe();" style="margin:5px;">Show Password <br>
                <span class="invalid-feedback"></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset"><br>
                  <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
<?php 
require_once root('layouts/footer.php');
?>

