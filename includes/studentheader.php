 <style>
        .logout h5{
            font-family: verdana;
            cursor: pointer;
            display: inline;
            padding: 10px;
                color: #555!important;
             }

            a{
            color:#555;
            }

             .banner,.login,.navbar{
            display: none !important;
            }


        .modal {
            top: 15%;
        display: none; /* Hidden by default */
          /*position: fixed; /* Stay in place */
          }

        /* Modal Content */
        .modal-content {
            /*left: 25%;*/
            background:#f8f8fc;
            color: #000;
            border: none!important;
            margin: auto;
             top: 10%;
         }
        </style>
<div class="row shadow-sm pt-3 pl-4 pb-2" style="background-color: #f6f6f6;">
        <div class="col-7">
            <h5>Welcome<br>
            <span class="font-weight-bold" style="font-family:sans-serif;color:darkblue;">
                <?php
                if(isset($_SESSION['submitted_by'])){

                    echo $_SESSION['submitted_by'];
                     }
                ?>
            </span>!</h5>
        </div>
    <!-- <a href="<?=base_url('teacherprofile.php');?>"><span class="text-dark"> <i class="fa fa-user"></i>  Profile</a> -->

    <div class="col-4 logout">
         <h5><a href="<?=base_url();?>"><i class="fas fa-home"></i></a></h5>
         <h5 id="myBtn"> <i class="fas fa-user"></i> Profile</h5>
         <button class="btn  btn-danger  btn-sm rounded-pill ml-4"><h5><a href="<?=base_url('logout.php');?>" class="text-white"><i class="fas fa-sign-out-alt"></i> Logout</a></h5></button>
    </div>
    </div>
        <hr>
 