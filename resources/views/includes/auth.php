<?php
include('dbcon.php');
session_start();

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = $auth->getUserByEmail("$email");
        $signInResult = $auth->signInWithEmailAndPassword($email, $password);
        $idTokenString = $signInResult->idToken();
        
        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->claims()->get('sub');

            $_SESSION['verified_user_id'] = $uid;
            $_SESSION['idTokenString'] = $idTokenString;
            $_SESSION['status'] = "Login successful!";
            header("Location: TESTINDEX.php");

        } catch (\Kreait\Firebase\Exception\Auth\InvalidCustomToken $e) {
            echo 'The token is invalid: '.$e->getMessage();
        } catch (\InvalidArgumentException $e)
        {
            echo 'The token could not be parsed: '.$e->getMessage();
        }
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $_SESSION['status'] = "Incorrect email or password! Please try again.";
        header("Location: login.html");
        exit();
    }

} else
{
    $_SESSION['status'] = "Not allowed.";
    header("Location: TESTINDEX.php");
    echo "<script type='text/javascript'>alert('Not allowed');</script>";
    exit();
}
