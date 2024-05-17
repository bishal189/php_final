<?php include('studentheader.php') ?>


<?php

$s = $_SESSION['student'];

$a = $obj->Query("SELECT * FROM tbl_student where sname ='$s'");
$sem   = $a[0]->semester;
// print_r($sem);

$data = $obj->Query("SELECT * FROM tbl_create_assignment where semester ='$sem'  order by id desc");
// print_r($data);


?>
<style>
  .navbar {
    position: relative !important;
  }

  tr th {
    color: #fff !important;
    /*font-weight:500;*/
    /* font-family: nunito, sans-serif; */
  }

  #style th {
    padding: 8px;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    color: #fff !important;
    font-family: nunito;

  }

  #style td {
    font-family: nunito, sans-serif;
  }

  #style tr:hover {
    background: #f1f1f1 !important;
  }

  .titlehead {
    color: #aa6708;
    border: 1px solid #e7e7e7;
    border-left: 4px solid #aa6708;
    border-radius: 4px;
    padding: 16px;
    padding-left: 10px;
    margin-bottom: 1rem;
    font-family: poppins, sans-serif;
    font-weight: 500;

  }
</style>
<?php if ($data) {  ?>
  <div class="container-fluid" style="min-height:100vh"><br>
    <div class="row justify-content-center ">
      <div class="card bg-white border-0 shadow-sm d-none">
        <div class="w-100 d-flex">
          <div class="" style="width:10%">
            <div class="d-flex float-left flex-column justify-content-center" style="min-height:30vh">
              <img src="images/wow.png" alt="" class="d-flex rounded-circle m-3" style="width: 60px;height:60px">
              <h5 class="text-center text-wrap flex-wrap"></h5>
            </div>
          </div>
          <div style="width:80%">
            <div class="card card-body my-3">
              <p class="mb-2">Assignment <span class="ml-3"> Date</span></p>
              <h4>What is Science Fiction?</h4>
              <!-- <img src="images/wow.png" alt="" class="img-fluid w-25 h-25"> -->
              <span class="position-absolute" style="right:55px">Due </span>
              <p class="qn"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum vitae, error nemo quam quidem nisi asperiores possimus, cumque expedita dignissimos reiciendis iure impedit est, culpa sint vero iusto autem reprehenderit.
              </p>

              <div class="ans">
                <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Post Answer
                </button>

                <div class="collapse" id="collapseExample">
                  <div class="form-group">
                    <label style="font-family: nunito, sans-serif;font-weight:600">Write an answer</label><br>
                    <textarea rows="3" cols="50" name="description" id="assignment_desc" required="required" class="form-control"></textarea>

                    <a style="color:red" id="descError"></a>
                  </div>
                  <i class="fas fa-link"></i> Attach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">
          <?php
          $my_subjects = $obj->Query("SELECT * from addsubject where semester = '$sem'");
          ?>
          <div class="card-body">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-9">
                <div class="row">
                  <?php foreach ($my_subjects as $key => $value) : ?>
                    <div class="col-lg-6 box-col mb-3">
                      <a href="<?= base_url('assignments.php?sub=' . $value->subjectname . '&id=' . $value->sub_id) ?>" class="text-dark">
                        <div class="flex-wrap p-4 d-flex justify-content-center align-items-center flex-column my-auto" style="background-color:#dddddd;height:30vh">
                          <div class="text-center ">
                            <h4><?= $value->subjectname ?></h4>
                          </div>
                        </div>
                      </a>
                    </div>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } else { ?>
  <div style="height:100vh">
    <h5 style="color:red" class="ml-4 mt-4 text-center">No teacher have created any assignment!</h5>
  </div>
<?php } ?>


<script>
  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {
      type: "text/csv"
    });

    // Download link
    downloadLink = document.createElement("a");
    downloadLink.download = filename;

    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
  }


  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll("td, th");

      for (var j = 0; j < cols.length; j++)
        row.push(cols[j].innerText);

      csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
  }
</script>