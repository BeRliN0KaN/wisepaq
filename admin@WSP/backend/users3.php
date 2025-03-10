<?php
include "includes_backend/header.php";
include "includes_backend/navigation.php";
?>

<main id="main" class="main">
<div class="row">
<div class="col-md-4">
    <div class="card" style="height:auto;">
        <div class="card-body">
        <div class="pagetitle">
        <h1 class="fs-1 pb-1 ps-4 py-5">
             Welcome to <span style="color: #578FCA;">USERS</span>
        </h1>
    </div><!-- End Page Title -->
            <?php
            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = "";
            }
            switch ($source) {
                case 'add_user':
                    include "./includes_backend/add_user.php";
                    break;
                case 'edit_user':
                    include "./includes_backend/edit_user.php";
                    break;
                default:
                   header("view_all_users.php");
                    break;
            }
            ?>
        </div>
    </div>
    </div>
    </div>
    </div>
</main>

<?php include "includes_backend/footer.php" ?>