<style>
  @import url('https://fonts.googleapis.com/css2?family=Monofett&family=MuseoModerno:wght@200;500&family=New+Tegomin&display=swap');


  .body {
    padding-top: 40px;

  }


  .hbody {
    color: #333;
    font-family: helvetica neau;
    font-weight: bold;
    font-size: 18px;
  }

  .info {
    line-height: 44px;
    font-size: 26px;
    justify-content: justify;
    margin-left: 30px;

  }
</style>

<div style="min-height:20vh !important"></div>
<!--Footer section -->
<footer class="footer text-center text-lg-start" style="background-color: #f1f1f1!important;border-top: 2px solid #e7e7e7;">
  <div class="text-center p-2" style="font-family:poppins, sans-serif;font-size: 14px!important;">All rights reserved
    &copy; <?php echo date("Y"); ?>
    <a class="text-primary" href="<?= base_url(); ?>"> Digital Assignment</a>
  </div>
</footer>
<!--ends -->
<!-- <script src="<?= base_url('js/jquery.min.js') ?>"></script> -->
<script src="<?= base_url('lib/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script>
  $(document).ready(function() {
    setTimeout(function() {
      $('.alert').hide('slow')
    }, 6000);
  })
</script>


</body>

</html>