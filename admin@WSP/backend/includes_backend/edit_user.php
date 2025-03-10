<?php
if (isset($_POST['update_user'], $_GET['user_id'])) {
    $the_user_id = $_GET['user_id'];

    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_username = $_POST['username'];
    $user_password_input = $_POST['password'];
    $user_email = $_POST['email'];

    $user_image_old = $_POST['user_image_old'];

    $user_image_temp = $_FILES['user_image']['tmp_name'];
    if (strlen($user_image_temp) > 0) {
        $path = $_FILES['user_image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $user_image = strtotime(date("Y-m-d H:i:s")) . '.' . $ext;

        unlink("../profile/$user_image_old");
        move_uploaded_file($user_image_temp, "../profile/$user_image");
    } else {
        $user_image = $user_image_old;
    }

    // ดึงรหัสผ่านเก่าจากฐานข้อมูล
    $sql = "SELECT user_password FROM tbl_users WHERE user_id = '$the_user_id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $storedHash = $row['user_password'];

    // ตรวจสอบว่าผู้ใช้เปลี่ยนรหัสผ่านหรือไม่
    if (!empty($user_password_input)) {
        $password = password_hash($user_password_input, PASSWORD_DEFAULT);
    } else {
        $password = $storedHash;
    }

    // อัปเดตข้อมูลผู้ใช้
    $query = "UPDATE tbl_users SET ";
    $query .= "user_firstname='$user_firstname', ";
    $query .= "user_lastname='$user_lastname', ";
    $query .= "user_name='$user_username', ";
    $query .= "user_password='$password', ";
    $query .= "user_email='$user_email', ";
    $query .= "user_image='$user_image' ";
    $query .= " WHERE user_id='$the_user_id'";

    $update_user_query = mysqli_query($connection, $query);

    if (!$update_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $_SESSION['username'] = $user_username;
        $_SESSION['user_image'] = $user_image;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['email'] = $user_email;
    }

    header("Location: ../backend/users.php");
    exit();
}
?>


<?php
if (isset($_GET['user_id'])) {
    $the_user_id = $_GET['user_id'];
    $query = "SELECT * FROM tbl_users WHERE user_id=$the_user_id";
    $fetch_data = mysqli_query($connection, $query);
    while ($Row = mysqli_fetch_assoc($fetch_data)) {
        $user_id = $Row['user_id'];
        $firstname = $Row['user_firstname'];
        $lastname = $Row['user_lastname'];
        $username = $Row['user_name'];
        $password = $Row['user_password'];
        $email = $Row['user_email'];
        $user_image_old = $Row['user_image'];
        $user_image = $Row['user_image'];
?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="py-2">
                <h5 class="card-title text-center pb-0 fs-4"><strong>Edit User</strong> </h5>
            </div>
            <div class="form-group">
                <label for="user_image" class="d-block fw-bold ms-3">User Image</label>
                <div>
                    <label for="user_image" class="upload-icon">
                        <span style="margin-left: 8px ;">เลือกไฟล์รูปภาพ</span> <i class="bi bi-file-image" aria-hidden="true" style="font-size: 1.3rem;"></i>
                    </label>
                </div>
                <input type="file" name="user_image" id="user_image" style="display: none;" accept="image/*">
                <input type="hidden" id="user_image_old" name="user_image_old" value="<?php echo $user_image_old; ?>">

                <div id="preview-container">
                <img id="preview-image" src='../profile/<?php echo $user_image ? $user_image : '#'; ?>' alt="Preview Image" class="img-post" style="display: <?php echo $user_image ? 'block' : 'none'; ?>; height:auto;">
                </div>
            </div>

            <script>
                document.getElementById('user_image').addEventListener('change', function(event) {
                    const previewImage = document.getElementById('preview-image');
                    const file = event.target.files[0]; // ดึงไฟล์ที่เลือก
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result; // แสดงรูปใน img
                            previewImage.style.display = 'block'; // ทำให้ img ปรากฏ
                        };
                        reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
                    }
                });
            </script>

            <div class="form-group">
                <label for="firstname" class="ms-3 fw-bold">Firstname</label>
                <input type="text" class="form-control mt-2" name="firstname" value='<?php echo $firstname; ?>'>
            </div>

            <div class="form-group mt-3">
                <label for="lastname" class="ms-3 fw-bold">Lastname</label>
                <input type="text" class="form-control mt-2" name="lastname" value='<?php echo $lastname; ?>'>
            </div>

            <div class="form-group mt-3">
                <label for="username" class="ms-3 fw-bold">Username</label>
                <input type="text" class="form-control mt-2" name="username" value='<?php echo $username; ?>'>
            </div>

            <div class="form-group mt-3">
                <label for="password" class="ms-3 fw-bold">Password</label>
                <input type="password" class="form-control mt-2" name="password" placeholder="Enter new password">
            </div>

            <div class="form-group mt-3">
                <label for="email" class="ms-3 fw-bold">Email</label>
                <input type="email" class="form-control mt-2" name="email" value='<?php echo $email; ?>'>
            </div>

            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
            </div>
        </form>
<?php }
}
?>