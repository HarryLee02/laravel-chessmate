<?php 
include('dbcon.php');
session_start();

if(isset($_POST['register']))
{
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = [
        'displayName' => $full_name,
        'emailVerified' => false,
        'phoneNumber' => '+84'.$phone_number,
        'email' => $email,
        'password' => $password
    ];

   $createdUser = $auth->createUser($data);
   if($createdUser){
        $_SESSION['status'] = "Data Inserted Successfully";
        header("Location: TESTINDEX.php");
    }else{
        $_SESSION['status'] = "Data Not Inserted. Something Went Wrong.!";
        header("Location: TESTINDEX.php");
    }

}
