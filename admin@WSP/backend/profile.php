<?php
include "../backend/includes_backend/header.php";
include "../backend/includes_backend/navigation.php";
$messages = [];
if (isset($_POST['update_profile'], $_SESSION['username'])) {
    $the_user_name = $_SESSION['username'];

    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_username = $_POST['username'];
    // $user_password = $_POST['password'];
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
    // Check exist user.
    if ($the_user_name == $user_username) {
        // Update a User.
        $query = "UPDATE tbl_users SET ";
        $query .= "user_firstname='$user_firstname', ";
        $query .= "user_lastname='$user_lastname', ";
        $query .= "user_name='$user_username', ";
        // $query .= "user_password='$password', ";
        $query .= "user_email='$user_email', ";
        $query .= "user_image='$user_image' ";
        $query .= " WHERE user_name='$the_user_name'";

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
    }else{
    $user = 1;
    $queryExist = "SELECT EXISTS(SELECT * FROM tbl_users WHERE user_name = '$user_username') as user";
    $fetch_data = mysqli_query($connection, $queryExist);
    while ($Row = mysqli_fetch_assoc($fetch_data)) {
        $user = $Row['user'];
    }
    if ($user == 0) {
        // Update a User.
        $query = "UPDATE tbl_users SET ";
        $query .= "user_firstname='$user_firstname', ";
        $query .= "user_lastname='$user_lastname', ";
        $query .= "user_name='$user_username', ";
        // $query .= "user_password='$password', ";
        $query .= "user_email='$user_email', ";
        $query .= "user_image='$user_image' ";
        $query .= " WHERE user_name='$the_user_name'";

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
    } else {
        $_SESSION['messages'][] = "<p class='alert alert-danger'>⚠️ This user already in the system!!</p>";
        // $_SESSION['messages'][] = "<script>alert('This user already in the system!!');window.history.go(-1);</script>";
    }
    }
    header("Location: ../backend/profile.php");
    exit();
}
//Change Password
if (isset($_POST['change_password'], $_SESSION['username'])) {
    if (!empty($_POST['currentpassword']) && !empty($_POST['newpassword']) && !empty($_POST['renewpassword'])) {
        $the_user_name = $_SESSION['username'];
        $cur_pass = $_POST['currentpassword'];
        $new_pass = $_POST['newpassword'];
        $renew_pass = $_POST['renewpassword'];

        $sql = "SELECT user_password FROM tbl_users WHERE user_name = '$the_user_name'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $data_pass = $row['user_password'];

        if (password_verify($cur_pass, $data_pass)) {
            if ($new_pass == $renew_pass) {
                $password = password_hash($new_pass, PASSWORD_DEFAULT);

                // Update User
                $query = "UPDATE tbl_users SET user_password='$password' WHERE user_name='$the_user_name'";
                $update_user_query = mysqli_query($connection, $query);

                if ($update_user_query) {
                    $_SESSION['messages'][] = "<p class='alert alert-success'>✅ Password changed successfully</p>";
                } else {
                    $_SESSION['messages'][] = "<p class='alert alert-danger'>❌ Error updating password</p>";
                }
            } else {
                $_SESSION['messages'][] = "<p class='alert alert-danger'>⚠️ Passwords do not match</p>";
            }
        } else {
            $_SESSION['messages'][] = "<p class='alert alert-danger'>❌ Current password is incorrect</p>";
        }
    } else {
        $_SESSION['messages'][] = "<p class='alert alert-danger'>⚠️ Please fill all fields</p>";
    }
    header("Location: ../backend/profile.php");
    exit();
}

