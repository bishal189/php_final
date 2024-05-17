<aside class="menu-sidebar shadow  d-none d-lg-block">
    <div class="logo">
        <a href="<?= base_url('index.php'); ?>" class="text-dark d-flex py-2 text-decoration-none" style="font-size:26px;">
            <h3 class="text-dark font-weight-bold ">Digital &nbsp; </h3>
            <i class="fas fa-book-reader"></i>
        </a>
    </div>
    <div class="menu-sidebar mt-5 content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="">
                    <a class=" mt-20" href="<?= base_url('index.php'); ?>">
                        <i class="fas fa-home"></i>Home</a>
                </li>

                <!-- <li>
                    <a href="<?= base_url('add_semester.php'); ?>">
                        <i class="fas fa-chart-bar"></i> Semesters</a>

                </li> -->

                <li>
                    <a href="<?= base_url('subject.php'); ?>">
                        <i class="fas fa-book"></i> Subjects</a>

                </li>

                <li>
                    <a href="<?= base_url('add_teacher.php'); ?>">
                        <i class="fad fa-chalkboard-teacher"></i> Teachers</a>

                </li>

                <li>
                    <a href="<?= base_url('add_student.php'); ?>">
                        <i class="fas fa-users"></i> Students</a>

                </li>

                <li>
                    <a href="<?= base_url('logout.php'); ?> "><span class=" font-weight-bold"><i class="fas fa-sign-out-alt"></i> Log Out</span></a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
<div class="page-container" style="margin-top: 10px;">

    <!-- HEADER DESKTOP-->
    <div class="header-desktop" id="hideWhenModal">

        <div class="dropdown float-right pt-3 pr-4">

            <button class="btn dropdown-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                $admin = $obj->Select("tbl_admin", "*", "username", array($_SESSION['mainuser'])); ?>

                <?php foreach ($admin as $key => $value) : ?>
                    <?= $value['username'] ?>
                <?php endforeach; ?>



            </button>
            <style>
                .hahh a:hover {
                    color: #000;
                    background: #fff !important;


                }
            </style>
            <div class="dropdown-menu hahh" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url('logout.php'); ?>">Logout</a>
            </div>
        </div>

    </div>
</div>
<div>