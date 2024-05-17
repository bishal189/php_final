<?php
// Retrieve the item ID from the URL
$item_id = $_GET['item_id'];

// Retrieve the viewers of the item
$viewers_q = $obj->select('viewers', '*', 'aid', array($item_id));
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Viewed On</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewers_q as $viewer) : ?>
                <?php
                $sidd = $viewer['sid'];
                $aa = $obj->Query("SELECT * FROM tbl_student_login WHERE sid = '$sidd'");
                $bb = $aa[0];
                ?>
                <tr>
                    <td><?php echo $bb->username; ?></td>
                    <td><?php echo date('d M Y, h:i A', strtotime($viewer['time'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
    .table thead th {
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
    }

    .table tbody td {
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="text-center mt-3">
  <button onclick="goBack()" class="btn btn-primary">Assignments</button>
</div>

<script>
function goBack() {
  window.history.back();
}
</script>


