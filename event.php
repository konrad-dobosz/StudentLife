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
    <title>Wydarzenia | StudentLife</title>

    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php include_once "components/navbar/navbar.php"; ?>
    <main>
        <section>
            <a href="events.php">
                <- Powrót</a>

                    <?php
                    if ($result = $connection->query(sprintf("SELECT * FROM events WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $date = new DateTimeImmutable($row['date_start']);

                            echo '<h2>' . $row['name'] . '</h2>';
                            echo '<p>Miejsce: ' . $row['address'] . '</p>';
                            echo '<p>Kiedy: ' . $date->format('d.m.Y') . ' o ' . $date->format('H:i') . '</p>';

                            echo '<p>' . $row['description'] . '</p>';
                        } else {
                            echo '<h2>Brak wydarzenia o podanym id</h2>';
                        }
                    }
                    ?>
        </section>
    </main>
</body>

</html>