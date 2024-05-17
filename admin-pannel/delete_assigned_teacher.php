<?php
require_once("config/config.php");
require_once("config/db.php");
$check = $_POST['tag'];
$str = "DELETE from assignedsubject where id = $check";
$a = $obj->Query($str);

$updated = $obj->select('assignedSubject', '*', '', array(), ' ORDER BY id desc');
 
?>

<?php if($updated) { ?>
    <div class="tab-pane" id="tabs-2" role="tabpanel">
    <table class="table table-hover table-responsive-lite" id="deleted_updated_data">
        <thead>
            <tr style="background: #f9f9f9;">
                <th>SN</th>
                <th>Name</th>
                <th>Semester</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($updated as $key => $value) : ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold">
                            <?php
                            $t_quer = $obj->select('tbl_teacher', '*', 'tid', array($value['tid']));
                            $t_name =   $t_quer[0]['tname']; ?>
                            <?= $t_name ?>
                        </a>
                    </td>
                    <td>
                        <?php
                        $sem_quer = $obj->select('semesters', '*', 'id', array($value['sem']));
                        $sem_name =   $sem_quer[0]['name']; ?>
                        <?= $sem_name ?>
                    </td>
                    <td>
                        <?php
                        $sub_quer = $obj->select('addsubject', '*', 'sub_id', array($value['sub']));
                        $sub_name =   $sub_quer[0]['subjectname']; ?>
                        <?= $sub_name ?>
                    </td>
                    <td><button class="btn btn-primary btn-sm" onclick="delete_indiv(<?= $value['id'] ?>);"><i class="far fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> <?php } else { ?> 
    <p class="pt-2 text-primary">No data found</p>
    <?php } ?> 

