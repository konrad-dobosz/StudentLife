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

    <link rel="stylesheet" href="css/help.css">
    <script type = "text/javascript" src = "js/index.js" defer></script>
</head>

<body>
    <?php include_once "components/navbar/navbar.php"; ?>
    <main>
    <div class="container">
        <h1>Raport Błędu</h1>
        <form action="submit-error.php" method="post">
            <label for="name">Imie:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="error-type">Typ Błędu</label>
            <select id="error-type" name="error-type">
              <option value="Page Not Found">Strony nie znaleziono</option>
              <option value="Broken Link">Zepsuty Link</option>
              <option value="Visual Bug">Błąd Wizualny</option>
              <option value="Content Error">Błąd Zawartości</option>
              <option value="Other">Inny Błąd</option>
            </select>

            <label for="error-description">Opisz swój błąd:</label>
            <textarea id="error-description" name="error-description"></textarea>
            <input type="submit" value="Zgłoś Błąd">
        </form>
    </div>
    </main>
  
</body>

</html>