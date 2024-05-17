  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

      <style>
        .img1,
        .img2,
        .img3 {
          display: block;
          width: 100vw;
          height:100vh;
          background-size: cover;
          background-position: center center;
          background-repeat: no-repeat;
          background-attachment: scroll;
        }

        .img1 {
          background-image: url('images/admin.jpg');
        }

        .img2 {
          background-image: url('images/teacher.jpg');
        }

        .img3 {
          background-image: url('images/student.jpg');
        }
      </style>
      <div class="carousel-item active" style="height:80vh!important">
        <div class="img1"></div>
        <div class="carousel-caption d-none d-md-block">
          <h5>Admin</h5>
          <p style="margin-bottom:10px">Admin adds subjects, teachers, Students and also assigns subject to Teacher. </p>
        </div>
      </div>

      <div class="carousel-item" style="height:80vh!important">
        <div class="img2"></div>
        <div class="carousel-caption d-none d-md-block">
          <h5>Teacher</h5>
          <p style="margin-bottom:10px">
            Teacher creates the assignment and views the assignment and also provides feedback to the students.
          </p>
        </div>
      </div>

      <div class="carousel-item" style="height:80vh!important">
        <div class="img3"></div>
        <div class="carousel-caption d-none d-md-block">
          <h5>Student</h5>
          <p style="margin-bottom:10px">
            Student views the assignment and submit the assignment.
          </p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>