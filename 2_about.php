<!-- Start Header -->
<?php include("./includes/header.php") ?>
<!-- End Header -->

<!-- About Section -->
<section id="about" class="about section pb-0">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <?php
        $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=2 and tbl_categories.cat_id=14 AND tbl_posts.post_status='Published'";
        $fetch_posts_data = mysqli_query($connection, $query);
        while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
            $the_post_id = $Row['post_id'];
            $the_post_image = $Row['post_image'];
            $lang = $_SESSION['lang'];
            switch ($lang) {
                case 'en':
                    $the_post_title = base64_decode($Row['post_title']);
                    $the_post_content = base64_decode($Row['post_content']);
                    break;
                case 'cn':
                    $the_post_title = base64_decode($Row['post_title_china']);
                    $the_post_content = base64_decode($Row['post_content_china']);
                    break;
                default:
                    $the_post_title = base64_decode($Row['post_title_thai']);
                    $the_post_content = base64_decode($Row['post_content_thai']);
                    break;
            }
        ?>

            <div class="row gy-4 align-items-center justify-content-between">

                <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center text-lg-start ">
                        <span class="about-meta ms-5"><?php echo constant("page_about_title_sm") ?></span>
                        <h1 class="about-title"><?php echo $the_post_title ?></h1>
                    </div>
                    <hr>
                    <div class="about-description"><?php echo $the_post_content ?></div>
                </div>
                <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="image-wrapper">
                        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                            <img src="<?php echo "admin@WSP/images/" . $the_post_image; ?>" alt="Business Meeting" class="img-fluid main-image rounded-4 " style="height:11cm">
                            <img src="https://ckbox.cloud/b4d6cbdf0ce5ece78c1c/assets/f2PJgV5asdj8/images/1024.webp" alt="Team Discussion" class="img-fluid small-image rounded-4 ">
                        </div>
                        <div class="experience-badge floating">
                            <h3>15+ <span><?php echo constant("page_about_years") ?></span></h3>
                            <p><?php echo constant("page_about_title") ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</section><!-- /About Section -->

<!-- Features Start -->
<div class="container-xxl " id="feature">
    <div class="container py-5 px-lg-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-primary-gradient fw-medium">WISEPAQ</h5>
            <h1 class="mb-5"><?php echo constant('page_service_1') ?></h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-item bg-white rounded-4 py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-laptop text-white fs-3" aria-hidden="true"></i>
                    </div>
                    <h5 class="mb-3">Outsource</h5>
                    <p class="m-0"><?php echo constant('page_about_7') ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature-item bg-white  rounded-4 py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-lock text-white fs-3"></i>
                    </div>
                    <h5 class="mb-3">Security</h5>
                    <p class="m-0"><?php echo constant('page_about_8') ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="feature-item bg-white  rounded-4 py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-cpu text-white fs-3"></i>
                    </div>
                    <h5 class="mb-3">Software</h5>
                    <p class="m-0"><?php echo constant('page_about_9') ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-item bg-white  rounded-4 py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-hdd-rack text-white fs-3"></i>
                    </div>
                    <h5 class="mb-3">Hardware</h5>
                    <p class="m-0"><?php echo constant('page_about_10') ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature-item bg-white  rounded-4 py-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-cloud text-white fs-3"></i>
                    </div>
                    <h5 class="mb-3">Cloud Storage</h5>
                    <p class="m-0"><?php echo constant('page_about_11') ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="feature-item bg-white  rounded-4 py-4 px-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                        <i class="bi bi-tools text-white fs-3"></i>
                    </div>
                    <h5 class="mb-3">IT Support</h5>
                    <p class="m-0"><?php echo constant('page_about_12') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->
<!-- About Start -->
<div class="container-fluid service ">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h2 class="display-5 mb-4 fw-bold "><?php echo constant('page_about_4') ?></h2>
            <p class="fs-5 mb-0"><?php echo constant('page_about_5') ?>
            </p>
        </div>
        <div class="row g-4 justify-content-center">

            <?php
            $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=2 and tbl_categories.cat_id=2 AND tbl_posts.post_status='Published'";
            $fetch_posts_data = mysqli_query($connection, $query);
            while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
                $the_post_id = $Row['post_id'];
                $the_post_image = $Row['post_image'];
                $lang = $_SESSION['lang'];
                switch ($lang) {
                    case 'en':
                        $the_post_title = base64_decode($Row['post_title']);
                        $the_post_content = base64_decode($Row['post_content']);
                        break;
                    case 'cn':
                        $the_post_title = base64_decode($Row['post_title_china']);
                        $the_post_content = base64_decode($Row['post_content_china']);
                        break;
                    default:
                        $the_post_title = base64_decode($Row['post_title_thai']);
                        $the_post_content = base64_decode($Row['post_content_thai']);
                        break;
                }
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3 fadeInUp d-flex " data-wow-delay="0.1s">
                    <div class="service-item text-center rounded-4 p-4 d-flex flex-column w-100 shadow-lg">
                        <div class="blog-item flex-grow-1">
                            <div class="blog-img overflow-hidden" style="position: relative;">
                                <img src="<?php echo "admin@WSP/images/" . $the_post_image; ?>" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;" alt="">
                            </div>
                            <div class="service-content">
                                <h6 class="my-3 fw-bold"><?php echo $the_post_title; ?></h6>
                                <p class=""><?php echo $the_post_content; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- About End -->
</div>
<!-- Hero Header End -->
</div>


<!-- Start Footer -->
<?php include("./includes/footer.php") ?>
<!-- End Footer -->