<?php
if (!isset($_SESSION['isStudent']) && $_SESSION['isStudent'] != 'true') {;
    header('location:student_login.php');
}
// print_r($_SESSION);
?>
<?php include('studentheader.php'); ?>

<div style="height:10vh"></div>


<style>
    .navbar {
        display: none;

    }

    .boxstyle {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;

    }

    .boxstyle a {
        color: #444 !important;

    }

    .boxstyle a:hover {
        color: blue;
    }
</style>


<div class="container" style="min-height:105vh;">

    <div class="row justify-content-center text-center">
        <div class="col-md-4 boxstyle pt-4 pb-4">
            <i class="fas fa-eye fa-2x text-dark"></i>
            <h5 class="text-dark text-center"><a href="student_section.php"><br>
                    View Assignment</a></h5>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-4 boxstyle pt-4 pb-4">
            <i class="fas fa-badge-check fa-2x text-dark"></i>
            <h5 class="text-dark text-center"><a href="view_assignment_status.php"><br>
                    My Assignments</a></h5>
        </div>
    </div>
</div>
</div>