//Delete Account
if (isset($_POST["delete"], $_SESSION['username'])) {
    $the_user_name = $_SESSION['username'];
    $user_image = $_SESSION['user_image'];
    $query = "DELETE FROM tbl_users WHERE user_name='$the_user_name'";;
    $delete_query = mysqli_query($connection, $query);
    if ($delete_query) {
        unlink('../profile/' . $user_image);
        session_destroy();
        header("Location: ../index.php");
        exit();
    } else {
        die("Query Failed: " . mysqli_error($connection));
    }
}

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php
    if (isset($_SESSION['messages']) && is_array($_SESSION['messages'])) {
        foreach ($_SESSION['messages'] as $msg) {
            echo $msg;
        }
        unset($_SESSION['messages']);
    }
    ?>
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php
                        if ($_SESSION['user_image'] == "default.jpg") {
                            echo "<img src='../images/img-icon/profile.webp' alt='Profile' class='rounded-circle' style='width: 100px; height: 100px; object-fit: cover; border-radius: 50%;'>";
                        } else {
                            echo "<img src='../profile/{$_SESSION['user_image']}' alt='Profile' class='rounded-circle' style='width: 100px; height: 100px; object-fit: cover; border-radius: 50%;'>";
                        }
                        echo  "<h2>{$_SESSION['username']}</h2>";
                        ?>

                        <span><?php echo $_SESSION['user_role']; ?></span>
                        <div class="social-links mt-2">
                            <a href="#" class="linkedin"><i class="bi bi-display"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-body-text"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-gear"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-card-text"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>


                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <?php
                                if (isset($_SESSION['username'])) {

                                    $the_user_name = $_SESSION['username'];
                                    $query = "SELECT * FROM tbl_users WHERE user_name='$the_user_name'";
                                    $fetch_data = mysqli_query($connection, $query);
                                    while ($Row = mysqli_fetch_assoc($fetch_data)) {
                                        $user_id = $Row['user_id'];
                                        $firstname = $Row['user_firstname'];
                                        $lastname = $Row['user_lastname'];
                                        $username = $Row['user_name'];
                                        $password = $Row['user_password'];
                                        $email = $Row['user_email'];

                                ?>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Username</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $username; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">First Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $firstname; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Last Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $lastname; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
                                        </div>
                                        <form action="" method="post">
                                            <div class="d-flex justify-content-end ">
                                                <input type="submit" class="btn btn-danger mb-2 w-auto" style="width:6rem;" name="delete" value="Delete Account" onClick="javascript: return confirm('Are you sure you want to delete');">
                                            </div>
                                        </form>

                            </div>
                    <?php }
                                } else {
                                    echo "No user found";
                                }
                    ?>
                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                        <?php
                        if (isset($_SESSION['username'])) {

                            $the_user_name = $_SESSION['username'];
                            $query = "SELECT * FROM tbl_users WHERE user_name='$the_user_name'";
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
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div id="preview-container">
                                                <?php
                                                if ($user_image == "default.jpg") {
                                                    // แสดงรูปภาพจากตำแหน่งที่กำหนดเมื่อไม่มีการตั้งค่าโปรไฟล์
                                                    echo "<img id='preview-image' src='../images/img-icon/profile.webp' alt='Preview Image' class='img-post' style='display:block; height:auto;'>";
                                                } else {
                                                    // แสดงรูปภาพโปรไฟล์เมื่อมีการตั้งค่า
                                                    echo "<img id='preview-image' src='../profile/{$user_image}' alt='Preview Image' class='img-post' style='display:block; height:auto;'>";
                                                }
                                                ?>
                                            </div>
                                            <div class="pt-2">
                                                <label for="user_image" class="upload-icon">
                                                    <span style="margin-left: 8px ;">เลือกไฟล์รูปภาพ</span> <i class="bi bi-file-image" aria-hidden="true" style="font-size: 1.3rem;"></i>
                                                    <input type="file" name="user_image" id="user_image" style="display: none;" accept="image/*">
                                                    <input type="hidden" id="user_image_old" name="user_image_old" value="<?php echo $user_image_old; ?>">
                                                </label>
                                            </div>
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
                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="username" value="<?php echo $username; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                        <?php }
                        }

                        ?>
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form action="" method="post">

                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="currentpassword" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                    </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php include "../backend/includes_backend/footer.php"; ?>