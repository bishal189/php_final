

<footer>
  <div class="text-center p-3" style="background-color:#fff;border-top:1px solid #e7e7e7;">
     All rights reserved &copy;2022
    <a class="text-success" href="<?=exit_url()?>"> &#8594;Digital Assignment</a>
  </div>
 </footer>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

 <script>
    $("#mysearch").keyup(function () {
        var value = this.value.toLowerCase().trim();

        $("table tr").each(function (index) {
            if (!index) return;
            $(this).find("td").each(function () {
                var id = $(this).text().toLowerCase().trim();
                var not_found = (id.indexOf(value) == -1);
                $(this).closest('tr').toggle(!not_found);
              return not_found;
            });
        });
    });
</script> 


<script>

    function showMe(){
        var x = document.getElementById('Visible');
        var y = document.getElementById('Visible1');
        if (x.type === "password" ) {
            x.type = "text";
        }else{
            x.type = "password";
        }
        if (y.type === "password" ) {
            y.type = "text";
        }else{
            y.type = "password";
        }
    }
</script>




<!-- Jquery JS-->
    <script src="<?=base_url('layouts/vendor/jquery-3.2.1.min.js')?>"></script>
    <!-- Bootstrap JS-->
    <script src="<?=base_url('layouts/vendor/bootstrap-4.1/popper.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/bootstrap-4.1/bootstrap.min.js')?>"></script>
    <!-- Vendor JS       -->
    <script src="<?=base_url('layouts/vendor/slick/slick.min.js')?>">
    </script>
    <script src="<?=base_url('layouts/vendor/wow/wow.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/animsition/animsition.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')?>">
    </script>
    <script src="<?=base_url('layouts/vendor/counter-up/jquery.waypoints.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/counter-up/jquery.counterup.min.js')?>">
    </script>
    <script src="<?=base_url('layouts/vendor/circle-progress/circle-progress.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/chartjs/Chart.bundle.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/select2/select2.min.js')?>">
    </script>

    <!-- Main JS-->
    <script src="<?=base_url('layouts/js/main.js')?>"></script>
<script
  src="<?=base_url('layouts/js/jquery-3.4.1.min.js')?>"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous')?>"></script>
</body>
</html>
