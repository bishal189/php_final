<?php
require_once ("config/config.php");
require_once ("config/db.php");
$id = $_POST['aid'];
 $dead=
            $obj->select('tbl_create_assignment','deadline','id',array($id));
            $dead=$dead[0]['deadline'];
            ?>
            <label class="font-weight-bold text-secondary">Deadline </label>
            <p><b><?=$dead;?></b></p>