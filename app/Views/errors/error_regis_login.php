<?php
?>

<div class="d-flex flex-column alert alert-danger position-absolute top-0 start-0 p-2" style="margin-left: 10rem;">
    <?php
    $error = session()->getFlashdata('error'); 
    foreach ($error as $key) {
        if ($key !== null) {
            ?>
            <div><?= $key?></div>
            <?php
        }
    }?>
</div>

<?php ?>