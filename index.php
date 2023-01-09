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
    <script type = "text/javascript" src = "js/index.js" defer></script>
</head>

<body>
    <?php include_once "components/navbar/indexnavbar.php"; ?>
    <main>
        <section class = "menu">
        </section>

        <section class="section-content">
            <h2>Witaj w StudentLife, <span><?php echo $_SESSION['login']; ?></span></h2>
                <p>Jesteśmy tutaj, aby dostarczyć informacje na tematy uniwersyteckie i studenckie, w tym:</p>
                    <ul>
                        <li>Politechnika</li>
                        <li>Planowanie karriery</li>
                        <li>Pomoc finansowa</li>
                        <li>Imprezy i zajęcia na kampusie</li>
                    </ul>
                <p>Przeglądaj naszą witrynę, aby znaleźć wskazówki, porady i zasoby, które pomogą Ci odnieść sukces na studiach i poza nimi.</p>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <p>Twórcy:</p>
                     <ul>
                        <li>Miłosz Wciśliński</li>
                        <li>Konrad Dobosz</li>
                    </ul>
            </div>      
        </div>
        <div class="copyright">&copy; StudentLife 2023</div>
</footer>
</body>

</html>