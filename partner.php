<?php include("./includes/header.php") ?>


<div class="text-center mx-auto wow fadeInUp section-title mt-5 pb-0" data-wow-delay="0.1s" style="max-width: 900px;">
   <h2 class="display-5 ">PARTNERS</h2>
</div>

<!-- Solution content Start -->
<div class="container">
   <?php
     $query = "SELECT * FROM tbl_posts inner join tbl_categories on tbl_categories.cat_id = tbl_posts.post_category_id where tbl_categories.cat_page=11 AND tbl_categories.cat_id=18 AND tbl_posts.post_status='Published'";
     $fetch_posts_data = mysqli_query($connection, $query);
     $counter = 1; // ตัวแปรสำหรับนับลูป
     while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
        $the_post_id = $Row['post_id'];
        $the_post_image = $Row['post_image'];
        $lang = $_SESSION['lang'];
        switch ($lang) {
           case 'en':
               $the_post_content = base64_decode($Row['post_content']);
               break;
           case 'cn':
               $the_post_content = base64_decode($Row['post_content_china']);
               break;
           default:
               $the_post_content = base64_decode($Row['post_content_thai']);
               break;
       }
       echo "<span$the_post_content </span>";
    }
     ?>
<!-- Solution content End -->


<!-- Start Footer -->
<?php include("./includes/footer.php") ?>
<!-- End Footer -->