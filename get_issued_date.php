<?php
require_once ("config/config.php");
require_once ("config/db.php");
$id = $_POST['aid'];
 $issue=
            $obj->select('tbl_create_assignment','created_date','id',array($id));
            $issue=$issue[0]['created_date'];
            ?>
            <label class="font-weight-bold text-secondary">Assignment Created Date</label>
            <p><b><?=$issue;?></b></p>