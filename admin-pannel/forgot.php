<?php 
 require_once ("config/config.php");
require_once root('layouts/header.php');

$servername = "localhost";
$username = "root";
$password = "";
$db = "new_ams";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
if (isset($_POST['submit'])) {

  $email=$_POST['email'];
  $query="SELECT * FROM tbl_admin WHERE email='$email'";

  $emailquery=mysqli_query($conn,$query);
  $emailcount=mysqli_num_rows($emailquery);

  if($emailcount){
      $userdata=mysqli_fetch_array($emailquery);
      $username=$userdata['username'];
      $aid=$userdata['aid'];
      $subject="Reset Password";
      $body="Hi, $username.Click here to reset your AMS password
      http://localhost/new_ams/admin-pannel/forgot.php?email=$email&username=$username;
      ";
      $sender_email="From:Admin";
      if(mail($email, $subject, $body, $sender_email)){
        echo'<script>
          alert("Email sent successfully. Check your email for recovery link.");
          window.location="http://localhost/new_ams/";
        </script>';
      }else{
        echo"Email sending failed!";
      }
    }
  }

 ?>
 <div style="height:30vh;"></div>
    <div id="container">
       <p class="text-center">Reset password through email verification</p>
        <hr>
      <div class="row justify-content-center">
          <div class="col-md-6 shadow pt-4">
            <form action="" method="post" class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Your registered email" class="email" required>
          
          <br>
          <button class="btn btn-success rounded-pill" name="submit"> &nbsp;&nbsp; Send Link &nbsp;&nbsp;</button>
          <!-- <input type="submit"name="submit" class="button" value="Send Link"> -->
      </form>
    </div>
  </div>
</div>
 
