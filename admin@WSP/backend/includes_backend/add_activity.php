<script src="../ckeditor/ckeditor.js"></script>
<?php
if (isset($_POST['create_post'])) {
    $activity_title = base64_encode($_POST['title']);
    $activity_title_thai = base64_encode($_POST['title_thai']);
    $activity_title_china = base64_encode($_POST['title_china']);
    $activity_subtitle = base64_encode($_POST['subtitle']);
    $activity_subtitle_thai = base64_encode($_POST['subtitle_thai']);
    $activity_subtitle_china = base64_encode($_POST['subtitle_china']);
    $activity_link_url = $_POST['link_url'];
    $activity_status = $_POST['activity_status'];
    $activity_pin = $_POST['activity_pin'];

    $path = $_FILES['activity_image']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $activity_image = strtotime(date("Y-m-d H:i:s")) . '.' . $ext;
    $activity_image_temp = $_FILES['activity_image']['tmp_name'];

    $activity_content = base64_encode($_POST['activity_content']);
    $activity_content_thai = base64_encode($_POST['activity_content_thai']);
    $activity_content_china = base64_encode($_POST['activity_content_china']);
    $activity_date = date("Y-m-d H:i:s");  // date('d-m-y');
    $activity_comemnt_id = 0;

    move_uploaded_file($activity_image_temp, "../activity/$activity_image");

    // Add new Post.
    $query = "INSERT INTO tbl_activity(activity_title, activity_title_thai, activity_title_china, activity_date, activity_image, activity_content, activity_content_thai, activity_content_china, activity_status,activity_subtitle,activity_subtitle_thai,activity_subtitle_china, activity_link,activity_pin) ";
    $query .= "VALUES( '{$activity_title}', '{$activity_title_thai}',  '{$activity_title_china}','{$activity_date}', '{$activity_image}', '{$activity_content}', '{$activity_content_thai}', '{$activity_content_china}', '{$activity_status}','{$activity_subtitle}','{$activity_subtitle_thai}','{$activity_subtitle_china}','{$activity_link_url}','{$activity_pin}')";
    $create_post_query = mysqli_query($connection, $query);
    $the_activity_id = mysqli_insert_id($connection);
    if (!$create_post_query) {
        die("Query Failed: " . mysqli_error($connection));
    }

    header("Location: activity.php");
    // echo "<p class='alert alert-success'>Post added successfully. <a href='../post.php?p_id=$the_post_id'>View Post</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data" class="row g-3">
    <!--                        <div class="form-group">
                                        <img src='../images/<?php echo $activity_image ?>' alt='image' width='100px'>
                                        <input type="file" name="post_image">
                                        <input type="hidden" id="post_image_old" name="post_image_old" value="<?php echo $activity_image_old; ?>">
                                    </div>-->
    <!--x-->
    <div class="form-group col-lg-12">
        <label for="activity_image" class="d-block ms-3 fw-bold ms-3">Activityc Image</label>
        <div>
            <label for="activity_image" class="upload-icon">
                <span style="margin-left: 8px ;">เลือกไฟล์รูปภาพ</span> <i class="fa fa-file-image-o" aria-hidden="true" style="font-size: 2.3rem;"></i>
            </label>
            <input type="file" name="activity_image" id="activity_image" style="display: none;" accept="image/*">
            <input type="hidden" id="activity_image_old" name="activity_image_old" value="<?php echo $activity_image_old; ?>">
        </div>
        <div id="preview-container">
            <!-- หากมี post_image_old ให้แสดงรูปเก่าหากไม่มีให้แสดงเป็น "no-image" -->
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
        <label class=" fw-bold ms-3" for="link">Link Url</label>
        <input type="text" class="form-control  mt-2" name="link_url">
    </div>
    <div class="form-group col-lg-4">
        <label class="fw-bold ms-3" for="activity_status">Activity Status</label>
        <select class="form-control mt-2" name="activity_status" id="Activity_category">
            <option value='Draft'>Select Option</option>
            <option value='Published'>Published</option>
            <option value='Draft'>Draft</option>
        </select>
    </div>
    <div class="form-group col-lg-4">
        <label class="fw-bold ms-3" for="activity_pin">Activity Pin</label>
        <label for="activity_pin">Activity Pin</label>
        <select class="form-control mt-2" name="activity_pin" id="activity_category">
            <option value='0'>Select Option</option>
            <option value='1'>Important</option>
            <option value='0'>Unimportant</option>
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <label class=" fw-bold ms-3" for="title">Activity Title</label>
        <input type="text" class="form-control  mt-2" name="title">
    </div>
    <div class="form-group  col-lg-6">
        <label class=" fw-bold ms-3" for="subtitle">Activity subtitle</label>
        <input type="text" class="form-control  mt-2" name="subtitle">
    </div>
    <div class="form-group col-lg-12">
        <label id="my-ckeditor" class=" fw-bold ms-3 mb-3" for="activity_content">Activity Content</label>
        <textarea id="editor" name="activity_content" class="form-control  mt-2">
                This is some sample content.
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
        <input type="text" class="form-control  mt-2" name="title_thai">
    </div>
    <div class="form-group  col-lg-6">
        <label class=" fw-bold ms-3" for="subtitle">[ภาษาไทย] Activity subtitle</label>
        <input type="text" class="form-control  mt-2" name="subtitle_thai">
    </div>
    <div class="form-group col-lg-12">
        <label id="my-ckeditor" class=" fw-bold ms-3 mb-3" for="activity_content_thai">[ภาษาไทย] Activity Content</label>
        <textarea id="editor2" name="activity_content_thai" class="form-control  mt-2">
                นี่คือเนื้อหาตัวอย่างบางส่วน.
                </textarea>
        <script>
            CKEDITOR.dtd.$removeEmpty['i'] = false;
            CKEDITOR.dtd.$removeEmpty['span'] = false;
            CKEDITOR.replace('editor2');
        </script>
    </div>


    <div class="form-group  col-lg-6">
        <label class=" fw-bold ms-3" for="title">[ภาษาจีน] Activity Title</label>
        <input type="text" class="form-control  mt-2" name="title_china">
    </div>
    <div class="form-group  col-lg-6">
        <label class=" fw-bold ms-3" for="subtitle">[ภาษาจีน] Activity subtitle</label>
        <input type="text" class="form-control  mt-2" name="subtitle_china">
    </div>
    <div class="form-group col-lg-12">
        <label id="my-ckeditor" class="ms-3  fw-bold ms-3 mb-3" for="activity_content_china">[ภาษาจีน] Activity Content</label>
        <textarea id="editor3" name="activity_content_china" class="form-control  mt-2">
                这是一些示例内容。
                </textarea>
        <script>
            CKEDITOR.dtd.$removeEmpty['i'] = false;
            CKEDITOR.dtd.$removeEmpty['span'] = false;
            CKEDITOR.replace('editor3');
        </script>
    </div>


    <div class="form-group col-lg-12">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
</form>