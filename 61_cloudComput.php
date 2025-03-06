 <?php include("./includes/header.php") ?>

 <div class="text-center mx-auto wow fadeInUp section-title mt-5" data-wow-delay="0.1s" style="max-width: auto;">
     <h2 class="display-5 mb-4">CLOUD COMPUTING</h2>
     <p class="mb-0 fs-5"><?php echo constant('page_cloudComput_3') ?></p>
 </div>

 <!-- product Start -->
 <div class="container-fluid service" style="height: 50rem;">
     <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 80%;">
         <div class="row g-1 justify-content-center">

             <?php
                $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=6 AND tbl_categories.cat_id=6 AND tbl_posts.post_status='Published'";
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

                 <div class="rounded-3 service-item text-center p-4 pb-0 flex-column align-items-center mt-5 text-wrap" >

                     <div class="blog-item">
                         <img src="<?php echo "admin@WSP//images/" . $the_post_image; ?>" class="img-fluid rounded-2" style="object-fit:contran; width:100% ;height:35vh" alt="">
                     </div>

                     <br>
                     <h2 class="display-6 mb-4 fw-bold"><?php echo $the_post_title ?></h2>
                     <div class="mb-4" style="font-size: 15px;"><?php echo $the_post_content ?></div>
                     <br>
                 </div>
         </div>
     <?php } ?>
     </div>
 </div>
 <!-- product End -->

 <!-- Start Footer -->
 <?php include("./includes/footer.php") ?>
 <!-- End Footer -->