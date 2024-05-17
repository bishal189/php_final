<?php
if (isset($_SESSION['isStudent'])) {
    echo "<script> window.location.href='" . base_url('student_sectionnew.php') . "'</script>";
}
if (isset($_POST['submit']) && $_POST['submit'] == 'login') {
    // echo "hii"; die;
    $username = $_POST['username'];
    $pass = md5($_POST['password']);

    $statusCheck = $obj->select('tbl_student', '*', 'email', array($username));

    $status = $statusCheck[0]['status'];

    $check = $obj->Query("SELECT * FROM tbl_student_login WHERE email = '$username' and password = '$pass' ");
    if ($check && $status == 1) {
        if ($check) {
            $_SESSION['student_id'] = $check[0]->student;
            $_SESSION['student-status'] = 'loggedin';
            $_SESSION['isStudent'] = "true";
            $_SESSION['submitted_by'] = $check[0]->username;
            $_SESSION['student'] = $check[0]->username;

            $loggedInStudent  =  $_SESSION['submitted_by'];
            $_SESSION['savatar'] = $check[0]->avatar;
            echo "<script> window.location.href='" . base_url('student_sectionnew.php') . "'</script>";
        }
    } else {
        if ($status == 0) {
            $_SESSION['error'] = "Your account is not activated.";
        } else {
            $_SESSION['error'] = "Invalid username or password!";
        }
    }
}

$a = "Digital Assignment";

?>

<style>
    .banner,
    .footer {
        display: none !important;
    }

    label,
    checkbox,
    h3 {
        /*font-size: 17px;*/
        /*font-weight: bold;*/
        font-family: roboto, sans-serif;
    }

    .navbar {
        display: none;
    }
</style>
<div class="container mt-2 bg-snow rounded" style="margin-top: 40px!important;font-family: roboto, sans-serif!important;">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow-lg p-4 bg-white">
            <h4 class="pt-2"> <a href="<?= base_url(); ?>"> <?= $a ?> </a> &#124; Student Login </h4>
            <hr>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="my-2 alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']);  ?>
                </div>
            <?php }  ?>
            <form class="form-group" method="post">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <label>Password</label>
                <input type="password" name="password" class="form-control" required id="Visible">


                <label class="text-secondary">
                    <input type="checkbox" onclick="showMe();" style="padding:40px 60px; margin-top:12px;">Show Password
                </label>
                <button class="btn btn-primary btn-block mt-2" type="submit" name="submit" value="login">Login </button><br>
                <span style="font-size:16px;" class="text-secondary">Not have an account?</span>
                <span class="btn btn-sm btn-success float-right" onclick="document.getElementById('id02').style.display='block'"> Sign up</span>
            </form>
        </div>

    </div>
</div>



<!-- Popup sign in form below>>-->

<style>
    /* For Modal login form */

    /* The Modal (background) */
    .modal {
        overflow: hidden;
        display: none;
        /* Hidden by default */
        /*padding-top: 30px;*/
    }

    /* Modal Content/Box */
    .modal-content {
        left: 25%;
        background-color: #fff;
        margin: 6% auto
            /* 5% from the top, 15% from the bottom and centered */
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }
</style>

<?php
require_once("config/config.php");
require_once("config/db.php");

if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
    unset($_POST['submit']);
    $email = $_POST['email'];

    $old = $_POST;
    $checkEmailExists = $obj->Select("tbl_student_login", "*", "email", array($_POST['email']));

    if ($checkEmailExists) {
        echo "<script>alert('Account already created.');</script>";
    } else {
        $checkStudent = $obj->Select("tbl_student", "*", "email", array($_POST['email']));
        if ($checkStudent) {
            $username = $checkStudent[0]['sname'];
            $student_id = $checkStudent[0]['sid'];
            $checked_student_email =  $checkStudent[0]['email'];
            if ($checked_student_email === $email) {

                $_POST['username'] = $username;
                $_POST['student'] = $student_id;
                $_POST['password'] = md5($_POST['password']);
                unset($_POST['submit']);

                $obj->insert("tbl_student_login", $_POST);
                echo "<script>alert('Account created successfully');</script>";
            }
        } else {
            echo "<script>alert('Wrong email ! Please enter your valid email to create your account');</script>";
        }
    }
}
?>

<?php
$connection = mysqli_connect("localhost", "root", "", "digital_assignment");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<style>
    button {
        font-family: 'verdana', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 1.625;
        color: #666;
        -webkit-font-smoothing: antialiased;
    }

    .sign {
        font-family: arial !important;
        font-size: 24px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div id="id02" class="modal">
            <div class="col-md-4 modal-content animate p-4" style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;background: #fff!important;">
                <h3 class="pb-4 pt-2">Sign Up
                    <span class="float-right" style="cursor: pointer;" onclick="document.getElementById('id02').style.display='none'"><i class="fas fa-close"></i></span>
                </h3>
                <form action="" method="post">

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control " value="" required="required" placeholder="Enter your email provided by your school">
                    </div>

                    <div class="form-group mb-3">
                        <label>Password</label>

                        <input type="password" name="password" class="form-control " value="" required="required" minlength="4" placeholder="Enter your password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        <input type="reset" class="btn btn-primary ml-2" value="Reset"><br>

                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    function showMe() {
        var x = document.getElementById('Visible');

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

    }
</script>