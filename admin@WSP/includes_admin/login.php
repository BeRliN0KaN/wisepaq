<?php
include '../../includes/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM tbl_users WHERE user_name='$username'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
     //echo  $password = encrypt($password);
     //exit;

    if (empty($username) || empty($password)) {
             echo "<script>alert('Not found user!');window.history.go(-1);</script>";
                // header("Location: ../index.php");
    } else {

            while ($Row = mysqli_fetch_array($select_user_query)) {
                $user_id = $Row['user_id'];
                $user_name = $Row['user_name'];
                $user_firstname = $Row['user_firstname'];
                $user_lastname = $Row['user_lastname'];
                $user_password = $Row['user_password'];
            }       

                if ($username === $user_name && $password === $user_password) {           
                        $_SESSION['username'] = $user_name;
                        $_SESSION['firstname'] = $user_firstname;
                        $_SESSION['lastname'] = $user_lastname;
                        header("Location: ../backend/index.php");
                }else{
                         echo "<script>alert('User Or Password not correct!!');window.history.go(-1);</script>"; 
                                  
                }
     }
}
