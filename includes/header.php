<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Digital Assignment</title>

    <!----------------Bootstrap v5 css------------------------------------------------>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!----------------Bootstrap v5 css end  ------------------------------------------------>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="lib/animate/animate.min.css" rel="stylesheet">


    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="css/style.css">

    <style>
  .intro{
      animation-duration: 2s;
    }
    .login button{
      font-family: nunito;
    }

    </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg sticky-top bg-white navbar-light shadow-sm navbar-home" style="border-bottom: 0px solid #e7e7e7;">
  <a class="navbar-brand" href="<?=base_url();?>" style="margin-left:30px;margin-top: 0.1"> &nbsp;Digital <i class="fas fa-book-reader"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url();?>">
          <i class="fas fa-home"></i><span class="sr-only">(current) </span> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="about.php">About</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Why us?</a>
      </li> -->
    </ul>
    <ul class="navbar-nav ml-4 login">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#exampleModal">
&nbsp; Login / Signup &nbsp;
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="margin-left: 69px!important;" >Login as</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true" style="font-size: 2.5rem!important">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-top:-30px!important;margin-left:60px!important ;">
        <h4> <a class="btn btn-primary p-2 font-weight-bold text-white" href="<?=base_url('teacher_login.php');?>">Teacher</a></h4>

        <h4>  <a class="btn btn-primary p-2 font-weight-bold text-white" href="<?=base_url('student_login.php');?>">Student</a></h4>

        <h4><a class="btn btn-primary p-2 font-weight-bold text-white" href="<?=base_url('admin-pannel');?>">Admin</a></h4>

        </div>
    </div>
  </div>
</div>
    </ul>
  </div>
  
</nav>
 <style>
        .modal-header{
          border-bottom: none!important;
        }
        .modal-body h4{
          padding: 10px;
          display: inline-flex!important;
        }
        .modal-body a{
          color: #fff!important;
        }
        .modal-content{
          background: #f5f5f5!important;
        }
      </style>