<?php
include "includes_backend/header.php";
include "includes_backend/navigation.php";

// Add new Category.
$error_message = "";
if (isset($_POST["submit"])) {
    $cat_title = $_POST['cat_title'];
    if (!empty($cat_title) || $cat_title != "") {
        $query = "INSERT INTO tbl_categories (cat_title) VALUES('$cat_title'); ";
        $create_query = mysqli_query($connection, $query);
        if (!$create_query) {
            die("Query Failed: " . mysqli_error($connection));
        }
    } else {
        $error_message = "Category field is required.";
    }
}

// Delete Category.
if (isset($_GET["delete"])) {
    $cat_id = $_GET['delete'];
    $query = "DELETE FROM tbl_categories WHERE cat_id=$cat_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Update Category.
if (isset($_GET["edit"], $_POST["update_category"])) {
    $cat_id = $_GET['edit'];
    $cat_title = $_POST["cat_title"];
    $cat_title_thai = $_POST["cat_title_thai"];
    $query = "UPDATE tbl_categories SET cat_title='$cat_title', cat_title_thai='$cat_title_thai'      WHERE cat_id=$cat_id";
    $update_query = mysqli_query($connection, $query);
    header("Location: categories.php");
    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

// Delete Post.
if (isset($_GET["deletePost"])) {
    $post_id = $_GET['deletePost'];
    $post_image = $_GET['image'];
    $query = "DELETE FROM tbl_posts WHERE post_id=$post_id";
    $delete_query = mysqli_query($connection, $query);
    unlink('../images/' . $post_image);
    header("Location: posts.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}


?>

<main id="main" class="main">
<div class="pagetitle">
        <h1>View All Activity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="activity.php">View All Activity</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card pt-5">
        <div class="card-body">
            <?php
            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = "";
            }
            switch ($source) {
                case 'add_activity':
                    include "./includes_backend/add_activity.php";
                    break;
                case 'edit_activity':
                    include "./includes_backend/edit_activity.php";
                    break;
                default:
                    include "./includes_backend/view_all_activity.php";
                    break;
            }
            ?>
        </div>
    </div>
    </div>
</main>
<?php include "includes_backend/footer.php" ?>