<?php
include '../../includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    // $password_input = mysqli_real_escape_string($connection, $password_input);

    $query = "SELECT * FROM tbl_users WHERE user_name='$username'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
     //echo  $password = encrypt($password);
     //exit;

    if (empty($username) || empty($password_input)) {
             echo "<script>alert('Not found user!');window.history.go(-1);</script>";
                // header("Location: ../index.php");
    } else {

            while ($Row = mysqli_fetch_array($select_user_query)) {
                $user_id = $Row['user_id'];
                $user_name = $Row['user_name'];
                $user_firstname = $Row['user_firstname'];
                $user_lastname = $Row['user_lastname'];
                $user_password = $Row['user_password'];
                $user_image = $Row['user_image'];
                $user_role = $Row['user_role'];

            }       

                if ($username === $user_name && password_verify($password_input,$user_password)) {           
                        $_SESSION['username'] = $user_name;
                        $_SESSION['firstname'] = $user_firstname;
                        $_SESSION['lastname'] = $user_lastname;
                        $_SESSION['user_image'] =  $user_image;
                        $_SESSION['user_role'] = $user_role;
                        header("Location: ../backend/index.php");
                }else{
                         echo "<script>alert('User Or Password not correct!!');window.history.go(-1);</script>"; 
                                  
                }
     }
}
