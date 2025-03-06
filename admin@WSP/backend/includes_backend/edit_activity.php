<?php
if (isset($_POST['update_post'], $_GET['p_id'])) {
    $the_activity_id = $_GET['p_id'];

    $activity_title = base64_encode($_POST['title']);
    $activity_title_thai = base64_encode($_POST['title_thai']);
    $activity_title_china = base64_encode($_POST['title_china']); 
    $activity_subtitle = base64_encode($_POST['subtitle']);
    $activity_subtitle_thai = base64_encode($_POST['subtitle_thai']);
    $activity_subtitle_china = base64_encode($_POST['subtitle_china']); 
    $activity_link_url = $_POST['link_url'];
    $activity_status = $_POST['activity_status'];
    $activity_pin = $_POST['activity_pin'];

    $activity_content = base64_encode($_POST['activity_content']);
    $activity_content_thai = base64_encode($_POST['activity_content_thai']);
    $activity_content_china = base64_encode($_POST['activity_content_china']);
    $activity_date = date("Y-m-d H:i:s"); //date('d-m-y');    

    $activity_image_old = $_POST['activity_image_old'];

    $activity_image_temp = $_FILES['activity_image']['tmp_name'];
    if (strlen($activity_image_temp) > 0) {
        $path = $_FILES['activity_image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $activity_image = strtotime(date("Y-m-d H:i:s")) . '.' . $ext;

        unlink("../activity/$activity_image_old");
        move_uploaded_file($activity_image_temp, "../activity/$activity_image");
    } else {
        $activity_image = $activity_image_old;
    }

    // Update a Post.
    $query = "UPDATE tbl_activity SET ";
    $query .= "activity_title='$activity_title', ";
    $query .= "activity_title_thai='$activity_title_thai', ";
    $query .= "activity_title_china='$activity_title_china', ";
    $query .= "activity_subtitle='$activity_subtitle', ";
    $query .= "activity_subtitle_thai='$activity_subtitle_thai', ";
    $query .= "activity_subtitle_china='$activity_subtitle_china', ";   
    $query .= "activity_link='$activity_link_url', ";
    $query .= "activity_pin='$activity_pin', ";
    $query .= "activity_date='$activity_date', ";
    $query .= !empty($activity_image) ? "activity_image='$activity_image', " : null;
    $query .= "activity_content='$activity_content', ";
    $query .= "activity_content_thai='$activity_content_thai', ";
    $query .= "activity_content_china='$activity_content_china', ";
    $query .= "activity_status='$activity_status' ";
    $query .= "WHERE activity_id=$the_activity_id";

    //   $query = mysqli_real_escape_string($connection, $query);
    $update_activity_query = mysqli_query($connection, $query);
    if (!$update_activity_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
    header("Location: activity.php");
    //= echo "<p class='alert alert-success'>Post updated successfully. <a href='../post.php?p_id=$the_activity_id'>View Post</a></p>";
}
?>


<?php
if (isset($_GET['p_id'])) {
    $the_activity_id = $_GET['p_id'];
    $query = "SELECT * FROM tbl_activity WHERE activity_id=$the_activity_id";
    $fetch_data = mysqli_query($connection, $query);
    while ($Row = mysqli_fetch_assoc($fetch_data)) {
        $activity_id = $Row['activity_id'];
        $activity_title = base64_decode($Row['activity_title']);
        $activity_title_thai = base64_decode($Row['activity_title_thai']);
        $activity_title_china = base64_decode($Row['activity_title_china']);  
        $activity_subtitle = base64_decode($Row['activity_subtitle']);
        $activity_subtitle_thai = base64_decode($Row['activity_subtitle_thai']);
        $activity_subtitle_china = base64_decode($Row['activity_subtitle_china']);      
        $activity_link_url = $Row['activity_link'];
        $activity_status = $Row['activity_status'];
        $activity_pin = $Row['activity_pin'];
        $activity_image_old = $Row['activity_image'];
        $activity_image = $Row['activity_image'];
        $activity_date = $Row['activity_date'];
        $activity_content = base64_decode($Row['activity_content']);
        $activity_content_thai = base64_decode($Row['activity_content_thai']);
        $activity_content_china = base64_decode($Row['activity_content_china']);
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
            <!--                        <div class="form-group">
                                        <img src='../images/<?php echo $activity_image ?>' alt='image' width='100px'>
                                        <input type="file" name="activity_image">
                                        <input type="hidden" id="activity_image_old" name=activity_image_old" value="<?php echo $activity_image_old; ?>">
                                    </div>-->
            <!--x-->
            <div class="form-group col-lg-12">
                <label for="activity_image" class="d-block ms-3 fw-bold ms-3">Activityc Image</label>
                <div>
                    <label  for="activity_image" class="upload-icon">
                        <span style="margin-left: 8px ;">เลือกไฟล์รูปภาพ</span> <i class="fa fa-file-image-o" aria-hidden="true" style="font-size: 2.3rem;"></i>
                    </label>
                    <input type="file" name="activity_image" id="activity_image" style="display: none;" accept="image/*">
                    <input type="hidden" id="activity_image_old" name="activity_image_old" value="<?php echo $activity_image_old; ?>">
                </div>
                <div id="preview-container">
                    <!-- หากมี activity_image_old ให้แสดงรูปเก่าหากไม่มีให้แสดงเป็น "no-image" -->
                    <img id="preview-image" src='../activity/<?php echo $activity_image ? $activity_image : '#'; ?>' alt="Preview Image" class="img-post" style="display: <?php echo $activity_image ? 'block' : 'none'; ?>;">
                </div>
            </div>

            <script>
                document.getElementById('activity_image').addEventListener('change', function (event) {
                    const previewImage = document.getElementById('preview-image');
                    const file = event.target.files[0]; // ดึงไฟล์ที่เลือก
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImage.src = e.target.result; // แสดงรูปใน img
                            previewImage.style.display = 'block'; // ทำให้ img ปรากฏ
                        };
                        reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
                    }
                });
            </script>
            <div class="form-group col-lg-12">
                <label class=" fw-bold ms-3" for="link" >Link Url</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_link_url ?>" name="link_url">
            </div>
            <div class="form-group col-lg-4">
                <label class="fw-bold ms-3" for="activity_status">Activity Status</label>
                <select class="form-control  mt-2" name="activity_status" id="activity_category">
                    <option value='<?php echo $activity_status; ?>'><?php echo $activity_status; ?></option>
                    <?php if ($activity_status === "Published") { ?>
                        <option value='Draft'>Draft</option>
                    <?php } else { ?>
                        <option value='Published'>Published</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-4">
                <label for="activity_pin " class="fw-bold ms-3">Activity Pin</label>
                <select class="form-control mt-2" name="activity_pin" id="activity_category">
                    <option value='<?php echo $activity_pin; ?>'><?php echo ($activity_pin === "1") ? "Important" : "Unimportant"; ?></option>
                    <?php if ($activity_pin === "1") { ?>
                        <option value='0'>Unimportant</option>
                    <?php } else { ?>
                        <option value='1'>Important</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="title">Activity Title</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_title; ?>" name="title">
            </div>
            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="subtitle">Activity subtitle</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_subtitle; ?>" name="subtitle">
            </div>
            <div class="form-group col-lg-12">
                <label id="my-ckeditor" class=" fw-bold ms-3 mb-3" for="activity_content">Activity Content</label>
                <textarea id="editor" name="activity_content" class="form-control  mt-2">
                    <?php echo $activity_content; ?>
                </textarea>
                <script>
                    CKEDITOR.dtd.$removeEmpty['i'] = false;
                    CKEDITOR.dtd.$removeEmpty['span'] = false;
                    CKEDITOR.replace('editor');
                    CKEDITOR.config.width = "100%";
                    CKEDITOR.config.height = "300px";
                </script>
            </div>
            
            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="title">[ภาษาไทย] Activity Title</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_title_thai; ?>" name="title_thai">
            </div>
            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="subtitle">[ภาษาไทย] Activity subtitle</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_subtitle_thai; ?>" name="subtitle_thai">
            </div>
            <div class="form-group col-lg-12">
                <label id="my-ckeditor" class=" fw-bold ms-3 mb-3" for="activity_content_thai">[ภาษาไทย] Activity Content</label>
                <textarea id="editor2" name="activity_content_thai" class="form-control  mt-2">
                    <?php echo $activity_content_thai; ?>
                </textarea>
                <script>
                    CKEDITOR.dtd.$removeEmpty['i'] = false;
                    CKEDITOR.dtd.$removeEmpty['span'] = false;
                    CKEDITOR.replace('editor2');
                </script>
            </div>


            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="title">[ภาษาจีน] Activity Title</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_title_china; ?>" name="title_china">
            </div>
            <div class="form-group  col-lg-6">
                <label class=" fw-bold ms-3" for="subtitle">[ภาษาจีน] Activity subtitle</label>
                <input type="text" class="form-control  mt-2" value="<?php echo $activity_subtitle_china; ?>" name="subtitle_china">
            </div>
            <div class="form-group col-lg-12">
                <label id="my-ckeditor" class="ms-3  fw-bold ms-3 mb-3" for="activity_content_china">[ภาษาจีน] Activity Content</label>
                <textarea id="editor3" name="activity_content_china" class="form-control  mt-2">
                    <?php echo $activity_content_china; ?>
                </textarea>
                <script>
                    CKEDITOR.dtd.$removeEmpty['i'] = false;
                    CKEDITOR.dtd.$removeEmpty['span'] = false;
                    CKEDITOR.replace('editor3');
                </script>
            </div>       
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update_post" value="Update">
            </div>
        </form>
        <?php
    }
}
?>