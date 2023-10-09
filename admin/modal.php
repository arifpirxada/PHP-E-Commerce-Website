<!-- Modal for editing categories  -->


<div class="myModal">
        <form class="adminLog modal-form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
            <div class="crossImgContain">
                <img id="cross" onclick="goEditModal()" src="../img/Cross.png" alt="">
            </div>
            <h2 class="adminLogHead">Edit Category</h2>
            <input type="hidden" id="cat_id" name="cat_id" value="noSelection">
            <label for="updateCatName">Name</label>
            <input required id="updateCatName" name="updateCatName" type="text">
            <?php global $fileExists;
            if ($fileExists) { ?>
                <p class="notify notify-photo">file name already exists</p>
            <?php } ?>
            <div class="slPhotoContain center-Items">
                <input hidden type="file" name="option-photo" id="option-photo" onchange="checkSelection()">
                <label for="option-photo" class="btn center-Items btn-photo">Choose Photo (option)</label>
                <img src="../img/greenTick.png" class="photo-select" style="right: 2px;" alt="">
            </div>
            <input type="hidden" id="imgSelection" name="imgSelection" value="no">
            <?php global $onlyType;
            if ($onlyType) { ?>
                <p class="notify notify-photo">only photo please</p>
            <?php } ?>
            <?php global $pError;
            if ($pError) { ?>
                <p class="notify notify-photo">try later</p>
            <?php } ?>
            <?php global $bigSize;
            if ($bigSize) { ?>
                <p class="notify notify-photo">photo is too big</p>
            <?php } ?>
            <button class="btn addBtn" type="submit" id="catUpdate">Update</button>
            <?php global $update;
            if ($update) { ?>
                <p class="notify notify-photo">updation unsuccessfull!</p>
            <?php } ?>
            <?php global $success;
            if ($success) { ?>
                <p class="notify notify-photo">Category added successfully!</p>
            <?php } ?>
        </form>
    </div>