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
        <section>
            <a href="science-clubs.php">
                <- Powrót</a>

                    <?php
                    if ($result = $connection->query(sprintf("SELECT * FROM science_clubs WHERE id=" . $_GET['id'] . " LIMIT 1"))) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();

                            echo '<h2>' . $row['name'] . '</h2>';
                            echo '<h4><a href="' . $row['web'] . '">' . $row['web'] . '</a></h4>';
                            echo '<p>Wydział ' . $row['faculty'] . '</p>';
                            echo '<p>Gdzie i kiedy się spotykamy?: ' . $row['meetings'] . '</p>';
                            echo '<p>Kontakt: ' . $row['contact'] . '</p>';

                            echo '<p>' . $row['description'] . '</p>';
                        } else {
                            echo '<h2>Brak koła naukowego o podanym id</h2>';
                        }
                    }
                    ?>
        </section>
    </main>
</body>

</html>