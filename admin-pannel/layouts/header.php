<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title> Admin Pannel</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <!-- Font CSS-->
    <link href="<?=base_url('layouts/css/font-face.css" rel="stylesheet')?>" media="all">
  
    <link href="<?=base_url('layouts/vendor/font-awesome-5/css/fontawesome-all.min.css')?>" rel="stylesheet"
        media="all">

           <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link href="<?=base_url('layouts/vendor/mdi-font/css/material-design-iconic-font.min.css')?>" rel="stylesheet"
        media="all">



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('layouts/css/bootstrap.min.css')?>">


    <!-- custom styles -->
    <link href="<?=base_url('layouts/css/theme.css')?>" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="<?=base_url('layouts/css/style.css')?>">
</head>

<body class="">
    <?php if(isset($_SESSION['admin-status'])=='loggedin') { ?>

    <div class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo-img" href="<?=base_url();?> ">
                        <!-- <img src="images/logo.jpg" alt="SAMS" /> -->
                        <a href="<?=exit_url() ;?>" class="">
                            <h3 class="mobile-logo-text">Digital Assignment</h3>
                        </a>
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                    </li>
                    


                    <li class="has-sub">
                        <a class="js-arrow" href="<?=base_url('subject.php');?>">
                            <i class="fas fa-users"></i>Manage Subjects</a>
                        
                    </li>

                    <li class="has-sub">
                        <a class="js-arrow" href="<?=base_url('add_teacher.php');?>">
                            <i class="fas fa-users"></i>Manage Teachers</a>
                        
                    </li>




                    <li class="has-sub">
                        <a class="js-arrow" href="add_student.php">
                            <i class="fas fa-users"></i>Manage Student</a>
                        
                    </li>
                    <li>
                        <a href="<?=base_url('logout.php');?> ">
                            <i class="fas fa-sign-out-alt"></i>Logout</a>

                    </li>


                </ul>
            </div>
        </nav>
    </div>

<?php } ?>