  <!-- Start Header -->
  <?php include("./includes/header.php") ?>
  <!-- End Header -->

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <?php
              $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id where tbl_categories.cat_page=1 AND tbl_categories.cat_id=1 AND tbl_posts.post_status='Published'";
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

                <span> <?php echo $the_post_content; ?></span>

              <?php  } ?>
            </div>
          </div>

          <div class="col-lg-6 ">
            <div class="hero-buttons">
              <div class="video-container ">
                <video autoplay muted loop playsinline class="shadow-lg">
                  <source src="https://video.wixstatic.com/video/11062b_6743da5900054f1f8e69f53302930a6a/720p/mp4/file.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            </div>
          </div>
        </div>

        <?php
        $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=1 AND tbl_categories.cat_id=15 AND tbl_posts.post_status='Published'";
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
          <div>
            <?php echo $the_post_content; ?>
          </div>
        <?php } ?>
      </div>

    </section><!-- /Hero Section -->


    <!-- Features Cards Section -->
    <section id="features-cards" class="features-cards section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="feature-box orange">
              <i class="bi bi-gear"></i>
              <h4>ENGINEERING</h4>
              <p><?php echo constant('page_index_solution_1') ?></p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-box blue">
              <i class="bi bi-reception-4"></i>
              <h4>NETWORK SOLUTIONS</h4>
              <p><?php echo constant('page_index_solution_2') ?></p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="feature-box green">
              <i class="bi bi-cloud-check"></i>
              <h4>ClOUD COMPUTING</h4>
              <p><?php echo constant('page_index_solution_3') ?></p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="feature-box red">
              <i class="bi bi-shield-check"></i>
              <h4>SECURITY</h4>
              <p><?php echo constant('page_index_solution_4') ?></p>
            </div>
          </div><!-- End Feature Borx-->

        </div>

      </div>

    </section><!-- /Features Cards Section -->



    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row content justify-content-center align-items-center position-relative">
          <div class="col-lg-9 mx-auto text-center">
            <h2 class="display-4 mb-4"><?php echo constant('page_index_activity_1') ?></h2>
            <p class="mb-4"><?php echo constant('page_index_activity_2') ?></p>
            <a href="3_activity.php" class="btn btn-cta"><?php echo constant('page_index_activity_3') ?></a>
          </div>

          <!-- Abstract Background Elements -->
          <div class="shape shape-1">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
              <path d="M47.1,-57.1C59.9,-45.6,68.5,-28.9,71.4,-10.9C74.2,7.1,71.3,26.3,61.5,41.1C51.7,55.9,35,66.2,16.9,69.2C-1.3,72.2,-21,67.8,-36.9,57.9C-52.8,48,-64.9,32.6,-69.1,15.1C-73.3,-2.4,-69.5,-22,-59.4,-37.1C-49.3,-52.2,-32.8,-62.9,-15.7,-64.9C1.5,-67,34.3,-68.5,47.1,-57.1Z" transform="translate(100 100)"></path>
            </svg>
          </div>

          <div class="shape shape-2">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
              <path d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.1,-12.1C75.6,3,72.4,20.9,63.3,34.4C54.2,47.9,39.2,56.9,23.2,62.3C7.1,67.7,-10,69.4,-24.8,64.1C-39.7,58.8,-52.3,46.5,-60.1,31.5C-67.9,16.4,-70.9,-1.4,-66.3,-16.6C-61.8,-31.8,-49.7,-44.3,-36.3,-54C-22.9,-63.7,-8.2,-70.6,3.6,-75.1C15.4,-79.6,28.2,-58.9,41.3,-49.1Z" transform="translate(100 100)"></path>
            </svg>
          </div>

          <!-- Dot Pattern Groups -->
          <div class="dots dots-1">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
              <pattern id="dot-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
              </pattern>
              <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
            </svg>
          </div>

          <div class="dots dots-2">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
              <pattern id="dot-pattern-2" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
              </pattern>
              <rect width="100" height="100" fill="url(#dot-pattern-2)"></rect>
            </svg>
          </div>

          <div class="shape shape-3">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
              <path d="M43.3,-57.1C57.4,-46.5,71.1,-32.6,75.3,-16.2C79.5,0.2,74.2,19.1,65.1,35.3C56,51.5,43.1,65,27.4,71.7C11.7,78.4,-6.8,78.3,-23.9,72.4C-41,66.5,-56.7,54.8,-65.4,39.2C-74.1,23.6,-75.8,4,-71.7,-13.2C-67.6,-30.4,-57.7,-45.2,-44.3,-56.1C-30.9,-67,-15.5,-74,0.7,-74.9C16.8,-75.8,33.7,-70.7,43.3,-57.1Z" transform="translate(100 100)"></path>
            </svg>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>VIRTUALIZATION</h2>
        <p>What We Can Do</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card d-flex">
              <div class="icon flex-shrink-0">
                <img src="./img/img-icon/icon-sangfor.png" alt="" width="50" height="50">
              </div>
              <div>
                <h3>Sangfor HCI</h3>
                <p><?php echo constant('page_index_virtualiz_1') ?></p>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card d-flex">
              <div class="icon flex-shrink-0">
                <img src="./img/img-icon/icon-nutanix.png" alt="" width="45" height="45">
              </div>
              <div>
                <h3>Nutanix</h3>
                <p><?php echo constant('page_index_virtualiz_2') ?></p>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card d-flex">
              <div class="icon flex-shrink-0">
                <img src="./img/img-icon/icon-microsoft.png" alt="" width="45" height="45">
              </div>
              <div>
                <h3>Microsoft</h3>
                <p><?php echo constant('page_index_virtualiz_3') ?></p>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card d-flex">
              <div class="icon flex-shrink-0">
                <img src="./img/img-icon/icon-vmware.png" alt="" width="50" height="50">
              </div>
              <div>
                <h3>VMWare</h3>
                <p><?php echo constant('page_index_virtualiz_4') ?></p>
              </div>
            </div>
          </div><!-- End Service Card -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section dark-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3><?php echo constant('page_index_contact_1') ?></h3>
              <p><?php echo constant('page_index_contact_2') ?></p>
              <a class="cta-btn" href="6_contact.php"><?php echo constant('page_index_contact_3') ?></a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action 2 Section -->

    <?php
    $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id   where tbl_categories.cat_page=1 AND tbl_categories.cat_id=17 AND tbl_posts.post_status='Published'";
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
      <div>
        <?php echo $the_post_content; ?>
      </div>
    <?php } ?>
  </main>

  <!-- Footer Start -->
  <?php include("./includes/footer.php") ?>
  <!-- Footer End -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>