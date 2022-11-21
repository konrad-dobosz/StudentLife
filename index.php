<?php
session_start();

if ((!isset($_SESSION['logged'])) && ($_SESSION['logged'] != true)) {
    header('Location: login.php');
    exit();
}

require_once "db.php";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentLife</title>

    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <main>
        <header>
            <h1>
                Cześć, <br> <span>{NICK}</span>
            </h1>
            <p>U nas znajdziesz najlepsze wydarzenia i najnowsze informacje o Twoim kierunku!</p>
        </header>

        <section id="cards">
            <button class="card">Wydarzenia</button>
            <button class="card">Koła naukowe</button>
            <button class="card">Wskazówki</button>
            <button class="card">Pomoc</button>
        </section>
    </main>
</body>

</html>