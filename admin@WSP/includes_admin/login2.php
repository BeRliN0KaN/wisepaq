<?php
include '../../includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

   // The data to send to the API
    $postData = array(
        'action' => 'getUser',
        'searchTerm' => $username
    ); 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/wisepaqAPI/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $result = curl_exec($ch);    

    $datasearch =   json_decode( $result, true);
    
    if (isset($datasearch[0]['user_id']) ) {
          if ($username === $datasearch[0]["user_name"] && $password ===$datasearch[0]["user_password"]) {           
            // Access the data
           $user_name = $datasearch[0]["user_name"];
           $user_firstname = $datasearch[0]["user_firstname"];
           $user_lastname = $datasearch[0]["user_lastname"];          
            
           $_SESSION['username'] = $user_name;
           $_SESSION['firstname'] = $user_firstname;
           $_SESSION['lastname'] = $user_lastname;
           header("Location: ../backend/index.php");          
          }else{     
               echo "<script>alert('Password not correct!');window.history.go(-1);</script>";
          }
    }else{
             echo "<script>alert('Not found user!');window.history.go(-1);</script>";
    }

}
?>
