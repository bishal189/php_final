<?php  

// if (!isset($_SESSION['assignment-status']) || $_SESSION['assignment-status']!='loggedin') {
// } 

if(!isset($_SESSION['isStudent'] ) && $_SESSION['isStudent']!='true'){
    header('location:student_login.php');

}

// print_r($_SESSION);

if (isset($_GET['action']) && $_GET['action']=='e') {
    $edit = $obj->Select("tbl_submit_assignment","*","id",array($_GET['id']));
    
    if(!$edit){
         echo '<script>alert("Succesfully edited!")</script>';
        echo "<script> window.location.href='".base_url('view_assignment_status.php')."'</script>";
    
    }
    
}
if (isset($_GET['action'])) {
 if ($_GET['action']=='d') {
        $obj->Delete("tbl_submit_assignment","id",array($_GET['id']));
           echo '<script>alert("Succesfully deleted!")</script>';
        
        echo "<script> window.location.href='".base_url('view_assignment_status.php')."'</script>";
}
}   



if (isset($_POST['submit'])) {
        if ($_POST['submit']=='add') {
           
            $imgName = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                    $location='submit_assignment'.'/'.$imgName;
                    move_uploaded_file($tmp_name, $location);//upload file
                    array_pop($_POST);//popping submit form post
                    $_POST['file'] = $imgName;
                                      
                    $obj->update("tbl_submit_assignment",$_POST);//insert query
                $_SESSION['create']="Assignment edited successfully !";

            
        }
    }



?>
<?php include('studentheader.php') ?>

    <div class="container" style="min-height:90vh;margin-top: 10px;">
        <?php if (isset($_SESSION['create'])) { ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['create'];unset($_SESSION['create']);  ?>
    </div>
    <?php }  ?>

        <div class="row justify-content-center">

            <div class="col-md-6 shadow p-3"  style="min-height:50vh;">
                 <h4 class="pt-4 pb-4"><i class="fas fa-edit"></i> Edit my Assignment </h4>
                <form action="" method="post">
                 <div class="form-group">

            <label>Choose a new File</label>
            <input type="file" name="image" class="form-control"  value="<?=$edit[0]['file'] ; ?>" required>
        </div>
        <button class="btn btn-success" name="submit" value="submit">Update</button>
        </form>
    </div>
</div>
</div>