<?php
session_start();

unset($_SESSION['verified_user_id']);
unset($_SESSION['idTokenString']);

$_SESSION['status'] = "Logged out successfully!";
header("Location: TESTINDEX.php");
exit();
?>