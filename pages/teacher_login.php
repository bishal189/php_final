<?php
if (isset($_SESSION['isTeacher'])) {
    echo "<script> window.location.href='" . base_url('teacher_section.php') . "'</script>";
}

if (isset($_POST['submit']) && $_POST['submit'] == 'login') {
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $statusCheck = $obj->select('tbl_teacher', '*', 'temail', array($username));

    if ($statusCheck) {
        $status = $statusCheck[0]['status'];
    }

    $check = $obj->Query("SELECT * FROM tbl_teacher_login WHERE email = '$username' and password = '$pass'");
    if ($check && $status == 1) {
        if ($check) {
            $_SESSION['teacher_id'] = $check[0]->teacher;
            $_SESSION['assignment-status'] = 'loggedin';
            $_SESSION['isTeacher'] = "true";
            $_SESSION['posted_by'] = $check[0]->username;
            $_SESSION['tid'] = $check[0]->tid;
            $_SESSION['teacher'] = $check[0]->teacher;
            $_SESSION['tavatar'] = $check[0]->avatar;
            echo "<script> window.location.href='" . base_url('teacher_section.php') . "'</script>";
        }
    } else {
        $_SESSION['error'] = "Invalid username or password!";
    }
}

?>
<style>
    label {
        font-family: roboto, sans-serif;
    }
</style>

<div class="container mt-2 bg-snow rounded" style="margin-top: 40px!important;font-family: roboto, sans-serif;">

    <div class="row justify-content-center">
        <div class="col-md-6 shadow-lg p-4 bg-white">

            <h5 class="pt-2"> <a href="<?= base_url(); ?>"> Digital Assignment </a> &#124; Teacher Login </h5>
            <hr>
            <form class="form-group" method="post">
                <div class="form-group mb-2">

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class=" my-2 alert alert-danger">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']);  ?>
                        </div>
                    <?php }  ?>

                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required id="Visible">
                </div>

                <label class="text-muted mt-2">
                    <input type="checkbox" onclick="showMe();" style="padding:40px 60px;"> &nbsp;Show Password
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
    .navbar {
        display: none;
    }

    /* For Modal login form */

    /* The Modal (background) */
    .modal {
        /*background-color: red;*/
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
    $checkEmailExists = $obj->Select("tbl_teacher_login", "*", "email", array($_POST['email']));

    if ($checkEmailExists) {
        echo "<script>alert('Error !  Email aready exists');</script>";
    } else {
        $checkTeacher = $obj->Select("tbl_teacher", "*", "temail", array($_POST['email']));
        if ($checkTeacher) {
            $username = $checkTeacher[0]['tname'];
            $teacher = $checkTeacher[0]['tid'];
            $checked_teacher_email =  $checkTeacher[0]['temail'];
            if ($checked_teacher_email === $email) {

                $imgName = $_FILES['avatar']['name'];
                $tmp_name = $_FILES['avatar']['tmp_name'];
                $location = 'images' . '/' . $imgName;
                move_uploaded_file($tmp_name, $location); //upload file
                unset($_POST['submit']);
                $_POST['avatar'] = $imgName;

                $_POST['username'] = $username;
                $_POST['teacher'] = $teacher;
                $_POST['password'] = md5($_POST['password']);
                $obj->insert("tbl_teacher_login", $_POST);
                echo "<script>alert('Account created successfully.');</script>";
            }
        } else {
            echo "<script>alert('Wrong email ! Please enter your valid email to create your account');</script>";
        }
    }
}

// if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
//     unset($_POST['submit']);
//     $email = $_POST['email'];
//     if (isset($_POST['teacher']) && $_POST['teacher'] != '') {
//         $username = $obj->select("tbl_teacher", "*", "tid", array($_POST['teacher']));
//         $_POST['username'] = $username[0]['tname'];
//     }
//     $_POST['password'] = md5($_POST['password']);
//     $obj->insert("tbl_teacher_login", $_POST);
//     echo '<script>alert("Account created successfully")</script>';
// }
?>
<?php
$connection = mysqli_connect("localhost", "root", "", "digital_assignment");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div id="id02" class="modal d-blocddk" style="z-index:2;">
            <div class="col-md-4 modal-content animate p-4" style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;background: #fff!important;">
                <h3 class="pb-4 pt-2" style="font-family:roboto, sans-serif;">Sign Up
                    <span class="ml-4 float-right" style="cursor: pointer;" onclick="document.getElementById('id02').style.display='none'"><i class="fa     fa-close"></i></span>
                </h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Enter your email</label>
                        <input type="email" name="email" class="form-control " required="required">
                    </div>

                    <div class="form-group">
                        <label>Choose your profile image</label>
                        <input type="file" name="avatar" class="form-control " required="required">
                    </div>


                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control " required="required">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        <input type="reset" class="btn btn-primary ml-2" value="Reset"><br>

                    </div>
                    <hr>
                </form>
            </div>

            <!-- Uncomment it to show footer------->
            <!-- </div></div></div> -->
            <!-- Uncomment it to show footer------->


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