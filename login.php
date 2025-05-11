<?php
session_start();

$users = array(
    "Pharmac1stt" => "Pharmac1stt",
// This is made by Pharmac1stt, and only he can sell it. Pharmac1stt Top 1 Decrypter and deobfuscator

); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (array_key_exists($username, $users) && $users[$username] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        header("Location: dashboard.php");
        exit;    } else {
        echo "Invalid auth key.";
    }
} else {
	// This is made by Pharmac1stt, and only he can sell it. Pharmac1stt Top 1 Decrypter and deobfuscator
    header("Location: index.php");
    exit; 
}
?>


