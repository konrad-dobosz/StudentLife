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
    <title>Koła naukowe | StudentLife</title>

    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php include_once "components/navbar/navbar.php"; ?>
    <main>
        <h3>Koła naukowe na naszej uczelni:</h3>
        <section>
            <?php

            if ($result = $connection->query(sprintf("SELECT * FROM science_clubs LIMIT 10"))) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        echo '<a href="science-club.php?id=' . $row['id'] . '" class="event-card">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '</a>';
                    }
                } else {
                    echo '<p>Brak kół naukowych</p>';
                }
            }
            ?>
        </section>
    </main>
</body>

</html>