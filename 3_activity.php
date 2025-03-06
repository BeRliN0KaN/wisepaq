<?php include("./includes/header.php");
            include('pagination.php');
?>



    <script type="text/javascript">
    //JK Popup Window Script (version 3.0)- By JavaScript Kit (http://www.javascriptkit.com)
    //Visit JavaScriptKit.com for free JavaScripts
    //This notice must stay intact for legal use
    function openpopup(popurl){
    var winpops=window.open(popurl,"","width=auto,height=auto,status,scrollbars,resizable,modal")
    }
    </script>   

<body>
<!-- About Start -->
<div class="container-fluid service ">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h2 class="display-5 mb-4 fw-bold "><?php echo constant('page_activity_1') ?></h2>
            <p class="fs-5 mb-0"><?php echo constant('page_activity_2') ?>
            </p>
        </div>
        <div  class="row g-4 justify-content-left">

            <?php
        //    $query = "SELECT * FROM tbl_activity where     tbl_activity.activity_status='Published' order by  tbl_activity.activity_id desc ";
       //     print_r($nquery);exit;
          //  $fetch_posts_data = mysqli_query($connection, $nquery);
        //    while ($Row = mysqli_fetch_assoc($fetch_posts_data)) {
                while($Row = mysqli_fetch_array($nquery)){
                $the_activity_id = $Row['activity_id'];
                $the_activity_image = $Row['activity_image'];
                $the_activity_date = $Row['activity_date'];      
                if ($_SESSION['lang'] == 'en') {   
                    $the_activity_title = base64_decode($Row['activity_title']);
                    $the_activity_content = base64_decode($Row['activity_content']);
                }else if ($_SESSION['lang'] == 'cn') { 
                    $the_activity_title = base64_decode($Row['activity_title_china']);
                    $the_activity_content = base64_decode($Row['activity_content_china']);                
                }else{
                    $the_activity_title = base64_decode($Row['activity_title_thai']);
                    $the_activity_content = base64_decode($Row['activity_content_thai']);
                }
            ?>
               <div  class="col-md-6 col-lg-4 col-xl-3 fadeInUp d-flex " data-wow-delay="0.1s">
                    <div  class="service-item text-center rounded-4 p-4 d-flex flex-column w-100 shadow-lg">
                        <div class="blog-item flex-grow-1">
                            <div class="blog-img overflow-hidden" style="position: relative;">
                                <img src="<?php echo "admin@WSP/activity/" . $the_activity_image; ?>" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;" alt="">
                            </div>
                            <div class="service-content">
                                <h6 class="my-3 fw-bold"><?php echo $the_activity_title; ?></h6>
                                <p class=""><i class="fa-solid fa-calendar-days"></i>  <?php echo   date("d-m-Y", strtotime($the_activity_date)) ?></p>     
                             <a class="read-more"   href="javascript:openpopup('service-activity.php?lan=<?php echo   $_SESSION['lang']  ?>&id=<?php echo $the_activity_id?>')"><h2><i class="fa-solid fa-circle-arrow-right"></i></h2></a>
                                
                             <!--   <p class=""><?php echo $the_activity_content; ?></p>-->
                            </div>
                        </div>
                    </div>
                </div>
  
            <?php } ?>
            
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
        </div>
                  
    </div>

</div>
<!-- About End -->
    



</body>

    <!-- Start Footer -->
    <?php include("./includes/footer.php") ?>
    <!-- End Footer -->