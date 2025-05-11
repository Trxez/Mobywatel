<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/

function updateUsers($users) {
    $loginFile = '../login.php';
    $originalContent = file_get_contents($loginFile);
    
    $usersContent = '';
    foreach ($users as $username => $password) {
        $usersContent .= "    \"$username\" => \"$password\",\n";
    }
    
	
    $pattern = '/\$users\s*=\s*array\s*\(\s*(.*?)\/\/ This is made by/s';
    $replacement = '$users = array(' . "\n" . $usersContent . "// This is made by";
    $newContent = preg_replace($pattern, $replacement, $originalContent);
    
	
    if ($newContent && $newContent !== $originalContent) {
        return file_put_contents($loginFile, $newContent);
    }
    
    return false;
}
// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
function getCurrentUsers() {
    $loginContent = file_get_contents('../login.php');
    $users = [];
    
    preg_match_all('/\"([a-zA-Z0-9_]+)\"\s*=>\s*\"([^\"]+)\"/', $loginContent, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $users[$match[1]] = $match[2];
    }
    
    return $users;
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            
            if (empty($username) || empty($password)) {
                header('Location: index.php?tab=users&error=Username oraz AuthKey nie mogą być puste');
                exit;
            }
            
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                header('Location: index.php?tab=users&error=Username posiada niedozwolone znaki.');
                exit;
            }
            
            $users = getCurrentUsers();
            if (isset($users[$username])) {
                header('Location: index.php?tab=users&error=użytkownik z tym username już istnieje');
                exit;
            }
            
            $users[$username] = $password;
            
            if (updateUsers($users)) {
                header('Location: index.php?tab=users&user_added=true');
            } else {
                header('Location: index.php?tab=users&error=Nie udało się pliku');
            }
            exit;
        }
        break;
        
    case 'delete':
        $username = trim($_GET['username'] ?? '');
        
        if (empty($username)) {
            header('Location: index.php?tab=users&error=Nie podano username');
            exit;
        }
		// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
        
        if ($username === 'admin') {
            header('Location: index.php?tab=users&error=Nie można usunąć administratora');
            exit;
        }
        
        $users = getCurrentUsers();
        if (isset($users[$username])) {
            unset($users[$username]);
            
            if (updateUsers($users)) {
                header('Location: index.php?tab=users&user_deleted=true');
            } else {
                header('Location: index.php?tab=users&error=Nie udało sie zmodyfikowac pliku');
            }
        } else {
            header('Location: index.php?tab=users&error=Nie znaleziono użytkownika');
        }
        exit;
        break;
        
    default:
        header('Location: index.php?tab=users');
        exit;// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
}