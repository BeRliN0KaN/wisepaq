 <!-- Start Header -->
 <?php include("./includes/header.php") ?>
 <!-- End Header -->

 <!-- About Start -->
 <div class="container-xxl py-5">
     <div class="container ">

         <div class="col-lg-12 wow fadeIn text-center align-items-center d-flex" data-wow-delay="0.1s">
             <div class="justify-content-center">
                 <img class="img-fluid h-50 w-50 rounded " style="object-fit:cover;" src="https://ckbox.cloud/382e77cfc832c66adcfc/assets/4zEWhOGL6MkZ/images/1280.jpeg" alt="">
             </div>
         </div>

         <div class="col-lg-12 wow fadeIn text-center align-items-center" data-wow-delay="0.5s">
             <!-- <p class="d-inline-block rounded bg-secondary-gradient text-light py-3 px-4 fs-2 mt-4">OUTSOURCE</p> -->
             <h1 class="text-uppercase mb-4 m-4">OUTSOURCE</h1>
             <p class="col-lg-6 mx-auto text-center"><?php echo constant('page_outsource_1') ?></p>
             <!-- <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus dolor eos.</p> -->
             <br>
             <div class="row g-4">
                 <div class="col-md-6">
                     <h3 class="text-uppercase mb-3"><?php echo constant('page_outsource_2') ?></h3>
                     <p class="mb-0"><?php echo constant('page_outsource_3') ?></p>
                 </div>
                 <br>
                 <div class="col-md-6">
                     <h3 class="text-uppercase mb-3"><?php echo constant('page_outsource_4') ?></h3>
                     <p class="mb-0"><?php echo constant('page_outsource_5') ?></p>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- About End -->







 <!-- content outsource Start -->
 <div class="container">
     <?php
        $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=8 AND tbl_categories.cat_id=8 AND tbl_posts.post_status='Published'";
        $fetch_posts_data = mysqli_query($connection, $query);
        $counter = 1; // ตัวแปรสำหรับนับลูป
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

            // ตรวจสอบว่าตัวนับคือเลขคี่หรือคู่
            if ($counter % 2 != 0) {
        ?>
             <div class="row g-5 py-5 align-items-center">
                 <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                     <div class="img-border">
                         <img class="img-fluid " src="<?php echo "admin@WSP//images/" . $the_post_image; ?>" alt="" />
                     </div>
                 </div>
                 <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                     <div class="d-flex align-items-center mb-4">
                         <h1 class="mb-0"><?php echo $counter ?></h1>
                         <span class="bg-primary mx-2" style="width: 30px; height: 2px;"></span>
                         <h5 class="mb-0"><?php echo $the_post_title ?></h5>
                     </div>
                     <p class="mb-4"><?php echo $the_post_content ?></p>
                 </div>
             </div>
         <?php
            } else {
            ?>
             <div class="row g-5 py-5 align-items-center flex-column-reverse flex-lg-row">
                 <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                     <div class="d-flex align-items-center mb-4">
                         <h1 class="mb-0"><?php echo $counter ?></h1>
                         <span class="bg-primary mx-2" style="width: 30px; height: 2px;"></span>
                         <h5 class="mb-0"><?php echo $the_post_title ?></h5>
                     </div>
                     <p class="mb-4"><?php echo $the_post_content ?></p>
                 </div>
                 <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                     <div class="img-border">
                         <img class="img-fluid" src="<?php echo "admin@WSP//images/" . $the_post_image; ?>" alt="" />
                     </div>
                 </div>
             </div>
     <?php
            }
            $counter++; // เพิ่มตัวนับ
        }
        ?>
 </div>
 <!-- content outsource End -->

 <!-- Start Footer -->
 <?php include("./includes/footer.php") ?>
 <!-- End Footer -->