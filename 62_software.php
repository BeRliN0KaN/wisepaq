 <!-- Header Start -->
 <?php include("./includes/header.php") ?>
 <!-- Header End -->

 <div>
    <?php
      $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id  where tbl_categories.cat_page=7 AND tbl_categories.cat_id=16 AND tbl_posts.post_status='Published'";
      $fetch_posts_data = mysqli_query($connection, $query);
      $count = 1; // เริ่มต้นตัวนับ

      // สร้างแท็บที่แสดงโพสต์
      while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
         $the_post_id = $Row['post_id'];
         $the_post_image = $Row['post_image'];

         // ตรวจสอบภาษาของเซสชัน
         if ($_SESSION['lang'] == 'en') {
            $the_post_title = base64_decode($Row['post_title']);
            $the_post_content = base64_decode($Row['post_content']);
            $post_subtitle = base64_decode($Row['post_subtitle']);
         } elseif ($_SESSION['lang'] == 'th') {
            $the_post_title = base64_decode($Row['post_title_thai']);
            $the_post_content = base64_decode($Row['post_content_thai']);
            $post_subtitle = base64_decode($Row['post_subtitle_thai']);
         } else {
            $the_post_title = base64_decode($Row['post_title_china']);
            $the_post_content = base64_decode($Row['post_content_china']);
            $post_subtitle = base64_decode($Row['post_subtitle_china']);
         }
      ?>
       <span> <?php echo  $the_post_content ?></span>
    <?php } ?>
 </div>


 <!-- Features Section -->
 <section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
       <h2>WISEPAQ FWD</h2>
       <p><?php echo constant('page_software_1') ?></p>
    </div><!-- End Section Title -->

    <div class="container">

       <div class="d-flex justify-content-center" style="width: auto;">

          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

             <li class="nav-item">
                <a class="nav-link active show px-1 fs-6" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                   <h4>WISEPAQ FWD</h4>
                </a>
             </li><!-- End tab nav item -->

             <li class="nav-item">
                <a class="nav-link px-1 fs-6" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                   <h4>OPEATION</h4>
                </a><!-- End tab nav item -->

             </li>
             <li class="nav-item">
                <a class="nav-link px-1 fs-6" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                   <h4>ACCOUNT READY</h4>
                </a>
             </li><!-- End tab nav item -->

          </ul>

       </div>

       <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          <?php
            $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id where tbl_categories.cat_page=7 AND tbl_categories.cat_id=7 AND tbl_posts.post_status='Published'";
            $fetch_posts_data = mysqli_query($connection, $query);
            $count = 1; // เริ่มต้นตัวนับ

            // สร้างแท็บที่แสดงโพสต์
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

               // แสดงแท็บใหม่ทุก 3 รายการ
               if ($count == 1) {
                  echo '<div class="tab-pane fade active show" id="features-tab-' . $count . '">';
               } else {
                  echo '<div class="tab-pane fade" id="features-tab-' . $count . '">';
               }
            ?>
             <div class="row">
                <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                   <h3><?php echo $the_post_title ?></h3>
                   <p class="fst-italic"><i class="bi bi-check2-all"></i> <?php echo $post_subtitle ?></p>
                   <ul>
                      <li><span><?php echo $the_post_content ?></span></li>
                   </ul>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 text-center">
                   <img src="<?php echo "admin@WSP//images/" . $the_post_image; ?>" alt="" class="img-fluid rounded-3 shadow-lg" style="height:35rem; width:80%;">
                </div>
             </div>
       </div> <!-- End tab content item -->

    <?php
               $count++; // เพิ่มตัวนับหลังจากแสดงแต่ละแท็บ
            }
      ?>
    </div> <!-- End tab-content -->

 </section><!-- /Features Section -->


 <!-- Start Footer -->
 <?php include("./includes/footer.php") ?>
 <!-- End Footer -->