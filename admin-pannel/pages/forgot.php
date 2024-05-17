<?php 


if (isset($_POST['regd_btn'])) {
  $email=$_POST['email'];
  $user_type=$_POST['user_type'];
  if($user_type=='teacher'){
  $query="SELECT * FROM teacher WHERE email='$email'";

  $emailquery=mysqli_query($conn,$query);
  $emailcount=mysqli_num_rows($emailquery);
    if($emailcount){
      $userdata=mysqli_fetch_array($emailquery);
      $fname=$userdata['First_Name'];
      $lname=$userdata['Last_Name'];
      $tid=$userdata['tid'];
      $subject="Reset Password";
      $body="Hi, $fname $lname.Click here to reset your AMS password
      http://localhost/ams/reset_password.php?email=$email&user_type=$user_type&uid=$tid&fname=$fname&lname=$lname
      ";
      $sender_email="From:Admin";
      if(mail($email, $subject, $body, $sender_email)){
        echo'<script>
          alert("Email sent successfully. Check your email for recovery link.");
          window.location="http://localhost/ams/";
        </script>';
      }else{
        echo"Email sending failed!";
      }
    }
  }
  else if($user_type=='student'){
  $query="SELECT * FROM student WHERE email='$email'";
  $emailquery=mysqli_query($conn,$query);
  $emailcount=mysqli_num_rows($emailquery);
    if($emailcount){
      $userdata=mysqli_fetch_array($emailquery);
      $fname=$userdata['First_Name'];
      $lname=$userdata['Last_Name'];
      $sid=$userdata['sid'];
      $subject="Reset Password";
      $body="Hi, $fname $lname.Click here to reset your AMS password
      http://localhost/ams/reset_password.php?email=$email&user_type=$user_type&uid=$sid&fname=$fname&lname=$lname
      ";
      $sender_email="From:Admin";
      if(mail($email, $subject, $body, $sender_email)){
        echo'<script>
          alert("Email sent successfully. Check your email for recovery link.");
          window.location="http://localhost/ams/";
        </script>';
      }else{
        echo"Email sending failed!";
      }
    }
  }
}
 ?>

    <div id="container">
      <p>Reset password through email verification</p>
      <form action="" method="post">
        <select name="user_type" class="input_data" required>
          <option value="" disabled selected>Choose Account Type</option>
          <option value="teacher">Teacher</option>
          <option value="student">Student</option>
        </select>
        <input type="email" name="email" placeholder="Your registered email" class="email" required>
        <input type="submit"name="regd_btn" class="button" value="Send Link">
      </form>
    </div>
 
