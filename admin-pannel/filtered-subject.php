<?php
require_once ("config/config.php");
require_once ("config/db.php");

$check = $_POST['tag'];

$filt_subject = $obj->select('addsubject','*', 'semester',array($check));
$sem_qq = $obj->select('semesters','*', 'id',array($check));
$sem_name = $sem_qq[0]['name'];

?>


<?php if($filt_subject ){ ?>
    <table class="table table-bordered table-hover table-responsive-lite" id="subjectSem_wise">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Semester</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th colspan="3">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filt_subject as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?php 
                                        $a = $obj->Select('semesters','*','id',array($value['semester']));
                                        $b =  $a[0]['name'];
                                        ?>
                                        <?= $b; ?></td>
                                    <td><?= $value['subjectname']; ?></td>
                                    <td><?= $value['subjectcode']; ?></td>
                                    <td><a href="<?= base_url('edit_manage_subjects.php?action=e&id=' . $value['sub_id']) ?>" class="btn btn-info btn-sm" onclick="return confirm('Are you sure you want to edit?')">Edit</a>
                                    </td>


                                    <td><a href="<?= base_url('subject.php?action=d&id=' . $value['sub_id']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
    </table>
 <?php } else { ?> 
<p class="p-3 text-primary"> No subject added in <?=$sem_name?> semester. </p>
<?php } ?>