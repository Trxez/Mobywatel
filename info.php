<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demObywatel | TOS </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="generator.css">
    <style>
        body {
        
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
        }

        .content h2 {
            color: #FFF;
        }

        .content p {
            line-height: 1.6;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #1e1e1e;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #FFD700;
        }
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
        <h1>demObywatel | Informacje i Regulamin <i class="fas fa-info-circle"></i></h1>
        <a href="dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    </header>
    <div class="content">
        <h2>O nas</h2>
        <p>demObywatel został stworzony, aby umożliwić użytkownikom tworzenie przykładowych stron imitujących aplikacje mObywatel.  </p>
        
        <h2>Jak używać generatora?</h2>
        <p>Wypełnij wszystkie pola danymi, a następnie wygeneruj strone i podążaj zgodnie z poniżej podanymi instrukcjami.</p>
        <b style="color:green"> Android <i class="fab fa-android" style="color: #0ecb01;"></i></b>
      <li>Uruchom stronę w chrome</li>
        <li>Przejdź do wczesniej wygenerowanej strony, do ekranu "Zaloguj się"</li>
          <li>Naciśnij trzy kropki w prawym górnym rogu</li>
            <li>Naciśnij "Dodaj do ekranu głównego"</li>
              <li>Wpisz nazwę</li>
                <li>Naciśnij "Dodaj"</li>
         <b style="color:white"> IOS <i class="fab fa-apple" style="color: #ffffff;"></i></b>    
     <li> Uruchom stronę w safari</li>
     <li> Przejdź do wczesniej wygenerowanej strony, do ekranu "Zaloguj się"</li>
     <li> Naciśnij strzałkę w górę znajdującą się na dolnym pasku po środku</li>
     <li> Naciśnij "Dodaj do ekranu głównego"</li>
     <li>  Wpisz nazwę</li>
     <li> Naciśnij "Dodaj"</li>
          <h2>Uwaga</h2>
        <p>demObywatel jest przeznaczony wyłącznie do celów demonstracyjnych i edukacyjnych. </p> <!-- #esesman -->
       
    </div>
</body>
</html>
