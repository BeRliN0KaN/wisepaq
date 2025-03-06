<?php
include "includes_backend/header.php";
include "includes_backend/navigation.php";

// Add new Category.
$error_message = "";
if (isset($_POST["submit"])) {
    $cat_title = $_POST['cat_title'];
    $cat_title_thai = $_POST['cat_title_thai'];
    $cat_title_china = $_POST['cat_title_china'];
    $cat_page = $_POST['cat_page'];
    if (!empty($cat_title) || $cat_title != "") {
        $query = "INSERT INTO tbl_categories (cat_title,cat_title_thai,cat_page,cat_title_china) VALUES('$cat_title','$cat_title_thai','$cat_page ','$cat_title_china'); ";
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
    // Check exist user.
    $exist = -1;
    $queryExist = "SELECT EXISTS(SELECT * FROM tbl_posts WHERE post_category_id = $cat_id) as exist";
    $fetch_data = mysqli_query($connection, $queryExist);
    while ($Row = mysqli_fetch_assoc($fetch_data)) {
        $exist = $Row['exist'];
    }

    if ($exist == 0) {
        $query = "DELETE FROM tbl_categories WHERE cat_id=$cat_id";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
        if (!$delete_query) {
            die("Query Failed: " . mysqli_error($connection));
        }
    } else if ($exist == 1) {
        echo "<script>alert('Found data in the system!Can not delete');</script>";
    }
}

// Update Category.
if (isset($_GET["edit"], $_POST["update_category"])) {
    $cat_id = $_GET['edit'];
    $cat_title = $_POST["cat_title"];
    $cat_title_thai = $_POST["cat_title_thai"];
    $cat_title_china = $_POST["cat_title_china"];
    $cat_page = $_POST["cat_page"];
    $query = "UPDATE tbl_categories SET cat_title='$cat_title' , cat_title_thai='$cat_title_thai' , cat_page='$cat_page',cat_title_china='$cat_title_china' WHERE cat_id=$cat_id";
    echo $query;
    $update_query = mysqli_query($connection, $query);
    header("Location: categories.php");
    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

?>

<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <!-- Page Heading -->
            <div class="pagetitle">
                <h1 class="fs-1 pb-1 ps-4 py-5">
                    Welcome to <span style="color: #578FCA;">CATEGORIES</span>
                </h1>
            </div><!-- End Page Title -->
            <div class="row">
                <!-- จัดการ Add Category และ Edit Category -->
                <div class="col-xxl-6 col-md-12">
                    <div style="border: 2px solid gray; padding:20px;">
                        <h3>&nbsp;Add Category</h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_title" class="fw-bold mb-2">&nbsp;&nbsp;Category</label>
                                <input type="text" class="form-control" name="cat_title" id="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="cat_title" class="fw-bold mb-2">&nbsp;&nbsp;[ภาษาไทย] Category</label>
                                <input type="text" class="form-control" name="cat_title_thai" id="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="cat_title" class="fw-bold mb-2">&nbsp;&nbsp;[ภาษาจีน] Category</label>
                                <input type="text" class="form-control" name="cat_title_china" id="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="cat_page" class="fw-bold mb-2">&nbsp;&nbsp;Category page</label>
                                <input type="number" class="form-control" name="cat_page" id="">
                            </div>
                            <div class="form-group mt-3">
                                <input class="btn btn-primary" type="submit" name="submit" value="  Add Category">
                            </div>
                        </form>
                    </div>

                    <!-- ฟอร์ม Edit Category -->
                    <div style="height:10px"></div>
                    <form action="" method="POST">
                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            $query = "SELECT * FROM tbl_categories WHERE cat_id=$cat_id";
                            $fetch_data = mysqli_query($connection, $query);
                            while ($Row = mysqli_fetch_assoc($fetch_data)) {
                                $cat_title = $Row["cat_title"];
                                $cat_title_thai = $Row["cat_title_thai"];
                                $cat_title_china = $Row["cat_title_china"];
                                $cat_page = $Row["cat_page"];
                                if (isset($cat_title)) {
                        ?>
                                    <div style="border: 2px solid gray; padding:20px;">
                                        <h3>&nbsp;Edit Category</h3>
                                        <div class="form-group ">
                                            <label for="cat_title" class="fw-bold mb-2">&nbsp;&nbsp;Category</label>
                                            <input type="text" value="<?php echo $cat_title; ?>" class="form-control" name="cat_title" id="">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="cat_title_thai" class="fw-bold mb-2">&nbsp;&nbsp;[ภาษาไทย] Category</label>
                                            <input type="text" value="<?php echo $cat_title_thai; ?>" class="form-control" name="cat_title_thai" id="">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="cat_title_thai" class="fw-bold mb-2">&nbsp;&nbsp;[ภาษาจีน] Category</label>
                                            <input type="text" value="<?php echo $cat_title_china; ?>" class="form-control" name="cat_title_china" id="">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="cat_page" class="fw-bold mb-2">&nbsp;&nbsp; Category Page</label>
                                            <input type="number" value="<?php echo $cat_page; ?>" class="form-control" name="cat_page" id="">
                                        </div>

                                        <div class="form-group mt-3">
                                            <input class="btn btn-primary" type="submit" name="update_category" value="Edit Category">
                                        </div>
                                    </div>
                        <?php };
                            }
                        }
                        ?>
                    </form>

                    <span><?php echo $error_message; ?></span>
                </div>

                <!-- จัดตาราง ID ทางขวา -->
                <div class="col-xxl-6 col-md-12" style="display: flex; justify-content: flex-end;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>[ภาษาไทย] Category</th>
                                <th>[ภาษาจีน] Category</th>
                                <th>Category Page</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tbl_categories";;
                            $fetch_data = mysqli_query($connection, $query);
                            while ($Row = mysqli_fetch_assoc($fetch_data)) {
                                echo "<tr>
                                    <td>{$Row['cat_id']}</td>
                                    <td>{$Row['cat_title']}</td>
                                    <td>{$Row['cat_title_thai']}</td>
                                    <td>{$Row['cat_title_china']}</td>
                                    <td>{$Row['cat_page']}</td>
                                    <td>
                                        <a href='categories.php?edit={$Row['cat_id']}'><i class='bi bi-pencil-square ' aria-hidden='true'></i></a> |
                                        <a onClick=\"javascript: return confirm('Please confirm deletion');\"href='categories.php?delete={$Row['cat_id']}'><i class='bi bi-trash' aria-hidden='true'></i></a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "includes_backend/footer.php" ?>