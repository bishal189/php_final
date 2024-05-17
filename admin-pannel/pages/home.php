<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
     echo "<script> window.location.href='" . base_url() . "'</script>";
}

$total_subjects = $obj->query("SELECT count(sub_id) as subject FROM addsubject");
$total_semesters = $obj->query("SELECT count(id) as semester FROM semesters");

$sub = $total_subjects[0]->subject;
$sem = $total_semesters[0]->semester;


$total_teachers = $obj->query("SELECT count(tid) as teacher FROM tbl_teacher where status = 1");
$tt = $total_teachers[0]->teacher;

$total_students = $obj->query("SELECT count(sid) as student FROM tbl_student");
$ts = $total_students[0]->student;

$created_assignment  = $obj->query("SELECT count(id) as tot_creat_assi from tbl_create_assignment");
$t_cr_assi = $created_assignment[0]->tot_creat_assi;

$submitted_assignment  = $obj->query("SELECT count(id) as tot_su_assi from tbl_submit_assignment");
$t_su_assi = $submitted_assignment[0]->tot_su_assi;
?>

<style>
     .hovertest:hover {
          background: #fff !important;

     }
</style>

<h3 class="pt-4  font-weight-bold"> &nbsp;&nbsp;Welcome To Dashboard&nbsp;&nbsp;</h3>
<hr>

<div class="container" style="min-height: 70vh;">
     <div class="row">
          <div class="col-sm-3">
               <div class="row mb-3">
                    <div class="col-md-12 shadow hovertest pt-4 pb-4" style="background: #f9f9f9;">
                         <a href="<?= base_url('subject.php'); ?>" class="text-dark" style="text-decoration: none;">

                              <h4 class="text-dark text-center"><i class="fas fa-book fa-2x text-info"></i><br><br>Total Subjects </h4>
                              <h3 class="text-center pt-2"><?= $total_subjects[0]->subject; ?></h3>
                         </a>
                    </div>
               </div>

               <div class="row mb-3">
                    <div class="col-md-12 shadow hovertest pt-4 pb-4" style="background: #f9f9f9;">
                         <a href="<?= base_url('add_teacher.php'); ?>" class="text-dark" style="text-decoration: none;">
                              <h4 class="text-dark text-center"><i class="fad fa-chalkboard-teacher fa-2x text-secondary"></i><br><br> Total Teachers </h4>
                              <h3 class="text-center pt-2"><a href="<?= base_url('add_teacher.php'); ?>" class="text-dark" style="text-decoration: none;"><?= $total_teachers[0]->teacher; ?></h3>
                         </a>
                    </div>
               </div>


               <div class="row mb-3">
                    <div class="col-md-12 shadow hovertest pt-4 pb-4" style="background: #f9f9f9;">
                         <a href="<?= base_url('add_student.php'); ?>" class="text-dark" style="text-decoration: none;">
                              <h4 class="text-dark text-center"><i class="fad fa-users-class fa-2x text-success"></i><br><br>Total Students</h4>
                              <h3 class="text-center pt-2"><?= $total_students[0]->student; ?></h3>
                         </a>
                    </div>
               </div>
          </div>

          <div class="col-sm-9">
               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
               <div class="card card-body bg-light">
                    <div id="chart_div" style="height:70vh"></div>
               </div>
          </div>
     </div>
</div>



<script>
     google.charts.load('current', {
          packages: ['corechart', 'bar']
     });
     google.charts.setOnLoadCallback(drawRightY);

     function drawRightY() {
          var data = google.visualization.arrayToDataTable([
               ['', '', ''],
               ['Total Semesters, Total Subjects', <?= $sem ?>, <?= $sub ?>],
               ['Total Teachers, Created Assingments', <?= $tt ?>, <?= $t_cr_assi ?>],
               ['Total Students, Submitted Assingments', <?= $ts ?>, <?= $t_su_assi ?>],

          ]);

          var materialOptions = {
               chart: {
                    title: 'Subjects, Teachers and Students Data',
                    subtitle: 'Based on most recent data'
               },
               hAxis: {
                    title: 'Total Data',
                    minValue: 0,
               },
               vAxis: {
                    title: 'City'
               },
               bars: 'vertical',
               axes: {
                    y: {
                         0: {
                              side: 'left'
                         }
                    }
               }
          };
          var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
          materialChart.draw(data, materialOptions);
     }
</script>