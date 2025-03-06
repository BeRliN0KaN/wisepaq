 <?php include("./includes/header.php") ?>
 <!-- Blog Start -->
 <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
     <div class="container py-5">
         <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
             <h2 class="mb-0">PRODUCT</h2>
             <p class="p-1 fs-5">by</p>
             <h5 class="fw-bold text-primary text-uppercase mt-1">wisepaq</h5>
         </div>
         <div class="row g-5">

             <?php
                $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=5 AND tbl_categories.cat_id=5 AND tbl_posts.post_status='Published'";
                $fetch_posts_data = mysqli_query($connection, $query);
                while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
                    $the_post_id = $Row['post_id'];
                    $the_post_image = $Row['post_image'];
                    if ($_SESSION['lang'] == 'en') {
                        $the_post_title = base64_decode($Row['post_title']);
                        $the_post_content = base64_decode($Row['post_content']);
                        $post_subtitle = base64_decode($Row['post_subtitle']);
                    } else {
                        $the_post_title = base64_decode($Row['post_title_thai']);
                        $the_post_content = base64_decode($Row['post_content_thai']);
                        $post_subtitle = isset($Row['post_subtitle_thai']) ? base64_decode($Row['post_subtitle_thai']) : '';
                    }
                ?>

                 <div class="col-lg-4 wow slideInUp " data-wow-delay="0.3s">
                     <div class="blog-item bg-light rounded overflow-hidden shadow-lg">
                         <div class="blog-img position-relative overflow-hidden">
                             <img class="img-fluid w-100 " style="object-fit:cover;" src="<?php echo "admin@WSP//images/" . $the_post_image; ?>" alt="">
                             <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                         </div>
                         <div class="p-4">
                             <div class=" mb-3">
                                 <small class="me-3"><i class="fas fa-building text-primary me-2"></i><?php echo $post_subtitle ?></small>
                                 <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                             </div>
                             <h4 class="mb-3"><?php echo $the_post_title ?></h4>
                             <h2><?php echo $the_post_content ?></h2>
                             <!-- <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a> -->
                         </div>
                     </div>
                 </div>
             <?php } ?>
         </div>
     </div>
 </div>
 <!-- Blog Start -->


 <!-- Pricing Section -->
 <section id="pricing" class="pricing section light-background">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
         <h2>Pricing</h2>
         <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
     </div><!-- End Section Title -->

     <div class="container" data-aos="fade-up" data-aos-delay="100">

         <div class="row g-4 justify-content-center">

             <!-- Basic Plan -->
             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                 <div class="pricing-card">
                     <h3>Basic Plan</h3>
                     <div class="price">
                         <span class="currency">$</span>
                         <span class="amount">9.9</span>
                         <span class="period">/ month</span>
                     </div>
                     <p class="description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam.</p>

                     <h4>Featured Included:</h4>
                     <ul class="features-list">
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Duis aute irure dolor
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Excepteur sint occaecat
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Nemo enim ipsam voluptatem
                         </li>
                     </ul>

                     <a href="#" class="btn btn-primary">
                         Buy Now
                         <i class="bi bi-arrow-right"></i>
                     </a>
                 </div>
             </div>

             <!-- Standard Plan -->
             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                 <div class="pricing-card popular">
                     <div class="popular-badge">Most Popular</div>
                     <h3>Standard Plan</h3>
                     <div class="price">
                         <span class="currency">$</span>
                         <span class="amount">19.9</span>
                         <span class="period">/ month</span>
                     </div>
                     <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>

                     <h4>Featured Included:</h4>
                     <ul class="features-list">
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Lorem ipsum dolor sit amet
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Consectetur adipiscing elit
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Sed do eiusmod tempor
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Ut labore et dolore magna
                         </li>
                     </ul>

                     <a href="#" class="btn btn-light">
                         Buy Now
                         <i class="bi bi-arrow-right"></i>
                     </a>
                 </div>
             </div>

             <!-- Premium Plan -->
             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                 <div class="pricing-card">
                     <h3>Premium Plan</h3>
                     <div class="price">
                         <span class="currency">$</span>
                         <span class="amount">39.9</span>
                         <span class="period">/ month</span>
                     </div>
                     <p class="description">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae.</p>

                     <h4>Featured Included:</h4>
                     <ul class="features-list">
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Temporibus autem quibusdam
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Saepe eveniet ut et voluptates
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Nam libero tempore soluta
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Cumque nihil impedit quo
                         </li>
                         <li>
                             <i class="bi bi-check-circle-fill"></i>
                             Maxime placeat facere possimus
                         </li>
                     </ul>

                     <a href="#" class="btn btn-primary">
                         Buy Now
                         <i class="bi bi-arrow-right"></i>
                     </a>
                 </div>
             </div>

         </div>

     </div>

 </section><!-- /Pricing Section -->


 <!-- Start Footer -->
 <?php include("./includes/footer.php") ?>
 <!-- End Footer -->