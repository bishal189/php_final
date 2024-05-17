<?php
    // include("config/config.php");
    //  include("config/db.php");
      if(isset($_POST['search'])){
        $searchkey=$_POST['search'];
        $sql="SELECT * FROM tbl_student WHERE sname LIKE'%$searchkey%'";
      }else{
        $sql="SELECT * FROM tbl_student";
        $searchkey="";
      }


      $connection=mysqli_connect("localhost","root","","new_ams");
      $result=mysqli_query($connection,$sql);

  ?>
  
  <div class="row">
    <div class="container">
      <div class="col-sm-6">

       <table>
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roll Number</th>
        <th>Address</th>
        <th>Status</th>
        <th>Phone No</th>

      </thead>
      <!-- php code to display sql table  -->
      <?php
        while($row =mysqli_fetch_assoc($result)){
          $sid=$row["sid"];
          $sname=$row["sname"];
          $email=$row["email"];
          $roll_no=$row["roll_no"];
          $address=$row["saddress"];
          $status=$row["status"];
          $phone=$row["sphone"];
          ?>
          <tr>

          <td><?php echo $sid; ?></td>
          <td><?php echo $sname; ?></td>
          <td><?php echo $email; ?></td>
          <td><?php echo $roll_no; ?></td>
          <td><?php echo $address; ?></td>
          <td><?php echo $status; ?></td>
          <td><?php echo $phone; ?></td>
          </tr>
        <?php
       }
      ?>
    </table>

       </div>

    </div>
  </div>
 
   