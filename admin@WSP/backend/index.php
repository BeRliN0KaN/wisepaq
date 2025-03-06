<!-- ======= Header ======= -->
<?php include "includes_backend/header.php" ?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php include "includes_backend/navigation.php"; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="fs-1 pb-1 " style="margin-left: 8rem;"> Welcome to <span style="color: #578FCA;">Dashboard</span> 
        </h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Summary </h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                            <?php
                            // ดึงจำนวนโพสต์ที่อยู่ในสถานะ Published
                            $query = "SELECT * FROM tbl_posts WHERE post_status='Published'";
                            $select_active_posts = mysqli_query($connection, $query);
                            $active_posts_count = mysqli_num_rows($select_active_posts);

                            // ดึงจำนวนโพสต์ที่อยู่ในสถานะ Draft
                            $query = "SELECT * FROM tbl_posts WHERE post_status='Draft'";
                            $select_draft_posts = mysqli_query($connection, $query);
                            $draft_posts_count = mysqli_num_rows($select_draft_posts);

                            // ดึงจำนวนโพสต์ในหมวดหมู่ต่างๆ
                            $query = "SELECT * FROM tbl_categories";
                            $select_all_categories = mysqli_query($connection, $query);
                            $categories_posts_count = mysqli_num_rows($select_all_categories);

                            // ดึงจำนวนผู้ใช้ทั้งหมด
                            $query = "SELECT * FROM tbl_activity WHERE activity_status='Published'";
                            $select_active_activity = mysqli_query($connection, $query);
                            $active_activity_count = mysqli_num_rows($select_active_activity);

                            // ดึงจำนวนผู้ใช้ทั้งหมด
                            $query = "SELECT * FROM tbl_activity WHERE activity_status='Draft'";
                            $select_draft_activity = mysqli_query($connection, $query);
                            $draft_activity_count = mysqli_num_rows($select_draft_activity);

                            // ดึงจำนวนผู้ใช้ทั้งหมด
                            $query = "SELECT * FROM tbl_users";
                            $select_all_users = mysqli_query($connection, $query);
                            $users_count = mysqli_num_rows($select_all_users);

                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item',
                                            formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, ค่า, และเปอร์เซ็นต์
                                        },
                                        legend: {
                                            top: '2%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Access From',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            top: '5%',
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: true, // แสดง label
                                                position: 'outside', // กำหนดตำแหน่ง label เป็นข้างนอก
                                                formatter: '{b}: {d}%' // แสดงชื่อของแต่ละส่วนและเปอร์เซ็นต์
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: true // แสดงเส้นที่เชื่อมโยง label
                                            },
                                            data: [{
                                                    value: <?php echo $active_posts_count; ?>,
                                                    name: 'Published Posts'
                                                },
                                                {
                                                    value: <?php echo $draft_posts_count; ?>,
                                                    name: 'Draft Posts'
                                                },
                                                {
                                                    value: <?php echo $categories_posts_count; ?>,
                                                    name: 'Categories Posts'
                                                },
                                                {
                                                    value: <?php echo $users_count; ?>,
                                                    name: 'Users'
                                                },
                                                {
                                                    value: <?php echo $active_activity_count; ?>,
                                                    name: 'Published Active'
                                                },
                                                {
                                                    value: <?php echo $draft_activity_count; ?>,
                                                    name: 'Draft Active'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>


                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- Categories Post Card -->
                    <div class="col-xxl-6 col-md-12">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Categories Post</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-folder"></i>

                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        $query = "SELECT * FROM tbl_categories";
                                        $select_all_categories = mysqli_query($connection, $query);
                                        $categories_posts_count = mysqli_num_rows($select_all_categories);
                                        ?>
                                        <h6><?php echo $categories_posts_count ?> <span>Categories</span></h6>
                                        <a href="categories.php">
                                            <span class="text-muted small pt-2 ps-1">View Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Categories Post Card -->

                    <!-- Activitys Card -->
                    <div class="col-xxl-6 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Activitys</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-clipboard"></i>

                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        $query = "SELECT * FROM tbl_activity";
                                        $select_all_activity = mysqli_query($connection, $query);
                                        $activity_count = mysqli_num_rows($select_all_activity);

                                        ?>
                                        <h6><?php echo $activity_count; ?> <span>Activity</span></h6>
                                        <a href="activity.php">
                                            <span class="text-muted small pt-2 ps-1">View Details</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End Activitys Card -->
                    <!-- Post Card -->
                    <div class="col-xxl-6 col-md-12">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Post</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        $query = "SELECT * FROM tbl_posts";
                                        $select_all_posts = mysqli_query($connection, $query);
                                        $posts_count = mysqli_num_rows($select_all_posts);

                                        ?>
                                        <h6><?php echo $posts_count; ?> <span>Post</span></h6>
                                        <a href="posts.php">
                                            <span class="text-muted small pt-2 ps-1">View Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Poste Card -->

                    <!-- User Card -->
                    <div class="col-xxl-6 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">User</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        $query = "SELECT * FROM tbl_users";
                                        $select_all_users = mysqli_query($connection, $query);
                                        $users_count = mysqli_num_rows($select_all_users);
                                        ?>
                                        <h6><?php echo $users_count; ?> <span>Users</span></h6>
                                        <a href="users.php">
                                            <span class="text-muted small pt-2 ps-1">View Details</span>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End User Card -->





                </div><!-- End Right side columns -->

            </div>
    </section>

</main><!-- End #main -->


<?php include "includes_backend/footer.php" ?>