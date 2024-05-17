<div class="container-fluid bread breadcrumb  my-2 px-5">
    <div class="row">
        <style>
            .bread ul li {
                padding-right: 0.5rem;
            }
        </style>

        <ul class="list-unstyled d-flex">
            <li><a href="teacher_section.php"><i class="fas fa-home"></i></a> </li>
            <li> 
                <?php
                if (isset($_GET['sem']) && $_GET['sub']) { ?>
                /
                    <a href="<?= base_url('activity.php?sem=' . $_GET['sem'] . '&sub=' . $_GET['sub']) ?>">
                        <?php if (empty($_GET['sem'])) { ?>
                            Semester
                        <?php } else { ?>
                            <?php echo $_GET['sem'] ?> Semester
                        <?php } ?></a>
                <?php } else { ?> /  Dashboard<?php }  ?>
            </li>
            <li> /
                <?php if (isset($_GET['sub'])) { ?>
                    <?php
                    $sub_link_quer = $obj->select("addsubject", "*", "sub_id", array($_GET['sub']));
                    $sub_nam  =  $sub_link_quer[0]['subjectname'];
                    ?>
                    <?= $sub_nam ?>
                <?php } ?>

            </li>
            <li class="not_in_Homepage text-capitalize"> / <?= $basename ?> </li>
        </ul>

        <!-- <?= $url ?> -->

    </div>
</div>