<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$is_admin = ($username === 'admin');


// This is made by Magiczny_Jasiek, and only he can sell it. If you bought it from other vacban.wtf listing that was not this one: https://vacban.wtf/vacshop/78615/ then be careful using it. It is not official.
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demObywatel | Dashboard </title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #121212;
            transition: opacity 0.75s, visibility 0.75s;
        }

        .loader--hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader::after {
            content: "";
            width: 75px;
            height: 75px;
            border: 15px solid #dddddd;
            border-top-color: #1e1e1e;
            border-radius: 50%;
            animation: loading 0.75s ease infinite;
        }

        @keyframes loading {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }
    </style>
    <script>
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            loader.classList.add("loader--hidden");

            loader.addEventListener("transitionend", () => {
                document.body.removeChild(loader);
            });
        });
    </script>
</head>
<body>
<div class="loader"></div>
<header>
    <div class="header-left">
        <h1>demObywatel | Dashboard</h1>
        <p>Logged in as <?php echo $username; ?></p>
    </div>
    <div class="header-right">
        <?php if ($is_admin): ?>
            <a href="adminpanel/index.php" id="monitoring-btn">Panel Administratora<i class="fas fa-desktop" style="color: #ff0000;"></i></a>
        <?php endif; ?>
        <a href="logout.php" id="logout-btn">Logout<i class="fas fa-sign-out-alt"></i></a>
    </div>
</header>
<div class="content">
    <div class="generator-container">
        <h3>mObywatel 2.0</h3>
        <a href="generator.php" id="generator-btn">Generator</a>
    </div>
</div>
</body>
</html>
