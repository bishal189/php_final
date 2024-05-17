<nav class="navbar navbar-expand-lg navbar-light bg-danger sticky-top">
  <a class="navbar-brand font-weight-bold" href="<?=base_url();?>"><i class="fas fa-home"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="navbar-nav ml-auto">
       <button class="btn btn-light rounded-left text-danger font-weight-bold" onclick="document.getElementById('id01').style.display='block'">Login</button> 
    </ul>

  <div id="id01" class="modal">
    <div class="container modal-content animate">
      <div class="row">
        <div class="col-10">
           <h5 class="text-center animated fadeIn">Login as ?</h5> 

           <a class="text-secondary p-2 font-weight-bold" href="<?=base_url('teacher_login.php');?>">Teacher</a>
            <a class="text-secondary p-2 font-weight-bold" href="<?=base_url('student_login.php');?>">Student</a>
          <a class="text-secondary p-2 font-weight-bold" href="<?=base_url('admin-pannel');?>">Admin</a>
           <a class="text-danger font-weight-bold ml-4" style="font-size: 20px;"href="<?=base_url('logout.php');?>">Logout <i class="fa fa-sign-out"></i></a>
        </div>
        <div class="col-2">
          <button class="btn btn-danger ml-4" onclick="document.getElementById('id01').style.display='none'"><i class="fa fa-close"></i></button>
        </div>

      </div>
    </div>
</div>
</nav>