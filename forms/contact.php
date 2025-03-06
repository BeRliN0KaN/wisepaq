<?php
// ตรวจสอบเมื่อกดปุ่ม และเมื่อส่งค่า  g-recaptcha-response มาตรวจสอบ
if(isset($_POST['btn_submit']) && isset($_POST['g-recaptcha-response'])){
    $recaptcha_secret = "6Lce5tYqAAAAABMa9sjvL8Cehz43FodoyWjCUZG4";
    $recaptcha_response = trim($_POST['g-recaptcha-response']);
    $recaptcha_remote_ip = $_SERVER['REMOTE_ADDR'];
     
    $recaptcha_api = "https://www.google.com/recaptcha/api/siteverify?".
        http_build_query(array(
            'secret'=>$recaptcha_secret,
            'response'=>$recaptcha_response,
            'remoteip'=>$recaptcha_remote_ip
        )
    );
    $response=json_decode(file_get_contents($recaptcha_api), true);        
 //echo "<pre>";
   // print_r($response);
  //  echo "</pre>";   
}
if(isset($response) && $response['success'] == true){ // ตรวจสอบสำเร็จ 
   // echo "Successful!"; // ทำคำสั่งเพิ่มข้อมูลหรืออื่นๆ 
}else{
  //  echo "Access denied!";  
}

if($_POST['g-recaptcha-response']<>''){
    $to = "paisit@wisepaq.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['name'];
    $last_name = '' ;// $_POST['last_name'];
    $subject =  $_POST['subject'];// "Form submission";
    $subject2 = "Copy of your form submission";
    $message =$_POST['message'];    // $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
     $message2 = "We have received your email and will be responding to you soon.";
   // $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
}
?>
